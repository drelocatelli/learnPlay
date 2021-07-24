<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\ClassUsers;

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

    public static function getClasses($name = null, $restricao = null){
        $classes = Classes::join('category', 'class.id_categoria', '=', 'category.id')
                            ->select('class.*', 'category.nome as category_name');

        if($name != null){
            $classes = $classes->where('category.nome', $name);
        }

        if($restricao == 'group'){
            $classes = $classes->where('class.tipo_restricao', 'group');
        }else{
            $classes = $classes->where(function($query){
                                $query->where('class.tipo_restricao', 'password')
                                ->orWhere('class.tipo_restricao', null);
                            });
        }

        return $classes->orderBy('class.id', 'desc')->paginate(3);

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
