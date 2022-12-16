<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToInvReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inv_returns', function (Blueprint $table) {
            $table->foreign(['supplier_id'], 'inv_returns_ibfk_1')->references(['id'])->on('inv_suppliers')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inv_returns', function (Blueprint $table) {
            $table->dropForeign('inv_returns_ibfk_1');
        });
    }
}
