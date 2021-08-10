<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Register\RegisterController;

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ClassController;


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

//------------------------------- Dashboard
Route::prefix('dashboard')->middleware('auth')->group(function(){
    $controller = UserController::class;
    Route::get('/', [$controller, 'dashboard'])->name('dashboard');
    Route::get('error', [$controller, 'notfound'])->name('dashboard.notfound');
    Route::get('my/articles', [$controller, 'articles'])->name('dashboard.articles');
    Route::get('my/content', [$controller, 'content'])->name('dashboard.content');
});

//------------------------------- Dashboard User
Route::prefix('user')->middleware('auth')->group(function(){
    $controller = UserController::class;
    Route::get('/settings', [$controller, 'settings'])->name('user.settings');
    Route::match(['get','post'], '/settings/setPhoto', [$controller, 'changePhoto'])->name('user.changePhoto');
    Route::get('{user?}/{id}', [$controller, 'user'])->name('user.profile');
    Route::put('/notify/{id}', [$controller, 'notifyToggle'])->name('user.notifyToggle');
});

//------------------------------- Dashboard class
Route::prefix('dashboard')->middleware('auth')->group(function(){
    $controller = ClassController::class;
    Route::get('my/class', [$controller, 'class'])->name('dashboard.class');
    Route::get('class/manage', [$controller, 'class_manage'])->name('dashboard.class.manage');
    Route::get('class/list', [$controller, 'class_public'])->name('dashboard.class.public');
    Route::match(['post', 'get'] ,'class/new', [$controller, 'class_create'])->name('dashboard.class.create');
    Route::get('class/category/{category}', [$controller, 'class_category'])->name('dashboard.class.category');
    Route::get('class/search', [$controller, 'class_search'])->name('dashboard.class.search');
    Route::get('class/{id}/learn/{class?}', [$controller, 'class_learn'])->name('dashboard.class.learn');
    Route::match(['get', 'post'], 'class/{id}/{class?}', [$controller, 'class_page'])->name('dashboard.class.page');
    Route::match(['get', 'post'], 'class/{id}/savevideo/{videoId}/{userId}', [$controller, 'class_leave'])->name('dashboard.class.saveVideo');
    Route::get('class/{id}/{class?}/enroll', [$controller, 'class_matricula'])->name('dashboard.class.matricula');
    Route::get('class/{id}/{class?}/leave', [$controller, 'class_leave'])->name('dashboard.class.leave');

});

//------------------------------- Dashboard group
Route::prefix('dashboard')->middleware('auth')->group(function(){
    $controller = GroupController::class;
    Route::get('my/groups', [$controller, 'groups'])->name('dashboard.groups');
    Route::get('my/groups/management', [$controller, 'groups_admin'])->name('dashboard.groups.admin');
    Route::get('group/list', [$controller, 'group_public'])->name('dashboard.groups.public');
    Route::match(['post','get'],'group/new', [$controller, 'group_new'])->name('dashboard.groups.new');
    Route::match(['get','post'],'group/{title?}/{id}/article/{article}', [$controller, 'group_comment'])->name('dashboard.groups.comment');
    Route::match(['get', 'post'], 'group/{title?}/{id}', [$controller, 'group_page'])->name('dashboard.groups.page');
    Route::match(['get', 'post'], 'group/{title?}/{id}/changeTitle', [$controller, 'group_changeTitle'])->name('dashboard.group.changeTitle');
    Route::match(['get', 'post'], 'group/{title?}/{id}/changeDescription', [$controller, 'group_changeDescription'])->name('dashboard.group.changeDescription');
    Route::match(['get', 'post'], 'group/{title?}/{id}/changeThumbnail', [$controller, 'group_changeThumbnail'])->name('dashboard.group.changeThumbnail');
    Route::match(['get', 'post'], 'group/{title?}/{id}/changeVisibility', [$controller, 'group_changeVisibility'])->name('dashboard.group.changeVisibility');
    Route::match(['get', 'post'], 'group/{title?}/{id}/addMembers', [$controller, 'group_addMembers'])->name('dashboard.group.addMembers');
    Route::match(['get', 'post'], 'group/{title?}/{id}/promoteAdmin/{id_user}', [$controller, 'group_promoteAdmin'])->name('dashboard.group.promoteAdmin');
    Route::match(['get', 'post'], 'group/{title?}/{id}/removeMember/{id_user}', [$controller, 'group_removeMember'])->name('dashboard.group.removeMember');
    Route::post('group/{title?}/{id}/post', [$controller, 'group_post'])->name('dashboard.groups.post');
    Route::get('group/{id}/delete/postId/{id_article}', [$controller, 'group_post_delete'])->name('dashboard.groups.postDelete');
    Route::get('group/{id}/delete/postId/{id_article}/{id_comment}', [$controller, 'group_post_commentDelete'])->name('dashboard.groups.postcommentDelete');
    Route::get('group/{title?}/{id}/leave', [$controller, 'group_leave'])->name('dashboard.groups.leave');
    Route::get('group/{title?}/{id}/enter', [$controller, 'group_enter'])->name('dashboard.groups.enter');
});
