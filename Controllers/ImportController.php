<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Auth;
use App\Manual;
use App\Type;
use Validator;
use Excel;
use Imagick;
use PdfToImage;
use File;

class ImportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permission=Auth::user();
        return view('import',compact('permission'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
                            $path = "public/upload/$directory";
                            
                            Storage::deleteDirectory($path);//delete directory
                           
                                
                            //  mkdir("storage/upload/$directory");//建立圖片資料夾
                           
                          
                            // $pathToPdf='storage/pdf/'.$filename;
                            // $pdf = new \Spatie\PdfToImage\Pdf($pathToPdf);
                            // $totalpage = $pdf -> getNumberOfPages();
                            
                            // for($i=1 ;$i<=$totalpage;$i++){
                            //     $pdf -> setPage($i)->saveImage("storage/upload/$F_TYPE-$F_NAME/");
                            // }
   
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
                    // $file->storeAs($path,$filename);
                    //$string = $string.$filename;
                }
                $message=$message."+end";
                return $message;

            }else{

                return "false1";
            }
        }
        return "false";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $file = Input::file('file');
        $validator = Validator::make($request->all(),[
            'file' =>'required|mimes:xls',
        ]);

        if($validator->passes()){
            $file=$request->file('file');
            $filename = $file->getClientOriginalName();
            $file->storeAs('public/excel',$filename);
            $data = Excel::load('public/storage/excel/'.$filename);
            $worksheet = $data->getActiveSheet();
            $highestRow = $worksheet->getHighestRow(); //總行數
            $highestColumn = $worksheet->getHighestColumn(); // 總列數
            $number = "";

             for ($row = 1; $row <= $highestRow; $row++) { 
                $F_TYPE = $worksheet->getCellByColumnAndRow(0,$row)->getValue();
                $F_NAME = $worksheet->getCellByColumnAndRow(1,$row)->getValue();
                
                $array = [
                    "TYPE" => $F_TYPE,
                    "NAME" => $F_NAME,
                ];

                $validator = Validator::make($array,[
                    'TYPE' => 'between:1,30|regex:/^[^\"\'\-]+$/',
                    'NAME' => 'between:1,30|regex:/^[^\"\'-]+$/',
                ]);

                if($validator->passes()){

                    $FID = Manual::select('FID')->where('F_TYPE',$F_TYPE)->where('F_NAME',$F_NAME)->get();
                    $Type = Type::select('type')->where('type',$F_TYPE)->get();

                    if(count($FID) == 0){   //新增 data to Manual  table 
                             Manual::create([
                                'F_TYPE' => $F_TYPE,
                                'F_NAME'  => $F_NAME,  
                            ]);
                    }

                    if(count($Type) == 0){ //新增 data to type table 
                        Type::create([
                           'type' => $F_TYPE,  
                       ]);
                    }

                }else{
                    $number = $number.'-'.$row;
                
                }
                
            }

            $number=$number.'-end';
            return $number;
                      
            
        }
         
      
    }

   


}
