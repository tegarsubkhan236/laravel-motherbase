<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToBlogPostCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blog_post_comment', function (Blueprint $table) {
            $table->foreign(['postId'], 'fk_comment_post')->references(['id'])->on('blog_post')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['parentId'], 'fk_comment_parent')->references(['id'])->on('blog_post_comment')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blog_post_comment', function (Blueprint $table) {
            $table->dropForeign('fk_comment_post');
            $table->dropForeign('fk_comment_parent');
        });
    }
}
