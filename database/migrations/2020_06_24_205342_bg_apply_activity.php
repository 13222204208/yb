<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BgApplyActivity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bg_apply_activity', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username',30)->default('')->comment('申请活动的用户，用户名');
            $table->string('activity_title',300)->default('')->comment('申请的活动的标题');
            $table->string('apply_time',30)->default('')->comment('申请时间');
            $table->integer('award_num')->comment('赠送金额，活动奖励的金额');
            $table->integer('state')->default(2)->comment('活动状态1为同意 0为拒绝 2为未处理');
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
