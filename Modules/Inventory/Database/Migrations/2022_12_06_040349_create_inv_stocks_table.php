<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inv_stocks', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('item_id')->index('item_id');
            $table->integer('quantity');
            $table->string('unit', 50);
            $table->float('price', 10, 0);
            $table->float('total', 10, 0);
            $table->tinyInteger('type');
            $table->date('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inv_stocks');
    }
}
