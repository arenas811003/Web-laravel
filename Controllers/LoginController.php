<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Validator;
class LoginController extends Controller
{
    public function index(){
        return view('login');
    }

    public function store(Request $request){
        
        $account = $request['account'];
        $password = $request['password'];

        $validator = Validator::make($request->all(),[
            'account' => 'required|string|alpha_num',
            'password' => 'required|string|alpha_num',  
        ]);
        
        if($validator->passes()){

            if (Auth::attempt(['account' => $account, 'password' => $password])){
                return "true";
            }else{
                return "false";
            }

        }else{

            return response()->json(['error' => $validator->errors()->all()]);
        }
        // $users=Login::select('id')->where('account',$account)
        //                           ->where('password',$password)
        //                           ->get();    

        // $account=Login::select('account')->where('account',$account)->first();
        // $permission=Login::select('permission')->where('account',$account)->first();
        
        // session()->put('account',$account['account']);
        
        // //echo $account['account'];
        // session()->put('permission',$permission['permission']);
        // //echo $permission['permission'];
        // //session(['permission' => $permission]);
        // //echo session()->get('permission');
        // if(count($users) != 0){
        //      //return $users;
        //     return "true";
        // }else{
        //     return "false";
        // }
      
    }
    public function logout(Request $request){
  
        //$request->session()->flush();
        Auth::logout();

        return redirect('login');

    }
}
