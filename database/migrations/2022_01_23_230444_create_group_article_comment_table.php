<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupArticleCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_article_comment', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_group')->index('id_group');
            $table->integer('id_article')->index('id_article');
            $table->integer('id_user')->index('id_user');
            $table->text('body');
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
        Schema::dropIfExists('group_article_comment');
    }
}
