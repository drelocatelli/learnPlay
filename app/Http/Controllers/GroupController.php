<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\User\UserAlert;
use App\Models\Group;
use App\Models\GroupUsers;
use App\Models\GroupArticleComment;
use App\Models\GroupArticles;

class GroupController extends Controller
{
    //

    public function groups(){
        return view('painel.groups.groups');
    }

    public function groups_admin(){
        return view('painel.groups.adminGroups');
    }

    public function verify_userInGroup($id_group){
        return GroupUsers::join('group', 'group.id', '=', 'group_users.id_grupo')
                        ->where('group_users.id_user', Auth::user()->id)
                        ->where('group.id', $id_group)
                        ->first();
    }

    public function verify_userAdmin($id_group){
        return GroupUsers::join('group', 'group.id', '=', 'group_users.id_grupo')
                        ->where('group_users.id_user', Auth::user()->id)
                        ->where('group_users.admin', 'true')
                        ->where('group.id', $id_group)
                        ->first();
    }

    public function group_addMembers(Request $request){
        $verifyUserAdmin = (bool) $this->verify_userAdmin($request->id);

        if($verifyUserAdmin){

            $members = explode(",", $request->group_members);
            $members = explode(", ", $request->group_members);

            return GroupUsers::addMembers($members, $request->id, Auth::user()->id);


        }
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
        return view('painel.groups.groupList');
    }

    public function group_changeThumbnail(Request $request){
        $verifyUserAdmin = (bool) $this->verify_userAdmin($request->id);

        if($verifyUserAdmin && $request->hasfile('group_thumbnail')){
                $data = $request->validate([
                    'group_thumbnail' => 'required|image|mimes:gif,jpeg,png,jpg,svg,bmp,webp,jfif',
                ]);

                $extension = $request->group_thumbnail->extension();
                $name = 'groupId_'.$request->id.'.'.'png';
                $request->group_thumbnail->move(public_path('img/groups'), $name);

                $data = [
                    'group_thumbnail' => $name
                ];

                // muda foto thumbnail no banco
                Group::renameGroup($data, $request->id, 'thumbnail');
                return back();
            }
    }

    public function group_changeVisibility(Request $request){
        $verifyUserAdmin = (bool) $this->verify_userAdmin($request->id);

        if($verifyUserAdmin){
            $data = $request->validate([
                'group_visibility' => 'required'
            ]);

            return Group::renameGroup($data, $request->id, 'visibility');
        }
    }

    public function group_changeTitle(Request $request){
        $verifyUserAdmin = (bool) $this->verify_userAdmin($request->id);

        if($verifyUserAdmin){

            $data = $request->validate([
                'group_title' => 'required'
            ]);

            Group::renameGroup($data, $request->id, 'title');

        }

    }

    public function group_changeDescription(Request $request){
        $verifyUserAdmin = (bool) $this->verify_userAdmin($request->id);

        if($verifyUserAdmin){

            $data = $request->validate([
                'group_description' => 'required'
            ]);

            Group::renameGroup($data, $request->id, 'description');

        }

    }

    public function group_page(Request $request, $title, $id){

        return view('painel.groups.groupPage', compact('title', 'id'));
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

        return view('painel.groups.groupNew');


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

        return view('painel.groups.groupArticle', compact('title', 'id', 'article'));
    }

    public function group_leave($title, $id){
        $user = new User();
        return $user->leave_group($id);
    }

    public function group_enter($title, $id){
        $user = new User();
        return $user->enter_group($id);
    }

    public function group_promoteAdmin(Request $request){
        $verifyUserAdmin = (bool) $this->verify_userAdmin($request->id);

        if($verifyUserAdmin){
            GroupUsers::addAdmin($request->id, $request->id_user);
            return back();
        }

    }

    public function group_removeMember(Request $request){
        $verifyUserAdmin = (bool) $this->verify_userAdmin($request->id);

        if($verifyUserAdmin){
            GroupUsers::removeMember($request->id, $request->id_user);
            return back();
        }

    }
}
