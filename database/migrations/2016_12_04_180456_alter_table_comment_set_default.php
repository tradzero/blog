<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableCommentSetDefault extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments', function($table) {
            $table->integer('like')->default(0)->comment('点赞数')->change();
            $table->integer('unlike')->default(0)->comment('踩数')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function($table) {
            $table->integer('like')->comment('点赞数');
            $table->integer('unlike')->comment('踩数');
        });
    }
}
