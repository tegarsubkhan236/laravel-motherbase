<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToInvStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inv_stocks', function (Blueprint $table) {
            $table->foreign(['item_id'], 'inv_stocks_ibfk_1')->references(['id'])->on('inv_items')->onUpdate('CASCADE')->onDelete('CASCADE');
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
            $table->dropForeign('inv_stocks_ibfk_1');
        });
    }
}
