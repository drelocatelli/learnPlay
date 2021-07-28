<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupUsers extends Model
{
    use HasFactory;

    protected $table = 'group_users';
    public $timestamps = false;

    protected $fillable = ['id_grupo', 'id_user', 'admin'];


    public static function addMembers($data = [], $groupId, $userAuth){

        foreach($data as $member){
            $getUserId = User::where('email', $member)->first()->id;

            if($getUserId && $getUserId !== $userAuth){
                GroupUsers::firstOrCreate([
                    'id_grupo' => $groupId,
                    'id_user' => $getUserId
                ]);
            }

        }

    }

    public static function addAdmin($groupId, $userAuth){

        return GroupUsers::where([
            'id_grupo' => $groupId,
            'id_user' => $userAuth
        ])->update(['admin' => 'true']);

    }

    public static function removeMember($groupId, $userAuth){

        return GroupUsers::where([
            'id_grupo' => $groupId,
            'id_user' => $userAuth
        ])->delete();

    }


}
