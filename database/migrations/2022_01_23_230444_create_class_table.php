<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_admin')->index('id_admin');
            $table->string('titulo', 1000);
            $table->text('descricao');
            $table->text('thumbnail')->nullable();
            $table->integer('id_categoria')->index('id_categoria');
            $table->integer('id_group')->nullable()->index('id_group');
            $table->string('tipo_restricao', 1000)->nullable();
            $table->text('password')->nullable();
            $table->timestamp('timestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class');
    }
}
