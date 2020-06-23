<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FRecharge extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('f_recharge', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_num',50)->default('')->comment('订单号');
            $table->string('username',20)->default('')->comment('用户名');
            $table->integer('recharge_money')->default(0)->comment('充值金额');
            $table->string('remit_way',50)->default('')->comment('汇款方式');
            $table->string('remit_card',50)->default('')->comment('汇款卡号');
            $table->string('make_card',50)->default('')->comment('收款卡号');
            $table->string('remit_time',50)->default('')->comment('汇款时间');
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
