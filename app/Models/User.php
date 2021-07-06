<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\User\UserAlert;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable {
    use HasFactory;

    protected $table = 'user';
    public $timestamps = false;

    protected $fillable = ['nome', 'email', 'senha'];

    public function alerts(){

        return $this->hasMany(UserAlert::class, 'id_user')->limit(10);

    }

    public function notification(){

        $notify = $this->alerts()->where('id_user', Auth::user()->id)->orderByDesc('id')->get();

        return $notify;

    }

}
