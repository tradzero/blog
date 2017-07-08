<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nickname', 191)->comment('昵称');
            $table->string('username', 191)->unique()->comment('用户名');
            $table->string('password', 191)->comment('密码');
            $table->boolean('sex')->default(0)->comment('性别');
            $table->string('mail', 191)->comment('邮箱');
            $table->tinyInteger('role')->default(2)->comment('用户权限 0 admin, 1 授权用户, 2 游客');
            $table->boolean('is_banned')->default(0)->comment('是否被禁用');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
