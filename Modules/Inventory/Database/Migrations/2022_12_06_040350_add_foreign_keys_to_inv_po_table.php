<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToInvPoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inv_po', function (Blueprint $table) {
            $table->foreign(['supplier_id'], 'inv_po_ibfk_1')->references(['id'])->on('inv_suppliers')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inv_po', function (Blueprint $table) {
            $table->dropForeign('inv_po_ibfk_1');
        });
    }
}
