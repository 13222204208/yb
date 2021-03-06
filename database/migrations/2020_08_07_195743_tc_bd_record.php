<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TcBdRecord extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tc_bd_record', function (Blueprint $table) {//天成电子投注记录
            $table->increments('id');
            $table->string('username',30)->comment('游戏账号的登录名 ');
            $table->decimal('betAmount',16,1)->default(0)->comment('投注金额');
            $table->decimal('validBetAmount',16,1)->default(0)->comment('有效投注金额 只有 AG, BBIN, MG ,EA 有有效投注');
            $table->decimal('winAmount',16,1)->default(0)->comment('赢金额');
            $table->decimal('netPnl',16,1)->default(0)->comment('净输赢');
            $table->string('currency',20)->default('')->comment('币别');
            $table->string('transactionTime',30)->default('')->comment('交易时间');
            $table->string('gameCode',50)->default('')->comment('游戏代码   ');
            $table->string('betOrderNo',50)->default('')->comment('投注订单编号');
            $table->string('betTime',50)->default('')->comment('投注时间');
            $table->integer('productType')->default(0)->comment('产品类别');
            $table->string('gameCategory',50)->default('')->comment('游戏类别');
            $table->string('sessionId',50)->default('')->comment('会话标识');
            $table->string('additionalDetails',150)->default('')->comment('产品追加投注详细信息列表');

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
