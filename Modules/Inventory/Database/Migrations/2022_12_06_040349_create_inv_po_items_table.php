<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvPoItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inv_po_items', function (Blueprint $table) {
            $table->integer('po_id')->index('po_id');
            $table->integer('item_id')->index('item_id');
            $table->integer('quantity');
            $table->float('price', 10, 0);
            $table->string('unit', 50)->nullable();
            $table->float('total', 10, 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inv_po_items');
    }
}
