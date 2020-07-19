<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GRollin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('g_rollin', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account',36)->default('')->comment('使用者帐号');
            $table->string('eventTime',35)->default('')->comment('事件时间格式为RFC3339');
            $table->string('gamehall',36)->default('')->comment('游戏厂商代号');
            $table->string('gamecode',36)->default('')->comment('游戏代号');
            $table->string('roundid',50)->default('')->comment('游戏局号');
            $table->decimal('validbet',16,4)->default(0)->comment('有效投注');
            $table->decimal('bet',16,4)->default(0)->comment('下注金额');
            $table->decimal('win',16,4)->default(0)->comment('赢得金额');
            $table->decimal('roomfee',16,4)->default(0)->comment('开房费用牌桌游戏使用，选填');
            $table->decimal('amount',16,4)->default(0)->comment('金额，不得为负值');
            $table->string('mtcode',70)->default('')->comment('混合码 为唯一不重复的值');
            $table->string('createTime',35)->default('')->comment('事件时间格式 为RFC3339');
            $table->decimal('rake',16,4)->default(0)->comment('抽水金额');
            $table->string('gametype',36)->default('')->comment('渔机游戏或牌桌游戏');
            $table->string('currency',50)->default('CNY')->comment('币别');

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
