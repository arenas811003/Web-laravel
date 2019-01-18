<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Auth;
use App\Type;
use App\Manual;
use Validator;

class AddController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permission=Auth::user();
        $Type = Type::select('type')->get(); 
        return view('additem')->with('Type',$Type)->with('permission',$permission);
    }

   
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),[  
            'type' => 'required|string|unique:Type|max:20|regex:/^[^\"\'-]+$/',
        ]);
        if($validator->passes()){
            Type::create([
                'type' => $request['type'],
            ]);
            return response()->json(['success' => 'successfully']);
            //return "true";
        }
        return response()->json(['error' => $validator->errors()->all()]);
     
    }

 
    public function store(Request $request)
    {   
        $F_TYPE = $request['select'];
        $F_NAME = $request['project'];

        $validator = Validator::make($request->all(),[
            'select' => 'required|string|max:20|regex:/^[^\"\'-]+$/',
            'project' => 'required|string|max:20|regex:/^[^\"\'-]+$/',
            'file.*' =>'image|mimes:jpeg,jpg,png',
        ]);

        if($validator->passes()){

            $check = Manual::select('FID')->where('F_TYPE',$F_TYPE)->where('F_NAME',$F_NAME)->get();

            if(count($check) == 0){

                Manual::create([
                    'F_TYPE' => $F_TYPE,
                    'F_NAME' => $F_NAME,
                ]);

                if ($request->hasFile('file')) {
                    $path ="public/upload/$F_TYPE-$F_NAME/";
                    foreach($request->file('file') as $file){
                        $filename = $file->getClientOriginalName();
                        $file->storeAs($path,$filename);
                        //$string = $string.$filename;
                    }
                    //$filename = $request->file('file')->getClientOriginalName();
                    // $request->file('file')->storeAs('public/upload',$filename);   
                }
                return "true";

            }else{

                return "false";
            }    
            
            // return response()->json(['success' => 'successfully']);
            
        }
        return response()->json(['error' => $validator->errors()->all()]);
    
    }   


 
    public function destroy(Request $request)
    {   
        $ManualType = Manual::select('F_TYPE')->where('F_TYPE',$request['type'])->get();

        if(count($ManualType) == 0){

            Type::where('type',$request['type'])->delete();
            return "true";
            
        }else{
            return "false";
        }
    }
}
