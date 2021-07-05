<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Register\RegisterController;

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
//------------------------------- Basic
Route::get('/', function () { return view('index'); });

//------------------------------- Loguin
Route::post('/login', [AuthController::class, 'authenticate'])->name('form-login');

//------------------------------- Registro
Route::group(['prefix' => 'register'], function(){
    $controller = RegisterController::class;
    Route::match(['get','post'], '/', [$controller, 'register'])->name('form-register');
    Route::match(['get','post'], '/error', [$controller, 'error']);
    Route::match(['get','post'], '/success', [$controller, 'success']);
});
