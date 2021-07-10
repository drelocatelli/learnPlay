<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\User\UserAlert;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class User extends Authenticatable {
    use HasFactory;

    protected $table = 'user';
    public $timestamps = false;

    protected $fillable = ['nome', 'email', 'senha'];

    public function alerts(){

        return $this->hasMany(UserAlert::class, 'id_user')->limit(10);

    }

    public function group_users($id){
        $groupUsers = GroupUsers::where('id_grupo', $id);

        return $groupUsers;
    }

    public function get_group_users(){
        $id = request()->id;
        $groupUsers = GroupUsers::where('id_grupo', $id)->where('admin','false')->join('user', 'group_users.id_user', '=', 'user.id')->orderBy('group_users.id', 'ASC');

        return $groupUsers->get();
    }

    public function group_admin(){
        $id = request()->id;
        $groupAdmin = GroupUsers::where('id_grupo', $id)->where('admin', 'true')->join('user', 'group_users.id_user', '=', 'user.id')->orderBy('group_users.id', 'ASC');

        return $groupAdmin->get();
    }

    public function get_group(){
        $groupUsers = $this->hasMany(GroupUsers::class, 'id_user');
        $groups = $groupUsers->join('group', 'group_users.id_grupo', '=', 'group.id')->orderByDesc('group.id');

        return $groups->where('group.id', request()->id);

    }

    public function groups($id = null){
        $groupUsers = $this->hasMany(GroupUsers::class, 'id_user');
        $groups = $groupUsers->join('group', 'group_users.id_grupo', '=', 'group.id')->orderByDesc('group.id');

        if($id === null){
            return $groups->where('id_user', Auth::user()->id);
        }else{
            return $this->group_users($id);
        }

    }

    public function group_page(){
        $id = request()->id;
        $title = urldecode(request()->title);

        $group_page = $this->groups($id)->join('group', 'group_users.id_grupo', '=', 'group.id')->orderByDesc('group.id')->where('group.title', $title);

        return $group_page->first();

    }

    public function emoticon($transform){

        $emoticon = array();
        $emoticon[1] = ['=D',':D','><','xD','T_T',':P', ':b',':(',':\'(','>.>', '<.<','merda',':3',':o',':O','puta','putaria','desgraça','vagabunda'];
        $emoticon[2] = ['😄','😄','😆','😆','😭','😜', '😜','😔','🥲','👀', '👀','💩','😮','😮','🤬','🤬','🤬','🤬'];

        $transform = str_replace($emoticon[1], $emoticon[2], $transform);

        return $transform;

    }

    public function group_article(){

        $group_article = $this->get_group()->join('group_article', 'group_article.id_group', '=', 'group.id');
        $group_article = $group_article->join('user', 'group_article.id_user', '=', 'user.id')->orderBy('group_article.id','DESC');
        $group_article = $group_article->get();

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
