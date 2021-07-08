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


}
