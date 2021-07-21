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

    public static function getClassUsers($id){

        return ClassUsers::where('id_class', $id)->get();

    }

}
