<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\User\UserAlert;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable {
    use HasFactory;

    protected $table = 'user';
    public $timestamps = false;

    protected $fillable = ['nome', 'email', 'senha'];

    public function alerts(){

        return $this->hasMany(UserAlert::class, 'id_user')->limit(10);

    }

    public function groups($id = null){

        if($id === null){
            $groupUsers = $this->hasMany(GroupUsers::class, 'id_user');
            $groups = $groupUsers->join('group', 'group_users.id_grupo', '=', 'group.id')->orderByDesc('group.id');
            return $groups;

        }else{
            $groupUsers = GroupUsers::where('id_grupo', $id);

            return $groupUsers;
        }


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
