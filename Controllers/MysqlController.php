<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mysql;
use Log;
class MysqlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = Mysql::all();            
        return view('index', [
            'tests' => $todos

        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Log::debug($request->all());
        
        $username = $request['username'];
        $email = $request['email'];
        $phone = $request['phone'];
        $data = [       
            'username' =>$username,
            'email'=> $email,
            'phone'=> $phone
        ];

        $TotalData=100000;
        $Array=[];
        
        for($i=0;$i<$TotalData;$i++){
            $Array[$i]=$data;
            
        }

        //$lenght=count($Array);
        $Array = array_chunk($Array,21800);
        /*for($i=0;$i<$lenght/20000;$i++){
            if($Array[$i] != null){
                print_r($Array[$i]);
                Mysql::insert($Array[$i]);
            }
                           
        }*/
        foreach($Array as $a){
            Mysql::insert($a);
        }
        
        //Mysql::insert($Array);
        
        //$lenght=count($Array);
        //Mysql::insert($Array);
        
        //print_r(count($Array));
        // Mysql::create($Array);
        //$tests = Mysql::create($request->all());
        exit;
        //return redirect('mysql');

        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
