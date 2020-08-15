<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TcPvpbdRecord extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tc_pvpbd_record', function (Blueprint $table) {//天成棋牌投注记录
            $table->increments('id');
            $table->string('gameCode',50)->default('')->comment('游戏代码  ');
            $table->string('betTime',50)->default('')->comment('投注时间');
            $table->string('endTime',50)->default('')->comment('结束时间');
            $table->string('productType',30)->default('')->comment('产品类别');
            $table->string('sessionId',50)->default('')->comment('局号');
            $table->string('additionalInfo')->default('')->comment('详细注单内容');
            $table->string('username',30)->comment('游戏账号的登录名 ');
            $table->string('betAmount',10)->default('')->comment('投注金额');
            $table->string('netPnl',10)->default('')->comment('净输赢');
            $table->string('transactionTime',30)->default('')->comment('交易时间');
            $table->string('betOrderNo',50)->default('')->comment('投注订单编号');

            $table->string('rake',10)->default('')->comment('房费（抽水）');


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
