<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {

    public function authenticate(Request $request) {

        $credentials = $request->validate([
            'email' => 'required|exists:user',
            'senha' => 'required'
        ]);

        
        dd(password_verify($credentials['senha'], PASSWORD_BCRYPT));            
        // if (!Auth::attempt($credentials)) {
        //     return redirect(route('register.error'));
        // }

    }

}