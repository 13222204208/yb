<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BgMemberDrawMoney extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bg_member_draw_money', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('draw_money_num')->default(1)->comment('每日提款次数上限');
            $table->integer('min_draw_money')->comment('单笔提款下限');
            $table->integer('max_draw_money')->comment('单笔提款上限');
            $table->integer('draw_money_scale')->default(0)->comment('单笔提款手续费比例');
            $table->integer('poundage_full')->comment('单笔手续费上限');
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
