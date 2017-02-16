<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableUserAddFieldEmail extends Migration
{
    public function up()
    {
        Schema::table('users', function ($table) {
            $table->string('email')->nullable()->comment('用户邮箱地址 联系用 唯一');
            $table->string('avatar')->nullable()->comment('用户头像');
        });
    }

    public function down()
    {
        Schema::table('users', function ($table) {
            $table->dropColumn('email');
            $table->dropColumn('avatar');
        });
    }
}
