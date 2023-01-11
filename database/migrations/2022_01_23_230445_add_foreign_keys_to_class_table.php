<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToClassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('class', function (Blueprint $table) {
            $table->foreign(['id_admin'], 'class_ibfk_1')->references(['id'])->on('user')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['id_group'], 'class_ibfk_3')->references(['id'])->on('group');
            $table->foreign(['id_categoria'], 'class_ibfk_2')->references(['id'])->on('category')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('class', function (Blueprint $table) {
            $table->dropForeign('class_ibfk_1');
            $table->dropForeign('class_ibfk_3');
            $table->dropForeign('class_ibfk_2');
        });
    }
}
