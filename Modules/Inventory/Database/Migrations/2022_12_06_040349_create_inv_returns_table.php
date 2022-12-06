<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inv_returns', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('supplier_id')->index('supplier_id');
            $table->string('return_code', 50);
            $table->text('remarks')->nullable();
            $table->text('stock_ids');
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
        Schema::dropIfExists('inv_returns');
    }
}
