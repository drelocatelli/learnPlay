<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class RegisterController extends Controller {

    public static function loguin($data){

        if (User::select('email','senha')->where(['email' => $data['email'], 'senha' => password_verify($data['senha'], PASSWORD_BCRYPT)])->exists() ){
            return true;
        }
        

    }
    
    public static function create($mail, $name, $password) {
        if(empty($mail) || empty($name) || empty($password)){
            header("Location: error");
            return false;
            die();
        }

        $mail = filter_var($mail, FILTER_SANITIZE_EMAIL);
        $name = filter_var($name, FILTER_SANITIZE_STRIPPED);
        $password = filter_var($password, FILTER_SANITIZE_STRIPPED);
        $password = password_hash($password, PASSWORD_BCRYPT);

        // if user exists
        if (User::where('email', $mail)->exists()){
            header("Location: error/user_exists");
            die();
        }else{
            User::create(['nome' => $name, 'email' => $mail, 'senha' => $password]);
            return true;
        }
        
    }
}
