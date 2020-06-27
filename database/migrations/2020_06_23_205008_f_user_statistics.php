<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FUserStatistics extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('f_user_statistics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username',30)->default('')->comment('用户名');
            $table->string('true_name',30)->default('')->comment('真实姓名');
            $table->integer('deposit_num')->default(0)->comment('存款次数');
            $table->integer('deposit_sum')->default(0)->comment('存款总额');
            $table->integer('draw_money_num')->default(0)->comment('提款次数');
            $table->integer('draw_money_sum')->default(0)->comment('提款总额');
            $table->integer('backwater_num')->default(0)->comment('返水次数');
            $table->integer('backwater_sum')->default(0)->comment('返水总额');
            $table->integer('reward_num')->default(0)->comment('奖励次数');
            $table->integer('reward_sum')->default(0)->comment('奖励总额');
            $table->integer('profit_loss_sum')->default(0)->comment('盈亏总额');
            $table->string('time',30)->default('')->comment('时间');
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
