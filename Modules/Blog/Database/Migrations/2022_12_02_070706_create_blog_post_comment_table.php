<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogPostCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_post_comment', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('postId')->index('idx_comment_post');
            $table->bigInteger('parentId')->nullable()->index('idx_comment_parent');
            $table->string('title', 100);
            $table->boolean('published')->default(false);
            $table->dateTime('createdAt');
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
        Schema::dropIfExists('blog_post_comment');
    }
}
