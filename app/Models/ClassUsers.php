<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Classes;
use App\Models\User;

class ClassUsers extends Model
{
    use HasFactory;

    protected $table = 'class_users';

    public $timestamps = false;

    protected $fillable = ['id_class', 'id_user'];

    public function classes(){

        $class = $this->belongsTo(Classes::class, 'id_class');

        return $class;

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
