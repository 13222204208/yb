<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BgBankCard extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bg_bank_card', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username',30)->default('')->comment('用户名');
            $table->string('card_name',30)->default('')->comment('持卡人姓名');
            $table->string('bank_name',40)->default('')->comment('银行名称');
            $table->string('open_bank',40)->default('')->comment('开户行');
            $table->string('card_num',30)->default('')->comment('银行卡号');
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
