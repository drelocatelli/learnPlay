<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function user($user){

        return view('painel.user.profile', compact('user'));

    }

    public function dashboard(){
        return view('painel.dashboard');
    }

}
