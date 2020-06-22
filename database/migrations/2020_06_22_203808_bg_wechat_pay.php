<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BgWechatPay extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bg_wechat_pay', function (Blueprint $table) {
            $table->increments('id');
            $table->string('wechat_name',30)->default('')->comment('二维码名称');
            $table->string('wechat_url',400)->default('')->comment('二维码图片链接');
            $table->integer('min_money')->default(1)->comment('单笔最低充值');
            $table->integer('max_money')->default(1)->comment('单笔最高充值');
            $table->integer('day_max_money')->default(1)->comment('单日充值上限');
            $table->integer('state')->default(1)->comment('1为开启0为关闭');
            $table->integer('day_money')->comment('今日充值金额');
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
