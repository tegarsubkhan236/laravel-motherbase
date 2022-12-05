<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_post', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->unsignedBigInteger('authorId')->index('idx_blog_post_user');
            $table->bigInteger('parentId')->nullable()->index('idx_blog_post_parent');
            $table->string('title', 75);
            $table->string('metaTitle', 100)->nullable();
            $table->string('slug', 100)->unique('uq_slug');
            $table->text('summary')->nullable();
            $table->boolean('published')->default(false);
            $table->dateTime('createdAt');
            $table->dateTime('updatedAt')->nullable();
            $table->dateTime('publishedAt')->nullable();
            $table->text('content')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_post');
    }
}
