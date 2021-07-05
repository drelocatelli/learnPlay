<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller {

    public function homepage(){
        if(!Auth::check()){
            return view('index');
        }else{
            return redirect()->route('dashboard');
        }
    }


    public function authenticate(Request $request) {

        $credentials = $request->validate([
            'email' => 'required|exists:user',
            'senha' => 'required'
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if(Hash::check($credentials['senha'], $user->senha)){
            Auth::login($user);
            return redirect(route('dashboard'));
        }else{
            return redirect()->back()->withErrors($credentials);
        }

    }


    public function logout(){
        Auth::logout();
        return redirect()->route('homepage');
    }


    public function dashboard(){
        if(!Auth::check()){
            return redirect()->route('homepage');
        }

        return view('painel.dashboard');
    }

}
