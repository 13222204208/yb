<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GEndround extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('g_endround', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account',36)->default('')->comment('使用者帐号');
            $table->string('gamehall',36)->default('')->comment('游戏厂商代号');
            $table->string('gamecode',36)->default('')->comment('游戏代号');
            $table->string('roundid',50)->default('')->comment('游戏局号');
            $table->text('data')->default('')->comment('事件资料列表');
            $table->string('createTime',35)->default('')->comment('事件时间格式 为RFC3339');
            $table->string('currency',50)->default('CNY')->comment('币别');
            $table->decimal('balance',16,4)->default(0)->comment('钱包余额');
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
