<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GBetgame extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('g_betgame', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account',36)->default('')->comment('使用者帐号');
            $table->string('eventTime',35)->default('')->comment('事件时间格式为RFC3339');
            $table->string('gamehall',36)->default('')->comment('游戏厂商代号');
            $table->string('gamecode',36)->default('')->comment('游戏代号');
            $table->string('roundid',50)->default('')->comment('游戏局号');
            $table->decimal('amount',9,2)->default(0.00)->comment('金额不能为负值');
            $table->string('mtcode',70)->default('')->comment('混合码 为唯一不重复的值');
            $table->string('session',50)->default('')->comment('选填');
            $table->string('currency',50)->default('CNY')->comment('币别');
            $table->decimal('balance',9,2)->default(0.00)->comment('钱包余额');
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