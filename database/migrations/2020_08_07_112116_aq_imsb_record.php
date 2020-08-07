<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AqImsbRecord extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aq_imsb_record', function (Blueprint $table) {
            $table->increments('id');
            $table->string('BetID',30)->comment('投注单号');
            $table->decimal('Odds',16,1)->default(0)->comment('注单赔率');
            $table->integer('OddsType')->default(0)->comment('赔率类型');
            $table->string('GameCode',20)->default('')->comment('子游戏代码，多为电子游戏使用');
            $table->string('MemberAccount',30)->default('')->comment('会员帐号');
            $table->string('ModifyDate',50)->default('')->comment('最后更新时间');
            $table->string('BetDate',50)->default('')->comment('投注时间');
            $table->decimal('Bet',16,1)->default(0)->comment('投注金额');
            $table->decimal('ValidBet',16,1)->default(0)->comment('有效投注额 (视游戏平台是否提供，未提供该值为0)');
            $table->decimal('TotalPayout',16,1)->default(0)->comment('彩金(含投注额)');
            $table->decimal('TotalWinlose',16,1)->default(0)->comment('淨输赢金额');
            $table->string('BetContent',150)->default('')->comment('投注内容');
            $table->integer('BetStatus')->default(0)->comment('结算状态 (0:未结算 1:取消/退回 2: 拒绝 3:已结算)');
            $table->integer('GameType')->default(0)->comment('游戏类型');

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
