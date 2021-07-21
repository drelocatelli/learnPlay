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

    public static function getClasses($name = null){
        if($name == null){
            return Classes::join('category', 'class.id_categoria', '=', 'category.id')
                            ->select('class.*', 'category.nome as category_name')
                            ->get();
        }else{
            return Classes::join('category', 'class.id_categoria', '=', 'category.id')
                            ->select('*', 'category.nome as category_name')
                            ->where('category.nome', $name)
                            ->get();
        }

    }

}
