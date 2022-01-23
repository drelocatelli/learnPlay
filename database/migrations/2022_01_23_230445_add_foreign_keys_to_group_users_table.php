<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToGroupUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('group_users', function (Blueprint $table) {
            $table->foreign(['id_grupo'], 'group_users_ibfk_1')->references(['id'])->on('group')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['id_user'], 'group_users_ibfk_2')->references(['id'])->on('user')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('group_users', function (Blueprint $table) {
            $table->dropForeign('group_users_ibfk_1');
            $table->dropForeign('group_users_ibfk_2');
        });
    }
}
