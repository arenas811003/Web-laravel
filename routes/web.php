<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/main', function () {
    return view('main');
});


Route::resource('login','LoginController');
Route::get('/logout', 'LoginController@logout');

Route::group(['middleware' => ['web','Auth']], function () {

    Route::get('/export', 'ExportController@index');
    Route::resource('userupdate','UserupdateController');
    Route::resource('newuser','NewuserController');
    Route::resource('user','UserController');
    Route::resource('search','SearchController');
    Route::resource('additem','AddController');
    Route::resource('update','UpdateController');
    Route::resource('import','ImportController');
    Route::post('/import', 'ImportController@pdf');
    Route::resource('piwork','PiworkController');
    Route::resource('setwork','SetworkController');
    
});

// Route::get('/mysql', 'MysqlController@index');

// Route::post('/mysql', 'MysqlController@insert');

