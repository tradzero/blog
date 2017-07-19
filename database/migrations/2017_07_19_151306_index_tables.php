<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IndexTables extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->index(['id', 'username', 'role']);
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->index('id');
            $table->index(['user_id', 'visible']);
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->index(['id', 'user_id', 'post_id']);
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['id', 'username', 'role']);
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->dropIndex('posts_id_index');
            $table->dropIndex(['user_id', 'visible']);
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->dropIndex(['id', 'user_id', 'post_id']);
        });
    }
}
