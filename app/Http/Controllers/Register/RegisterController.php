<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;

class RegisterController extends Controller {

    public function index(){
        return view('register');

    }

    public function register(Request $request){

        $validated = $request->validate([
            'nome' => 'required|',
            'email' => 'required|exists:user',
            'senha' => 'required'
        ]);

        $validated['senha'] = password_hash($validated['senha'], PASSWORD_BCRYPT);

        if (!Auth::attempt($validated)) {
            return redirect(route('register-error'));
        }

        return redirect(route('register-success'));
    }

    public function error(){
        return view('register');
    }

    public function success(){
        return view('register');
    }
    
}
