<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToGroupArticleCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('group_article_comment', function (Blueprint $table) {
            $table->foreign(['id_user'], 'group_article_comment_ibfk_4')->references(['id'])->on('user')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['id_user'], 'group_article_comment_ibfk_1')->references(['id'])->on('user')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['id_group'], 'group_article_comment_ibfk_3')->references(['id'])->on('group')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['id_article'], 'group_article_comment_ibfk_2')->references(['id'])->on('group_article')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('group_article_comment', function (Blueprint $table) {
            $table->dropForeign('group_article_comment_ibfk_4');
            $table->dropForeign('group_article_comment_ibfk_1');
            $table->dropForeign('group_article_comment_ibfk_3');
            $table->dropForeign('group_article_comment_ibfk_2');
        });
    }
}
