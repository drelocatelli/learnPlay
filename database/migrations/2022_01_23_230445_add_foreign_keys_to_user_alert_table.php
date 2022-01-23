<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToUserAlertTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_alert', function (Blueprint $table) {
            $table->foreign(['id_user'], 'user_alert_ibfk_1')->references(['id'])->on('user')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_alert', function (Blueprint $table) {
            $table->dropForeign('user_alert_ibfk_1');
        });
    }
}
