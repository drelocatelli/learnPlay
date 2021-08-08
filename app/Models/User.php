<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\GroupUse;

use App\Models\User\UserAlert;
use App\Models\Group;
use App\Models\GroupArticles;
use App\Models\Classes;
use App\Models\GroupArticleComment;
use App\Models\Category;

class User extends Authenticatable {
    use HasFactory;

    protected $table = 'user';
    public $timestamps = false;

    protected $fillable = ['nome', 'email', 'senha'];

    public function alerts(){

        return $this->hasMany(UserAlert::class, 'id_user')->limit(10);

    }

    public function getUser($id){
        return $this->where('id', $id)->first();
    }

    // ---------------------------------------------- CLASS


    public function getAllCategories(){
        return Category::all();
    }

    public function getClassUsers($id){
        return Classusers::getClassUsers($id);
    }


    // ---------------------------------------------- GROUP

    public function get_Comment($idGroup, $article){

        return GroupArticleComment::where([
            'id_group' => $idGroup,
            'id_article' => $article
        ])
        ->join('user', 'user.id', '=', 'id_user')
        ->orderBy('group_article_comment.id', 'DESC')
        ->select('*', 'group_article_comment.id as id_comment')
        ->get();

    }

    public function getArticle($id, $id_group){
        return GroupArticles::where([
                'group_article.id' => $id,
                'group_article.id_group' => $id_group
            ])
            ->join('user', 'group_article.id_user', '=', 'user.id')
            // ->select('*', 'group_article.id as id_article')
            ->first();
    }

    public function group_users($id){
        $groupUsers = GroupUsers::where('id_grupo', $id);

        return $groupUsers;
    }

    public function group_isAdmin($id, $userId){

        $groupUser = GroupUsers::where([
                'id_grupo' => $id,
                'id_user' => $userId
            ])
            ->first();

        if($groupUser && $groupUser->admin == "true"){
            return true;
        }else{
            return false;
        }

    }


    public function leave_group($id_group){
        $group = Group::where('id', $id_group)->first();
        $result = GroupUsers::where('id_grupo', $id_group)
        ->where('id_user', Auth::user()->id)
        ->first();

        if($result){
            $result->delete();
        }

        if($group->visibility == "public"){
            return back();
        }else{
            return redirect()->route('dashboard.groups');
        }

    }

    public function enter_group($id_group){
        $result = Group::where('id', $id_group)->first();
        $group_user = GroupUsers::where('id_grupo', $result->id);

        if($result){
            $group_user->where('id_user', Auth::user()->id)->firstOrCreate([
                'id_grupo' => $result->id,
                'id_user' => Auth::user()->id
            ]);

            UserAlert::where('alert', 'Você entrou no grupo '.$result->title.'.')->firstOrCreate(['id_user' => Auth::user()->id, 'alert' => 'Você entrou no grupo '.$result->title.'.']);
        }

        return back();

    }

    public function get_all_group_users($id){
        $groupUsers = GroupUsers::where('id_grupo', $id)
                    ->get();

        return $groupUsers;
    }

    public function get_group_all_users(){
        $id = request()->id;
        $groupUsers = GroupUsers::where('id_grupo', $id)
                    ->join('user', 'group_users.id_user', '=', 'user.id')
                    ->orderBy('group_users.id', 'ASC');

        return $groupUsers->get();
    }

    public function get_group_users(){
        $id = request()->id;
        $groupUsers = GroupUsers::where('id_grupo', $id)->where('admin','false')->join('user', 'group_users.id_user', '=', 'user.id')->orderBy('group_users.id', 'ASC');

        return $groupUsers->get();
    }

    public function group_admin(){
        $id = request()->id;
        $groupAdmin = GroupUsers::where('id_grupo', $id)->where('admin', 'true')->join('user', 'group_users.id_user', '=', 'user.id')->orderBy('group_users.id', 'ASC');

        // poe o ultimo usuário como administrador
        if($groupAdmin->count() == 0){
            $lastUser = GroupUsers::join('user', 'group_users.id_user', '=', 'user.id')
                        ->where('group_users.id_grupo', $id)
                        ->first();
            GroupUsers::where('id_user', $lastUser->id_user)->update(['admin' => 'true']);
        }

        return $groupAdmin->get();
    }

    public function get_group(){
        $groupUsers = $this->hasMany(GroupUsers::class, 'id_user');
        $groups = $groupUsers->join('group', 'group_users.id_grupo', '=', 'group.id')->orderByDesc('group.id');

        return $groups->where('group.id', request()->id);

    }

    public function get_all_groups(){

        return Group::where('visibility','public')
                    ->paginate(50);

    }

    public function groups($id = null){
        $groupUsers = $this->hasMany(GroupUsers::class, 'id_user');
        $groups = $groupUsers->join('group', 'group_users.id_grupo', '=', 'group.id');

        if($id === null){
            return $groups->where('id_user', Auth::user()->id)->orderBy('group_users.timestamp','DESC');
        }else{
            return $this->group_users($id);
        }

    }

    public function group_page(){
        $id = request()->id;
        $title = urldecode(request()->title);


        // deleta se o grupo não haver membros
        if($this->groups($id)->count() == 0){
            Group::where('id', $id)->delete();
            return redirect()->route('dashboard.groups');
        }

        $group_page = $this->groups($id)->join('group', 'group_users.id_grupo', '=', 'group.id')->orderByDesc('group.id');

        return $group_page->first();

    }

    public function emoticon($transform){

        $emoticon = array();
        $emoticon[1] = ['nazismo','=D',':D','><','xD','T_T',':P', ':b',':(',':\'(','>.>', '<.<','merda','cocô','bosta',':3',':o',':O','puta','putaria','desgraça','vagabunda','sexo','buceta','ok','OK','Ok'];
        $emoticon[2] = ['卐','😄','😄','😆','😆','😭','😜', '😜','😔','🥲','👀', '👀','💩','💩','💩','😮','😮','🤬','🤬','🤬','🤬','🤬','🤬','🤬','👌','👌','👌'];

        $transform = str_ireplace($emoticon[1], $emoticon[2], $transform);

        return $transform;

    }

    public function group_article(){

        $group_article = $this->get_group()
                        ->join('group_article', 'group_article.id_group', '=', 'group.id')
                        ->join('user', 'group_article.id_user', '=', 'user.id')
                        ->select('*', 'group_article.id as id_article')
                        ->orderBy('group_article.id','DESC')
                        ->get();

        return $group_article;
    }


    public function management_groups(){

        return $this->groups()->where('admin', 'true');

    }

    public static function notifyToggle($id){
        $notify = UserAlert::where('id', $id)->where('id_user', Auth::user()->id)->first();
        if($notify->status == 0){
            $notify->update(['status' => '1']);
            return $notify;
        }else if($notify->status == 1){
            $notify->update(['status' => '0']);
            return $notify;
        }
    }

    public function notification(){

        $notify = $this->alerts()->orderByDesc('id')->get();

        return $notify;

    }

}
