<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BgBetting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bg_betting', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username',20)->comment('用户名');
            $table->string('platform_name',30)->comment('游戏平台名称');
            $table->string('login_ip',30)->default('')->comment('登陆ip');
            $table->string('game_name',50)->default('')->comment('游戏名称');
            $table->string('room_num',32)->default('')->comment('游戏房间');
            $table->integer('bottom_pour')->default(0)->comment('下注金额');
            $table->integer('group_money')->default(0)->comment('派彩金额');
            $table->string('bottom_pour_time',50)->default('')->comment('下注时间');       
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
