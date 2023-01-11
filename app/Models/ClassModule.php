<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassModule extends Model
{
    use HasFactory;

    protected $table = 'class_module';

    public $timestamps = false;

    protected $fillable = [
        'id_class',
        'title'
    ];


    public function chapters(){
        $chapters = $this->hasMany(ClassChapter::class, 'id_module');

        return $chapters;
    }

}
