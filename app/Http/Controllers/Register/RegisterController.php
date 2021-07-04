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
        $mail = 
        print $mail.'<br>';
        print $name.'<br>';
        print $password;
    }
}
