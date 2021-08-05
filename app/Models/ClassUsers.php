<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Classes;

class ClassUsers extends Model
{
    use HasFactory;

    protected $table = 'class_users';

    public $timestamps = false;

    protected $fillable = ['id_class', 'id_user'];

    public static function getClassByUser($user){

        $class = Classes::where('class.id_admin', $user)
                        ->join('class_users', 'class_users.id_class', '=', 'class.id')
                        ->orWhere('class_users.id_user', $user);

        return $class->get();

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
