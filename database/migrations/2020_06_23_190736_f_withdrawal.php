<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FWithdrawal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('f_withdrawal', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_num',50)->default('')->comment('订单号');
            $table->string('username',20)->default('')->comment('用户名');
            $table->decimal('draw_money',9,2)->default(0)->comment('提款金额');
            $table->string('make_card',50)->default('')->comment('收款卡号');
            $table->string('account_holder',50)->default('')->comment('开户人');
            $table->string('bank_holder',50)->default('')->comment('开户行');
            $table->string('ask_time',50)->default('')->comment('申请时间');
            $table->integer('state')->default(2)->comment('2为未处理 1为同意0为拒绝');
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
