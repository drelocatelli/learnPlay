<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\User\UserAlert;
use App\Models\Group;
use App\Models\GroupUsers;
use App\Models\GroupArticleComment;
use App\Models\GroupArticles;

class UserController extends Controller
{

    public function user($user, $id){
        $find = User::where(['nome' => $user, 'id' => $id])->first();
        if((bool) $find){
            return view('painel.user.profile', compact('user', 'id', 'find'));
        }else{
            return view('painel.user.profile', ['user' => 'Usuário não existe']);
        }

    }

    public function notfound(){

        return view('painel.notfound');
    }


    public function changePhoto(Request $request){
        // trocar imagem

        if($request->hasfile('photo')){
            $request->validate([
                'photo' => 'required|image|mimes:jpeg,png,jpg,svg,bmp,webp,jfif',
            ]);

            $extension = $request->photo->extension();
            $name = Auth::user()->nome.'_'.Auth::user()->id.'.'.'png';
            $request->photo->move(public_path('img/userimg'), $name);

            // muda foto de perfil no banco
            User::where('id', Auth::user()->id)->update(['photo' => $name]);
            return back();
        }


    }



    public function settings(){
        return view('painel.user.settings');

    }

    public function dashboard(){
        return view('painel.dashboard');
    }


    public function notifyToggle($id){

        User::notifyToggle($id);

    }

}
