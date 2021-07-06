<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\User\UserAlert;

class UserController extends Controller
{

    public function user($user, $id){
        $find = User::where(['nome' => $user, 'id' => $id])->first();
        if((bool) $find){
            return view('painel.user.profile', compact('user'));
        }else{
            return view('painel.user.profile', ['user' => 'Usuário não existe']);
        }

    }

    public function settings(){
        return view('painel.user.settings');
    }

    public function dashboard(){
        return view('painel.dashboard');
    }

    public function notifyToggle($id){

        User::notifyToggle($id);

    }

}
