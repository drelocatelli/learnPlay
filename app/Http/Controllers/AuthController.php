<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {

    public function authenticate(Request $request) {

        $validated = $request->validate([
            'email' => 'required|exists:user',
            'senha' => 'required'
        ]);
            
        if (!Auth::attempt($validated)) {
            return redirect(route('register-error'));
        }

        return redirect(route('register-success'));
    }

}