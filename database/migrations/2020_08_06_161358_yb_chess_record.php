<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class YbChessRecord extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yb_chess_record', function (Blueprint $table) {//亚博棋牌投注记录
            $table->increments('id');
            $table->bigInteger('bi')->default(0)->comment('注单id');
            $table->bigInteger('mi')->default(0)->comment('商户id');
            $table->string('mmi',32)->default('')->comment('玩家账号(用户名)');
            $table->integer('st')->default(0)->comment('投注时间');
            $table->integer('et')->default(0)->comment('结算时间');
            $table->integer('gd')->default(0)->comment('游戏桌号');
            $table->integer('gi')->default(0)->comment('游戏id');
            $table->string('gn',32)->default('')->comment('游戏名称');
            $table->integer('gt')->default(0)->comment('房间类型(1：初级，2：中级...)');
            $table->string('gr',24)->default('')->comment('游戏房间');
            $table->bigInteger('mw')->default(0)->comment('输赢金额');
            $table->bigInteger('mp')->default(0)->comment('抽水金额');
            $table->bigInteger('bc')->default(0)->comment('有效投注');
            $table->bigInteger('ci')->default(0)->comment(' 牌局 id：内部服务使用');
            $table->integer('dt')->default(0)->comment('终端设备类型（0:web,1:h5,2：ios,3:android）');
            $table->bigInteger('tb')->default(0)->comment('总投注金额');
            $table->string('cn',32)->default('')->comment('牌局 id：用于游戏内、后台展示和查询');

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
