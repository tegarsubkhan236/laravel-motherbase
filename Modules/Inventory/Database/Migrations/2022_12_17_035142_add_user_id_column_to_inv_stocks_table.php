<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdColumnToInvStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inv_stocks', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->index('user_id')->after('item_id');
            $table->foreign(['user_id'], 'inv_stocks_ibfk_2')->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inv_stocks', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropForeign('inv_stocks_ibfk_2');
        });
    }
}
