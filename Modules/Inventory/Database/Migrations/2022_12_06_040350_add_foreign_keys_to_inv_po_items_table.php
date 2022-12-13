<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToInvPoItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inv_po_items', function (Blueprint $table) {
            $table->foreign(['item_id'], 'inv_po_items_ibfk_2')->references(['id'])->on('inv_items')->onUpdate('CASCADE')->onDelete('RESTRICT');
            $table->foreign(['po_id'], 'inv_po_items_ibfk_1')->references(['id'])->on('inv_po')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inv_po_items', function (Blueprint $table) {
            $table->dropForeign('inv_po_items_ibfk_2');
            $table->dropForeign('inv_po_items_ibfk_1');
        });
    }
}
