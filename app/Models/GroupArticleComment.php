<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupArticleComment extends Model
{
    use HasFactory;

    protected $table = 'group_article_comment';
    public $timestamps = false;

    protected $fillable = ['id_group', 'id_user', 'id_article', 'body'];
}
