<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () { return view('index'); });

//------------------------------- Registro
Route::group(['prefix' => 'register'], function(){
    Route::match(['get','post'], '/', function(){ return view('register'); });
    Route::match(['get','post'], '/error', function(){ return view('register'); });
    Route::match(['post'], '/complete', function(){ return view('register_complete'); });
});

//Route::group(['prefix' => 'cliente'], function(){
//    $controller = ClienteController::class;

