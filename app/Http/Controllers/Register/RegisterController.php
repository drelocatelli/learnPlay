<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public static function createUser($mail, $name, $password) {
        if(empty($mail) || empty($name) || empty($password)){
            header("Location: error");
            die();
        }

        $mail = filter_var($mail, FILTER_SANITIZE_EMAIL);
        $name = filter_var($name, FILTER_SANITIZE_STRIPPED);
        $password = filter_var($password, FILTER_SANITIZE_STRIPPED);
        
        
        
    }
}
