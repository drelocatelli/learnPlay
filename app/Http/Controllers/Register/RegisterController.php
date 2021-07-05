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
            'email' => 'required|unique:user',
            'senha' => 'required'
        ]);

        $credentials['senha'] = password_hash($credentials['senha'], PASSWORD_BCRYPT);

        if(User::create($credentials)){
            return redirect()->route('register.success');
        }else{
            return redirect()->route('register.error');
        }

    }

    public function error(){
        return view('register');
    }

    public function success(){
        return view('register');
    }
    
}
