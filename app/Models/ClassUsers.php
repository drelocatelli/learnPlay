<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassUsers extends Model
{
    use HasFactory;

    protected $table = 'class_users';

    public $timestamps = false;

    protected $fillable = ['id_class', 'id_user'];

    public static function getClassByUser($user){

        return ClassUsers::where('id_user', $user)
                        ->join('class', 'class_users.id_class', '=', 'class.id')
                        ->get();

    }

    public static function leave($data){

        return ClassUsers::where($data)->delete();

    }

    public static function matricular($data){

        return ClassUsers::firstOrCreate($data);

    }

    public static function getClassUsers($id){

        return ClassUsers::where('id_class', $id)->get();

    }

}
