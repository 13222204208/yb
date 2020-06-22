<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BgPayClear extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bg_pay_clear', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bank_card')->default(1)->comment('1为开放 0为关闭');
            $table->integer('wechat_pay')->default(1)->comment('1为开放 0为关闭');
            $table->integer('alipay_pay')->default(1)->comment('1为开放 0为关闭');
            $table->integer('third_party')->default(1)->comment('1为开放 0为关闭');
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
