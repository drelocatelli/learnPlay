<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {


    public function authenticate(AuthRequest $request) {
        
        
        if (!Auth::attempt($validated)) {
            abort(404);
        }

        return redirect('/dashboard');
    }
}