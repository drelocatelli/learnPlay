<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller {

    public function homepage(){

        return view('index');

    }


    public function authenticate(Request $request) {

        $credentials = $request->validate([
            'email_login' => 'required|exists:user,email',
            'senha_login' => 'required'
        ]);

        $user = User::where('email', $credentials['email_login'])->first();

        if(Hash::check($credentials['senha_login'], $user->senha)){
            Auth::login($user);
            return redirect(route('dashboard'));
        }else{
            return redirect()->back()->withErrors($credentials)->withInput();
        }

    }


    public function logout(){
        Auth::logout();
        return redirect()->route('homepage');
    }


}
