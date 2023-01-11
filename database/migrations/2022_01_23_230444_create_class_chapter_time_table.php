<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassChapterTimeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_chapter_time', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_user')->index('id_user');
            $table->integer('id_class')->index('id_class');
            $table->integer('id_class_module')->index('id_class_module');
            $table->integer('id_class_chapter')->index('id_class_chapter');
            $table->text('time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_chapter_time');
    }
}
