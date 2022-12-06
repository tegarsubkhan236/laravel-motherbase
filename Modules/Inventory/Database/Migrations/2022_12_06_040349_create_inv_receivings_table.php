<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvReceivingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inv_receivings', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('from_id');
            $table->text('from_order');
            $table->float('amount', 10, 0);
            $table->float('discount_perc', 10, 0)->nullable();
            $table->float('discount', 10, 0)->nullable();
            $table->float('tax_perc', 10, 0)->nullable();
            $table->float('tax', 10, 0)->nullable();
            $table->text('stock_ids');
            $table->text('description')->nullable();
            $table->date('created_at')->nullable();
            $table->date('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inv_receivings');
    }
}
