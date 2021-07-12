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
