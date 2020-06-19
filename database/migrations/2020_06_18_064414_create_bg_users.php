<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBgUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bg_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account_num',30)->default('')->comment('后台登录帐号');
            $table->string('nickname',30)->default('')->comment('后台用户昵称');
            $table->string('password',300)->comment('后台登录密码');
            $table->string('role',30)->default('')->comment('帐号的角色及权限');//角色
            $table->string('state',30)->default('')->comment('帐号的状态');
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
        Schema::dropIfExists('bg_users');
    }
}
