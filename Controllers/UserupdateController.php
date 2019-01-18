<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Validator;
use Hash;
use bcrypt;
class UserupdateController extends Controller
{
    public function index(Request $request){

        // $user=User::select()->get();
        // $user=Auth::user();
        $permission=Auth::user();
        //$password = User::select('password')->where('account',$request->account)->first();
        $option=User::select()->where('account',$request->account)->first();
        
        //$password = User::select('email')->where('account',$request->account)->first();
        return view('Userupdate')->with('permission',$permission)->with('url',$request)->with('option',$option);
          
    }

    public function store(Request $request){
        //return $request;
        if($request['select'] == "主控端"){
            $request['select'] = "0";
        }
        if($request['select'] == "主管端"){
            $request['select'] = "1";
        }
        if($request['select'] == "客戶端"){
            $request['select'] = "2";
        }
        if ($request['email'] !=$request['exemail'] ){
            $validator = Validator::make($request->all(), [
                'username' => 'required|string|max:16|regex:/^[^\"\']+$/',
                'password' => 'required|string|alpha_num|between:3,16',
                'email' => 'required|string|email|unique:user|max:255',
                'select' => 'required|string'
            ]);
                
        }else{
            $validator = Validator::make($request->all(), [
                'username' => 'required|string|max:16|regex:/^[^\"\']+$/',
                'password' => 'required|string|alpha_num|between:3,16',
                'email' => 'required|string|email|max:255',                
                'select' => 'required|string'
            ]);
        }
      
        if($validator->passes()){
            $request['password'] = Hash::make($request['password']);
            User::where('account',$request['account'])
            ->update([
                    'username' => $request->input('username'),
                    'password' => $request->input('password'),
                    'email' => $request->input('email'),
                    'permission' => $request->input('select'),

            ]); 
           
            return response()->json(['success' => 'successfully']);
            //return "true";
        }
        return response()->json(['error' => $validator->errors()->all()]);
        //echo $request;

    }
}
