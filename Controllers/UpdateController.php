<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;
use Auth;
use App\Manual;
use Validator;
class UpdateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $type= $request['F_TYPE'];
        $name = $request['F_NAME'];
        $url=$request;
        $permission=Auth::user();
        $F_TYPE=Manual::select('F_TYPE')->distinct()->get();
        
        for($i=0;$i<count($F_TYPE);$i++){
            $remember=$F_TYPE[0]['F_TYPE'];
            if($F_TYPE[$i]['F_TYPE'] == $url['F_TYPE']){
                $F_TYPE[0]['F_TYPE'] = $url['F_TYPE'];
                $F_TYPE[$i]['F_TYPE'] = $remember;
            }

        }
       
        //   $files = Storage::files("public/upload/$type-$name");
        if(file_exists("storage/upload/$type-$name")){
            $files = File::files("storage/upload/$type-$name");
        }
       
        return view('update',compact('permission','F_TYPE','url','files'));
    }




    public function store(Request $request)
    {
        $F_TYPE = $request['select'];
        $F_NAME = $request['project'];
      
        $validator = Validator::make($request->all(),[
            'select' => 'required|string|max:20|regex:/^[^\"\'-]+$/',
            'project' => 'required|string|max:20|regex:/^[^\"\'-]+$/',
            'file.*' =>'image|mimes:jpeg,jpg',
        ]);

        if($validator->passes()){
            
            if($F_TYPE != $request['extype'] or $F_NAME != $request['exname']){

                $FID = Manual::select('FID')->where('F_TYPE',$F_TYPE)->where('F_NAME',$F_NAME)->get();
               
                if(count($FID) == 0){
                    
                    Manual::where('FID',$request['exfid'])
                    ->update([
                            'F_TYPE' => $request->input('select'),
                            'F_NAME' => $request->input('project'),
                    ]); 

                }else{
                    return "false";
                }    

            }
        
            if ($request->hasFile('file')) {
                Storage::deleteDirectory("public/upload/$F_TYPE-$F_NAME");//delete directory
                $path ="public/upload/$F_TYPE-$F_NAME/";
                foreach($request->file('file') as $file){
                    $filename = $file->getClientOriginalName();
                    $file->storeAs($path,$filename);
                    //$string = $string.$filename;
                }
                   
            }
              
            return "true";

        
        }else{

            return response()->json(['error' => $validator->errors()->all()]);
        }    
            
        
    }

   
}
