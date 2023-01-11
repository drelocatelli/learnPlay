<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupArticleComment extends Model
{
    use HasFactory;

    protected $table = 'group_article_comment';
    public $timestamps = false;

    protected $fillable = ['id_group', 'id_article', 'id_user', 'body'];

    public static function deleteArticleComment($data = []){

        GroupArticleComment::where([
                'id' => $data['id'],
                'id_article' => $data['id_post'],
                'id_group' => $data['id_group'],
                'id_user' => $data['id_user']
            ])->delete();

            return back();
    }

}
