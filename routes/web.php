<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Register\RegisterController;
use App\Http\Controllers\User\UserController;

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
Route::get('/', [AuthController::class, 'homepage'])->name('homepage')->middleware('guest');

//------------------------------- Loguin
Route::group(['prefix' => '/login'], function(){
    $controller = AuthController::class;
    Route::post('/', [$controller, 'authenticate'])->name('login');
    Route::get('/logout', [$controller, 'logout'])->name('login.logout');
});

//------------------------------- Registro
Route::group(['prefix' => '/register'], function(){
    $controller = RegisterController::class;
    Route::get('/', [$controller, 'index']);
    Route::post('/complete', [$controller, 'register'])->name('register');
    Route::get('/error', [$controller, 'error'])->name('register.error');
    Route::get('/success', [$controller, 'success'])->name('register.success');
});

//------------------------------- Dashboard User
Route::prefix('user')->middleware('auth')->group(function(){
    $controller = UserController::class;
    Route::get('/settings', [$controller, 'settings'])->name('user.settings');
    Route::match(['get','post'], '/settings/setPhoto', [$controller, 'changePhoto'])->name('user.changePhoto');
    Route::get('{user}/{id?}', [$controller, 'user'])->name('user.profile');
    Route::put('/notify/{id}', [$controller, 'notifyToggle'])->name('user.notifyToggle');
});

//------------------------------- Dashboard
Route::prefix('dashboard')->middleware('auth')->group(function(){
    $controller = UserController::class;
    Route::get('/', [$controller, 'dashboard'])->name('dashboard');
    Route::get('my/groups', [$controller, 'groups'])->name('dashboard.groups');
    Route::get('my/class', [$controller, 'class'])->name('dashboard.class');
    Route::get('my/articles', [$controller, 'articles'])->name('dashboard.articles');
    Route::get('my/content', [$controller, 'content'])->name('dashboard.content');
});
