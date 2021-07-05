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

        $credentials = $request->validate([
            'nome' => 'required',
            'email' => 'required|exists:user',
            'senha' => 'required'
        ]);

        $credentials['senha'] = password_hash($credentials['senha'], PASSWORD_BCRYPT);

        if (Auth::attempt($credentials)) {
            print 'sucesso';
        }else{
            print 'erro';
        }

    }

    public function error(){
        return view('register');
    }

    public function success(){
        return view('register');
    }
    
}
