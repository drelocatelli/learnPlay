<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function user($user){
        if(!Auth::check()){
            return redirect()->route('homepage');
        }

        return view('painel.user.profile', compact('user'));
    }

}
