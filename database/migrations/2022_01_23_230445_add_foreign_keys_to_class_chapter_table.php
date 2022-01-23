<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToClassChapterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('class_chapter', function (Blueprint $table) {
            $table->foreign(['id_class'], 'class_chapter_ibfk_1')->references(['id'])->on('class')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['id_user'], 'class_chapter_ibfk_3')->references(['id'])->on('user')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['id_module'], 'class_chapter_ibfk_2')->references(['id'])->on('class_module')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('class_chapter', function (Blueprint $table) {
            $table->dropForeign('class_chapter_ibfk_1');
            $table->dropForeign('class_chapter_ibfk_3');
            $table->dropForeign('class_chapter_ibfk_2');
        });
    }
}
