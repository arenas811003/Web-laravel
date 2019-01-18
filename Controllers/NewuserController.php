<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\User;
use Auth;
use Validator;
use Hash;

class NewuserController extends Controller
{
    //
    public function index(){
        
    $permission=Auth::user();
    return view('newuser')->with('permission',$permission);
       
    }
    public function store(Request $request){
       
        $validator = Validator::make($request->all(),[
            'username' => 'required|string|max:16|regex:/^[^\"\']+$/',
            'account' => 'required|string|unique:user|alpha_num|between:3,16',
            'password' => 'required|string|alpha_num|between:3,16',
            'email' => 'required|string|email|unique:user|max:255',
            'select' => 'required|string'
        ]);

        if($validator->passes()){
            User::create([
                'username' => $request['username'],
                'account' => $request['account'],
                'password' => Hash::make($request['password']),
                'email' => $request['email'],
                'permission' => $request['select']
            ]);
            return response()->json(['success' => 'successfully']);
            //return "true";
        }
        return response()->json(['error' => $validator->errors()->all()]);
        //echo $request;

    }

}
