<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Manual;
class ExportController extends Controller
{
    public function index(Request $request){
        $F_TYPE=Manual::select('F_TYPE')->distinct()->get();
        $permission=Auth::user();
        $message= null;
        if(empty($request['F_TYPE']) && empty($request['F_NAME'])){ //total
            $table=Manual::select()->get();
        }
        if(!empty($request['F_TYPE']) && empty($request['F_NAME'])){ //type
            $table=Manual::select()->where('F_TYPE',$request['F_TYPE'])->get();
        
        }
        if(!empty($request['F_TYPE']) && !empty($request['F_NAME'])){ //type-name
            $table=Manual::select()->where('F_TYPE',$request['F_TYPE'])->where('F_NAME',$request['F_NAME'])->get();
        }
        if(empty($request['F_TYPE']) && !empty($request['F_NAME'])){ //key-name
            $table=Manual::select()->where('F_TYPE','like','%'.$request['F_NAME'].'%')->orwhere('F_NAME','like','%'.$request['F_NAME'].'%')->get();
            $message = $request['F_NAME'];
        }
        return view('export')->with('F_TYPE',$F_TYPE)->with('permission',$permission)->with('table',$table)->with('message',$message);;

    }
}
