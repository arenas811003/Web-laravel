<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Worklist;
class PiworkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        $permission=Auth::user();
        $worklist =Worklist::select()
                    ->leftjoin('Manual','Manual.FID','=','P_FID')
                    ->get();
        return view('piwork')->with('permission',$permission)->with('worklist',$worklist);
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        
        return $request['ID'];
            
    }
}
