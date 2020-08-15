<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VipRebate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vip_rebate', function (Blueprint $table) {//vip表
            $table->increments('id');
            $table->integer('vip')->default(0)->comment('vip级别 最高到vip10');
            $table->integer('day_num')->default(0)->comment('每日提款次数');
            $table->decimal('balance',16,2)->default(0)->comment('每日提款额度');
            $table->decimal('cash_gift',16,2)->default(0)->comment('升级礼金晋级自动发送');
            $table->decimal('red_packet',16,2)->default(0)->comment('每月红包 月初自动发送');
            $table->integer('min_transfer')->default(0)->comment('最低转帐');
            $table->integer('bonus')->default(0)->comment('红利比例');
            $table->integer('max_bonus')->default(0)->comment('最高奖金');
            $table->integer('water_multiples')->default(0)->comment('流水倍数');
            $table->integer('num_restrict')->default(0)->comment('次数限制');
            $table->string('appoint',50)->default('')->comment('场馆');

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
