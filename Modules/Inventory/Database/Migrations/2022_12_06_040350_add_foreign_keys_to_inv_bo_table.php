<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToInvBoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inv_bo', function (Blueprint $table) {
            $table->foreign(['po_id'], 'inv_bo_ibfk_2')->references(['id'])->on('inv_po')->onUpdate('CASCADE')->onDelete('RESTRICT');
            $table->foreign(['supplier_id'], 'inv_bo_ibfk_1')->references(['id'])->on('inv_suppliers')->onUpdate('CASCADE')->onDelete('RESTRICT');
            $table->foreign(['receiving_id'], 'inv_bo_ibfk_3')->references(['id'])->on('inv_receivings')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inv_bo', function (Blueprint $table) {
            $table->dropForeign('inv_bo_ibfk_2');
            $table->dropForeign('inv_bo_ibfk_1');
            $table->dropForeign('inv_bo_ibfk_3');
        });
    }
}
