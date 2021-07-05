<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
    use HasFactory;

    protected $table = 'user';
    public $timestamps = false;
    
    protected $fillable = ['nome', 'email', 'senha'];
    
}
