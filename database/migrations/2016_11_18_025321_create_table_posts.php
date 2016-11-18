<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->comment('外键-用户id');
            $table->string('title')->comment('文章标题');
            $table->string('content')->comment('文章正文');
            $table->boolean('is_deleted')->comment('是否被删除');
            $table->integer('like')->unsign()->comment('点赞数');
            $table->integer('unlike')->unsign()->comment('踩数量');
            $table->tinyInteger('visible')->comment('文章可见性');
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
        Schema::dropIfExists('posts');
    }
}
