<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvPoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inv_po', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('supplier_id')->index('supplier_id');
            $table->string('po_code', 50);
            $table->float('amount', 10, 0);
            $table->float('discount_perc', 10, 0)->nullable();
            $table->float('discount', 10, 0)->nullable();
            $table->float('tax_perc', 10, 0)->nullable();
            $table->float('tax', 10, 0)->nullable();
            $table->text('remarks')->nullable();
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('inv_po');
    }
}
