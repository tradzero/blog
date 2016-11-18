<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function(Blueprint $table) {
            $table->increments('id')->comment('主键-评论id');
            $table->integer('user_id')->comment('外键-用户id');
            $table->integer('post_id')->comment('外键-文章id');
            $table->string('comment')->comment('评论');
            $table->boolean('is_deleted')->default(0)->comment('该评论是否被删除');
            $table->integer('like')->comment('点赞数');
            $table->integer('unlike')->comment('踩数');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
