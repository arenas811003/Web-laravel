<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Manual;
use App\Worklist;
use Validator;
use File;
class SetworkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $permission=Auth::user();
        $F_TYPE=Manual::select('F_TYPE')->distinct()->get();
        $bladevalue = [
            'pid'   =>  $request['PID'],
            'describe' => $request['P_DESCRIBE'],
            'type' => $request['F_TYPE'],
            'name' => $request['F_NAME'],
        ];

        $type= $request['F_TYPE'];
        $name = $request['F_NAME'];

        if(file_exists("storage/upload/$type-$name")){
            $files = File::files("storage/upload/$type-$name");
        }

        return view('setwork',compact('permission','F_TYPE','bladevalue','files'));
        // return view('setwork')->with('permission',$permission)->with('value',$bladevalue)->with('F_TYPE',$F_TYPE)->with('files',$files);
        //
    }

   

    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(),[
            'id' => 'required|string|between:1,20|regex:/^[^\"\'-]+$/',
            'Type' => 'required|string|between:1,20|regex:/^[^\"\'-]+$/',
            'Project' => 'required|string|between:1,20|regex:/^[^\"\'-]+$/',
        ]);
        if($validator->passes()){

            $FID=Manual::select('FID')->where('F_TYPE',$request['Type'])->where('F_NAME',$request['Project'])->first();
            
            Worklist::where('id',$request['id'])
            ->update([
                'P_FID' => $FID['FID'],
             ]);    
            return "true";
        }
        
    }

   
    public function show(Request $request)
    {
        $F_TYPE = $request["F_TYPE"];
        $F_NAME = Manual::select('F_NAME')->where('F_TYPE',$F_TYPE)->get();
        $string="";
        foreach($F_NAME as $colum){
            $string=$string."-".$colum['F_NAME'];
        }
        $string=$string."-end";
        return $string;   
    }

 
    public function edit(Request $request)
    {
        //
        $array = [
            "NAME" => $request['name'],
        ];
        $validator = Validator::make($array,[
            'NAME' => 'required|between:1,20|regex:/^[^\"\'-]+$/',
        ]);

        if($validator->passes()){
            Worklist::where('id',$request['PID'])
            ->update([
                'P_DESCRIBE' => $request->input('name'),
             ]);    

             return "true";
        }

        return response()->json(['error' => $validator->errors()->all()]);
        
    }

  
 
}
