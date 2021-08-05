<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\ClassUsers;
use App\Models\ClassModule;

class Classes extends Model
{
    use HasFactory;

    protected $table = 'class';

    public $timestamps = false;

    protected $fillable = [
        'id_admin',
        'titulo',
        'descricao',
        'thumbnail',
        'id_categoria',
        'tipo_restricao',
        'id_group',
        'password'
    ];

    public static function getModules($id){

        $modules = ClassChapter::join('class_module', function($query){
                    $query->on('class_module.id_class', '=', 'class_chapter.id_class');
                    $query->on('class_module.id', '=', 'class_chapter.id_module');
                })
                ->select('*', 'class_chapter.title as class_chapter_title')
                ->where('class_module.id_class', $id)
                ->get();

        $modules = $modules->groupBy('id_module');

        return $modules;

    }

    public static function getClasses($category = null, $restricao = null){
        $classes = Classes::join('category', 'class.id_categoria', '=', 'category.id')
                            ->select('class.*', 'category.nome as category_name');

        if($restricao == 'group'){
            $classes = $classes->where('class.tipo_restricao', 'group');
        }else{
            $classes = $classes->where(function($query){
                                $query->where('class.tipo_restricao', 'password')
                                ->orWhere('class.tipo_restricao', null);
                            });
        }

        $classes = $classes->orderBy('class.id', 'desc');

        if($category != null){
            $classes = $classes->where('category.nome', $category)->paginate(3);
        }else{
            $classes = $classes->paginate(3);
        }

        return $classes;

    }

    public static function getClassById($id, $restricao = null){

        $classes = Classes::join('category', 'class.id_categoria', '=', 'category.id')
        ->join('user', 'class.id_admin', 'user.id')
        ->select('class.*', 'user.nome', 'user.photo', 'category.nome as category_name');

        if($restricao == 'group'){
            $classes = $classes->where('class.tipo_restricao', 'group');
        }else{
            $classes = $classes->where(function($query){
                                $query->where('class.tipo_restricao', 'password')
                                ->orWhere('class.tipo_restricao', null);
                        });
        }

        $classes = $classes->where('class.id', $id);

        return $classes->first();

    }

    public static function getClassUsers($id){

        return Classusers::select('user.id', 'user.nome', 'user.photo')
                        ->where('class_users.id_class', $id)
                        ->join('user', 'user.id', '=', 'class_users.id_user')
                        ->get();

    }


    public static function searchClass($name){

        $classes = Classes::join('user', 'class.id_admin', '=', 'user.id')
                            ->join('category', 'category.id', '=', 'class.id_categoria')
                            ->select('*', 'class.id as id', 'category.nome AS category_name', 'user.id AS user_id');

        // ordering by best result

        $filter = $classes->where('class.titulo', 'LIKE', "%$name%")
                        ->orWhere('user.nome', 'LIKE', "%$name%")
                        ->orderByRaw('CASE
                                    WHEN class.titulo LIKE "'.$name.'" THEN 1
                                    WHEN class.titulo LIKE "'.$name.'%" THEN 2
                                    WHEN class.titulo LIKE "%'.$name.'%" THEN 3
                                    WHEN class.titulo LIKE "%'.$name.'" THEN 4
                                    ELSE 5
                                    END')
                        ->get();

        $filter = $filter->where('tipo_restricao', '<>', 'group');

        return $filter;
    }

}
