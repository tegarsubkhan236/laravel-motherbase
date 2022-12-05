<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogPostMetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_post_meta', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('postId')->index('idx_meta_post');
            $table->string('key', 50);
            $table->text('content')->nullable();

            $table->unique(['postId', 'key'], 'uq_post_meta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_post_meta');
    }
}
