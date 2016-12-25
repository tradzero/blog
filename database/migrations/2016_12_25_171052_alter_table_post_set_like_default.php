<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTablePostSetLikeDefault extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function($table) {
            $table->integer('like')->unsign()->comment('点赞数')->default(0)->change();
            $table->integer('unlike')->unsign()->comment('踩数量')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function($table) {
            $table->integer('like')->unsign()->comment('点赞数')->change();
            $table->integer('unlike')->unsign()->comment('踩数量')->change();
        });
    }
}
