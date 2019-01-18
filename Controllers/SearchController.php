<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Manual;
class SearchController extends Controller
{
    public function index(Request $request){
        $F_TYPE=Manual::select('F_TYPE')->distinct()->get();
        $permission=Auth::user();
        $message= null;
      
        if(!empty($request['F_TYPE']) && empty($request['F_NAME'])){ //type
            $table=Manual::select()->where('F_TYPE',$request['F_TYPE'])->paginate(7);
        
        }
        if(!empty($request['F_TYPE']) && !empty($request['F_NAME'])){ //type-name
            $table=Manual::select()->where('F_TYPE',$request['F_TYPE'])->where('F_NAME',$request['F_NAME'])->paginate(7);
        }
        if(empty($request['F_TYPE']) && !empty($request['F_NAME'])){ //key-name
            $table=Manual::select()->where('F_TYPE','like','%'.$request['F_NAME'].'%')->orwhere('F_NAME','like','%'.$request['F_NAME'].'%')->paginate(7);
            if(count($table) == 0 ){
                $message = $request['F_NAME'];
            }
        }
        if(empty($request['F_TYPE']) && empty($request['F_NAME'])){ //total
            $table=Manual::select()->paginate(7);
            
        }
        //$table->withPath('search?');
        //搜尋參數
        $parameter=[
            'F_TYPE' => $request['F_TYPE'],
            'F_NAME' => $request['F_NAME'],
        ];
        return view('search')->with('F_TYPE',$F_TYPE)->with('permission',$permission)->with('table',$table)->with('parameter',$parameter)->with('message',$message);
    }

    public function show(Request $request){
        $F_TYPE = $request["F_TYPE"];
        $F_NAME = Manual::select('F_NAME')->where('F_TYPE',$F_TYPE)->get();
        $string="";
        foreach($F_NAME as $colum){
            $string=$string."-".$colum['F_NAME'];
        }
        $string=$string."-end";
        return $string;   
    } 
    
    public function destroy(Request $request){
        Manual::where('FID',$request['FID'])->delete();
        return "true";
              
      
    }
    
}
