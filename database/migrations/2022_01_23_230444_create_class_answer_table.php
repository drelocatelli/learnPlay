<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassAnswerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_answer', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_class_chapter')->index('id_class_chapter');
            $table->integer('id_question')->index('id_question');
            $table->integer('id_user')->index('id_user');
            $table->text('content');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_answer');
    }
}
