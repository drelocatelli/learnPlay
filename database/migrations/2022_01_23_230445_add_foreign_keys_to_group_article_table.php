<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToGroupArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('group_article', function (Blueprint $table) {
            $table->foreign(['id_group'], 'group_article_ibfk_1')->references(['id'])->on('group')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['id_user'], 'group_article_ibfk_2')->references(['id_user'])->on('group_users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('group_article', function (Blueprint $table) {
            $table->dropForeign('group_article_ibfk_1');
            $table->dropForeign('group_article_ibfk_2');
        });
    }
}
