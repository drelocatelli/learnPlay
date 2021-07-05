<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {

    public function authenticate(Request $request) {

        $validated = $request->validate([
            'email' => 'required|exists:user',
            'password' => 'required'
        ]);
            
        if (!Auth::attempt($validated)) {
            return redirect('/login/error');
        }

        return redirect('/login');
    }

}