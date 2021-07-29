<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAlert extends Model
{
    use HasFactory;


    protected $table = 'user_alert';
    public $timestamps = false;

    protected $fillable = ['id_user', 'alert', 'status'];

    public static function newAlert($msg, $user){

        UserAlert::firstOrCreate([
            'id_user' => $user,
            'alert' => $msg
        ]);

    }

}
