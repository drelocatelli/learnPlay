<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\User\UserAlert;

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

        $user = User::create($credentials);
        $userAlert = UserAlert::create(['id_user' => $user->id, 'alert' => 'Bem vindo a plataforma! =)']);;


        if($user && $userAlert){
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
