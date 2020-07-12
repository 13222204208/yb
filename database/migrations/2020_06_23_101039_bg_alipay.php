<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BgAlipay extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bg_alipay', function (Blueprint $table) {
            $table->increments('id');
            $table->string('alipay_name',30)->default('')->comment('支付宝二维码名称');
            $table->string('alipay_url',400)->default('')->comment('支付玉二维码图片链接');
            $table->decimal('min_money',9,2)->default(1)->comment('单笔最低充值');
            $table->decimal('max_money',9,2)->default(1)->comment('单笔最高充值');
            $table->decimal('day_max_money',9,2)->default(1)->comment('单日充值上限');
            $table->integer('state')->default(1)->comment('1为开启0为关闭');
            $table->decimal('day_money',9,2)->comment('今日充值金额');
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
