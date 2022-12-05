<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToBlogPostCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blog_post_category', function (Blueprint $table) {
            $table->foreign(['postId'], 'fk_pc_post')->references(['id'])->on('blog_post')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['categoryId'], 'fk_pc_category')->references(['id'])->on('blog_category')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blog_post_category', function (Blueprint $table) {
            $table->dropForeign('fk_pc_post');
            $table->dropForeign('fk_pc_category');
        });
    }
}
