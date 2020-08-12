<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TcLotteryRecord extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tc_lottery_record', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('betAmount',16,4)->default(0)->comment('投注金额');
            $table->string('gameCode',50)->default('')->comment('游戏代码');
            $table->string('betOrderNo',50)->default('')->comment('投注订单号');
            $table->string('betTime',30)->default('')->comment('投注时间');
            $table->string('transTime',30)->default('')->comment('交易时间');
            $table->string('betContentId',30)->default('')->comment('投注内容');
            $table->string('orderNum',50)->default('')->comment('订单号(后台查询)');
            $table->string('chase',50)->default('')->comment('true:追号订单｜false:非追号订单');
            $table->string('playCode',50)->default('')->comment('玩法代码');
            $table->string('numero',50)->default('')->comment('期号');
            $table->string('merchantCode',50)->default('')->comment('商户代码');
            $table->string('bettingContent',50)->default('')->comment('投注实际内容');
            $table->integer('playId')->default(0)->comment('中奖注数');
            $table->string('freezeTime',50)->default('')->comment('冻结时间');
            $table->integer('multiple')->default(0)->comment('下注倍数');
            $table->integer('winAmount')->default(0)->comment('中奖金额');
            $table->string('netPNL',50)->default('')->comment('净输赢');
            $table->string('betStatus',50)->default('')->comment('(1:已中奖｜2:未中奖 ｜3:取消 | 4:和)');
            $table->string('settlementTime',50)->default('')->comment('结算时间');
            $table->string('actualBetAmount',50)->default('')->comment('基准返奖率');
            $table->string('exceedWinAmount',50)->default('')->comment('超额中奖');
            $table->string('details',50)->default('')->comment('游戏结果
            2 = Pending =未开奖

            4 = Win = 已中奖

            5 = Loss = 未中奖

            6 = HitCancel = 追中撤单

            7 = Shown Cancel = 出号放弃

            8 = Player Cancel = 个人撤单

            12 = Empty Draw = 空开撤单

            14 = System Drawback = 系统撤单

            15 = Super Drawback = 超级撤单

            16 = Tie = 和局 (六合彩用)

            17 = BO Drawback =后台撤单');
            $table->string('username',50)->default('')->comment('玩家帐号');
            $table->string('productType',50)->default('')->comment('产品代码');
            $table->string('single',50)->default('')->comment('true: 单式注单｜false: 非单式注单');
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
