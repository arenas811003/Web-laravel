<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Manual;
use Validator;
use PdfToImage;
use File;

class PdfconvertjpgController extends Controller
{
    //
    public function pdf(Request $request)
    {  
        if ($request->hasFile('file')) {

            $validator = Validator::make($request->all(),[  
                'file.*' =>'mimes:pdf',
            ]);
            
            if($validator->passes()){
                
                $message ="";

                foreach($request->file('file') as $file){

                    $filename = $file->getClientOriginalName();
                    $array = [
                        "filename" => $filename,              
                    ];
                    
                    $validator = Validator::make($array,[
                        'filename' => 'regex:/^[^\"\'-]{1,20}-[^\"\'-]{1,20}$/',    
                    ]);

                    if($validator->passes()){

                        $F_TYPE = explode("-",$filename)[0];//[[TYPE],[NAME.jpg]]
                        $F_NAME = explode("-",$filename)[1];
                        $F_NAME = explode(".",$F_NAME)[0];//[[NAME],[jpg]]
                        $FID = Manual::select('FID')->where('F_TYPE',$F_TYPE)->where('F_NAME',$F_NAME)->get();

                        if(count($FID) != 0){
                            $path ="public/pdf/";
                            // $filename = utf8_encode($filename);
                            $file->storeAs($path,$filename);//儲存PDF
                            $directory=$F_TYPE."-".$F_NAME;
                            //  File::deleteDirectory("storage/upload/$F_TYPE-$F_NAME");
                            //  return $directory;
                            
                            // $encode = mb_detect_encoding($directory, array("ASCII","UTF-8","GB2312","GBK","BIG5")); 
                            // if ($encode == "UTF-8"){ 
                               
                            //     $directory = mb_convert_encoding($directory, "ASCII");
                            //     // return mb_detect_encoding($directory, array("ASCII","UTF-8","GB2312","GBK","BIG5"));
                            // }
                            
                            
                            $path = "public/upload/$directory";
                            Storage::deleteDirectory($path);//delete directory
                            //File::makeDirectory("storage/upload/$directory", 0711, true, true);
                            Storage::makeDirectory($path);// create directory
                            // mkdir("storage/upload/$directory",0777,true);//建立圖片目錄
                           
                          
                            $pathToPdf='storage/pdf/'.$filename;
                            $pdf = new \Spatie\PdfToImage\Pdf($pathToPdf);
                            $totalpage = $pdf -> getNumberOfPages();
                            
                            for($i=1 ;$i<=$totalpage;$i++){
                                $pdf -> setPage($i)->saveImage("storage/upload/$F_TYPE-$F_NAME/");
                            }
   
                            // return $totalpage;
                            // $pdf->saveImage('storage/upload/');
                            //  $pdf = new \JianhuaWang\PdfToImage\PdfToImageMaker('TK-abc.pdf');
                           
                            // PdfToImage::configure(array('driver' => 'imagick'));
                            // PdfToImage::pdfFile('TK-abc.pdf')->saveImage();
                            // $pdf->saveImage('storage/upload/');
                         

                        }else{

                            $message = $message."+".$filename;
                            
                        }


                    }else{

                        return "false2";
                    }
                  
                }
                $message=$message."+end";
                return $message;

            }else{

                return "false1";
            }
        }
        return "false";
    }

}
