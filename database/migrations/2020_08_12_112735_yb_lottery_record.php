<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class YbLotteryRecord extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yb_lottery_record', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('orderId')->default(0)->comment(' 注单id');
            $table->bigInteger('playId')->default(0)->comment(' 玩id');
            $table->bigInteger('playItemId')->default(0)->comment(' 投注项id');
            $table->bigInteger('ticketId')->default(0)->comment(' 彩种id');
            $table->bigInteger('playLevelId')->default(0)->comment(' 玩法级id');
            $table->string('ticketPlanNo',50)->default('')->comment('奖期号');
            $table->bigInteger('memberId')->default(0)->comment(' 会员id');
            $table->string('memberAccount',50)->default('')->comment('会员账号');
            $table->decimal('betMoney',16,2)->default(0)->comment('投注金额');
            $table->bigInteger('seriesId')->default(0)->comment(' 彩系id');
            $table->string('seriesName',20)->default('')->comment('彩系名称');
            $table->string('betTime',50)->default('')->comment('投注时间');
            $table->integer('betNums')->default(0)->comment('注数');
            $table->integer('betMultiple')->default(0)->comment('倍数');
            $table->string('betModel',50)->default('')->comment('投注模式：1, 0.1, 0.01, 0.001, 2, 0.2, 0.02,  0.002   ');
            $table->string('betRebate',50)->default('')->comment('投注返点');
            $table->string('betPrize')->default('')->comment('奖金：多奖级逗号隔开');
            $table->string('odd')->default('')->comment('赔率：多奖级逗号隔开');
            $table->integer('betStatus')->default(0)->comment('1-待开奖,2-未中 奖,3-已中奖,4-挂起,5-已结算');
            $table->string('cancelStatus',50)->default('')->comment('撤单标志.false：未撤单 ture：已撤单.');
            $table->integer('cancelType')->default(0)->comment('撤单类型：1-个人撤单,2-系统撤单,3:中奖停追撤单;4：不中停追撤单.');
            $table->integer('riskStatus')->default(0)->comment('状态1待风控,2风控通过,3风控锁定,4风控解锁.');
            $table->string('riskUnlockBy',50)->default('')->comment('控解锁人');
            $table->string('riskUnlockAt',50)->default('')->comment('风控解锁时间');
            $table->string('ticketName',50)->default('')->comment('彩种名');
            $table->string('playLevel',50)->default('')->comment('玩法群名');
            $table->string('playName',50)->default('')->comment('玩法名');
            $table->string('singleGame',50)->default('')->comment('否单式玩法：false：否 true：是');
            $table->string('baseRate',50)->default('')->comment('基准返奖率');
            $table->string('bonusReduceRate',50)->default('')->comment('基准返奖率');
            $table->string('directlyMode',50)->default('')->comment('结算模式，false.代理，true.直客');
            $table->string('memberRebate',50)->default('')->comment('用户返点值');
            $table->string('ticketResult',50)->default('')->comment('开奖结果');
            $table->decimal('winAmount',16,2)->default(0)->comment('中奖金额');
            $table->integer('winNums')->default(0)->comment('中奖注数');
            $table->string('solo',50)->default('')->comment('是否单挑 false: 否, true: 是');
            $table->bigInteger('chaseId')->default(0)->comment(' 追号单id');
            $table->bigInteger('chasePlanId')->default(0)->comment(' 追号排期表ID');
            $table->bigInteger('groupMode')->default(0)->comment(' 盘面1:标准盘,2:双面盘 3:特色.');
            $table->integer('device')->default(0)->comment(' 注终端：1-web,2-IOS,3-Android,4-H5');
            $table->string('seriesType',50)->default('')->comment('系列类型: false传统 true特色');
            $table->string('chaseOrder',50)->default('')->comment('注单类型: false.普通注单,1.追号注单.');
            $table->string('cancelBy',50)->default('')->comment('注单撤销人account');
            $table->string('cancelAt',50)->default('')->comment('注单撤销时间');
            $table->string('cancelDesc',50)->default('')->comment('注单撤销说明');
            $table->string('updateAt',50)->default('')->comment('注单最后更新时间');
            $table->string('tester',50)->default('')->comment('是否测试账户，false:否 true:是 ');
            $table->string('betNum',50)->default('')->comment('投注号码');
            $table->string('betContent',350)->default('')->comment('前台投注内容');
            $table->string('profitAmount',50)->default('')->comment('注单撤销人account');
            $table->string('cancelBy',13)->default('')->comment('盈利金额      ');
            $table->string('merchantId',50)->default('')->comment('商户id      ');
            $table->string('merchantAccount',50)->default('')->comment('商户账号');

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
