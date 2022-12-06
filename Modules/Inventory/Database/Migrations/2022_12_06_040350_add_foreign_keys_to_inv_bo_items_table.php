<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToInvBoItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inv_bo_items', function (Blueprint $table) {
            $table->foreign(['item_id'], 'inv_bo_items_ibfk_2')->references(['id'])->on('inv_items')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['bo_id'], 'inv_bo_items_ibfk_1')->references(['id'])->on('inv_bo')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inv_bo_items', function (Blueprint $table) {
            $table->dropForeign('inv_bo_items_ibfk_2');
            $table->dropForeign('inv_bo_items_ibfk_1');
        });
    }
}
