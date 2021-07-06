<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\User\UserAlert;

class UserController extends Controller
{

    public function user($user){

        return view('painel.user.profile', compact('user'));

    }

    public function dashboard(){
        return view('painel.dashboard');
    }

    public function notifyToggle($id){
        $notify = UserAlert::where('id', $id)->where('id_user', Auth::user()->id)->first();
        if($notify->status == 0){
            $notify->update(['status' => '1']);
            return $notify;
        }else if($notify->status == 1){
            $notify->update(['status' => '0']);
            return $notify;
        }
    }

}
