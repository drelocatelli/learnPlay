<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToClassUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('class_users', function (Blueprint $table) {
            $table->foreign(['id_user'], 'class_users_ibfk_1')->references(['id'])->on('user')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['id_class'], 'class_users_ibfk_2')->references(['id'])->on('class')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('class_users', function (Blueprint $table) {
            $table->dropForeign('class_users_ibfk_1');
            $table->dropForeign('class_users_ibfk_2');
        });
    }
}
