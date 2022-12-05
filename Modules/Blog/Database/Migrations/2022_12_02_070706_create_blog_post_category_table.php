<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogPostCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_post_category', function (Blueprint $table) {
            $table->bigInteger('postId')->index('idx_pc_post');
            $table->bigInteger('categoryId')->index('idx_pc_category');

            $table->primary(['postId', 'categoryId']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_post_category');
    }
}
