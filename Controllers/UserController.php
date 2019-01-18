<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
class UserController extends Controller
{
    //
    public function index(Request $request){
        //$session = $request->session()->get('account');
        $user=User::select()->get();
        $permission=Auth::user();
        return view('user')->with('user',$user)->with('permission',$permission);         
        // if(Auth::check()){
        //     $user=User::select()->get();
        //     $permission=Auth::user();
        //     return view('user')->with('user',$user)->with('permission',$permission); 
        // }else{
        //     return view('login');
        // }
    }
    public function destroy(Request $request){
        User::where('id',$request['ID'])->delete();
        return "true";
              
      
    }

}
