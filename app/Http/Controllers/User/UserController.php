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

    public function groups_admin(){
        return view('painel.adminGroups');
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

    public function verify_userInGroup($id_group){
        return GroupUsers::join('group', 'group.id', '=', 'group_users.id_grupo')
                        ->where('group_users.id_user', Auth::user()->id)
                        ->where('group.id', $id_group)
                        ->first();
    }

    public function group_post_delete(Request $request){

        $verifyUser = $this->verify_userInGroup($request->id);

        if($verifyUser){
            return GroupArticles::deleteArticle([
                'id_group' => $request->id,
                'id_user' => Auth::user()->id,
                'id_post' => $request->id_article
            ]);
        }

        return redirect()->back();

    }

    public function group_post_commentDelete(Request $request){

        $verifyUser = $this->verify_userInGroup($request->id);

        if($verifyUser){
            return GroupArticleComment::deleteArticleComment([
                'id' => $request->id_comment,
                'id_group' => $request->id,
                'id_user' => Auth::user()->id,
                'id_post' => $request->id_article
            ]);
        }

        return redirect()->back();

    }


    public function group_post(Request $request){

        $verifyUser = $this->verify_userInGroup($request->id_group);

        if($verifyUser){
            $data = $request->validate([
                'id_group' => 'required|alpha_num',
                'body' => 'required|string',
            ]);

            GroupArticles::newArticle([
                'id_group' => $data['id_group'],
                'id_user' => Auth::user()->id,
                'body' => $data['body']
            ]);

        }

        return back();

    }

    public function group_public(){
        return view('painel.groupList');
    }

    public function group_page($title, $id){
        return view('painel.groupPage', compact('title', 'id'));
    }

    public function group_new(Request $request){


        if($request->POST()){

            $data = $request->validate([
                'title' => 'required',
                'description' => 'string',
                'visibility' => 'string'
            ]);

            $newGroup = Group::newGroup($data, Auth::user()->id);

            return redirect()->route('dashboard.groups.page', [$newGroup[0], $newGroup[1]]);
        }

        return view('painel.groupNew');


    }

    public function group_comment(Request $request){

        $verifyUser = $this->verify_userInGroup($request->id_group);

        $title = $request->title;
        $id = $request->id;
        $article = $request->article;

        if($verifyUser && $request->POST()){

            $requests = $request->validate([
                'id_group' => 'required|alpha_num',
                'body' => 'required|string'
            ]);

            $params = [
                'id_article' => $article,
                'id_user' => Auth::user()->id,
            ];

            $data = array_merge($requests, $params);

            GroupArticles::articleRes($data);

            return back();
        }

        return view('painel.groupArticle', compact('title', 'id', 'article'));
    }

    public function group_leave($title, $id){
        $user = new User();
        return $user->leave_group($id);
    }

    public function group_enter($title, $id){
        $user = new User();
        return $user->enter_group($id);
    }

    public function settings(){
        return view('painel.user.settings');

    }

    public function dashboard(){
        return view('painel.dashboard');
    }

    public function groups(){
        return view('painel.groups');
    }

    public function class(){
        return view('painel.class');
    }

    public function articles(){
        return view('painel.articles');
    }

    public function content(){
        return view('painel.content');
    }

    public function notifyToggle($id){

        User::notifyToggle($id);

    }

}
