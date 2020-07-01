<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FUserinfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('f_userinfo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username',20)->comment('用户名');
            $table->string('nickname',30)->default('')->comment('昵称');
            $table->string('password',512)->comment('用户密码');
            $table->string('take_password',512)->default('')->comment('取款密码');
            $table->string('recharge_account',50)->default('')->comment('充值帐户');
            $table->string('reward_account',50)->default('')->comment('奖励帐户');
           // $table->string('true_name',20)->default('')->comment('真实姓名');
           // $table->string('phone',11)->default('')->comment('手机号');
            $table->string('register_ip',20)->default('')->comment('注册IP');
            $table->string('register_time',30)->default('')->comment('注册时间');
            $table->string('login_time',30)->default('')->comment('登录时间');
            $table->string('off_time',30)->default('')->comment('离线时间');
            $table->string('ask_time',50)->default('')->comment('申请时间');
            $table->string('account_freeze',50)->default('')->comment('帐号冻结时间');
            $table->string('remember_token',512)->default('')->comment('token');
            $table->integer('state')->default(0)->comment('0为离线 1为在线');          
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
        //
    }
}
