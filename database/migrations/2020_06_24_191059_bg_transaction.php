<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BgTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bg_transaction', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_num',50)->default('')->comment('订单号');
            $table->string('username',20)->default('')->comment('用户名');
            $table->string('business_type',50)->default('')->comment('交易类型');
            $table->string('business_mode',50)->default('')->comment('交易方式');
            $table->decimal('business_money',9,2)->default(0)->comment('交易金额');
            $table->integer('business_state')->default(0)->comment('交易状态 0待确认');
            $table->decimal('balance', 9, 2)->default(0)->comment('钱包余额');
            $table->string('ask_time',50)->default('')->comment('申请时间');
            $table->string('auditing_time',50)->default('')->comment('审核时间');

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
