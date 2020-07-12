<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BgMemberRecharge extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bg_member_recharge', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('min_money',9,2)->comment('充值达到此金额才会赠送');
            $table->integer('largess_scale')->comment('每笔赠送的比例');
            $table->integer('largess_toplimit')->comment('每日赠送的上限');
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
