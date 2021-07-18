<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GroupUsers;

class Group extends Model
{
    use HasFactory;

    protected $table = 'group';
    public $timestamps = false;

    protected $fillable = ['title', 'description', 'thumbnail', 'visibility'];

    public static function renameGroup($data = [], $idGroup, $option){

        switch($option){
            case 'title':
                return Group::where('id', $idGroup)->update(['title' => $data['group_title']]);
            break;
            case 'description':
                return Group::where('id', $idGroup)->update(['description' => $data['group_description']]);
            break;
        }


    }

    public static function newGroup($data = [], $authUser){
        $newGroup = Group::create($data);

        $newGroupAdmin = GroupUsers::create([
            'id_grupo' => $newGroup->id,
            'id_user' => $authUser,
            'admin' => 'true'
        ]);

        return [$newGroup->title, $newGroupAdmin->id_grupo];

    }

}
