<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassChapter extends Model
{
    use HasFactory;

    protected $table = 'class_chapter';

    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'id_class',
        'id_module',
        'title',
        'content'
    ];
}
