<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupArticles extends Model
{
    use HasFactory;

    protected $table = 'group_article';
    public $timestamps = false;

    protected $fillable = ['id_group', 'id_user', 'body'];

    public static function newArticle($data = []){

        return GroupArticles::create($data);

    }

    public static function deleteArticle($data = []){

        GroupArticles::where([
                'id' => $data['id_post'],
                'id_group' => $data['id_group'],
                'id_user' => $data['id_user']
            ])->delete();

            return back();
    }

}
