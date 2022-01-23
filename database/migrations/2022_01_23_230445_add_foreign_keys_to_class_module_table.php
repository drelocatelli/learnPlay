<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToClassModuleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('class_module', function (Blueprint $table) {
            $table->foreign(['id_class'], 'class_module_ibfk_1')->references(['id'])->on('class')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('class_module', function (Blueprint $table) {
            $table->dropForeign('class_module_ibfk_1');
        });
    }
}
