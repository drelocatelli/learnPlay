<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class RegisterController extends Controller {
    

    public function register(Request $request){

        dd($request->all());
        return view('register');
    }

    public function error(){
        return view('register');
    }

    public function success(){
        return view('register');
    }
    
}
