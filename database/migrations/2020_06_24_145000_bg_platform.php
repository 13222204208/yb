<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BgPlatform extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bg_platform', function (Blueprint $table) {//对接的游戏平台表
            $table->increments('id');
            $table->string('platform_name',30)->comment('平台名称');
            $table->string('show_name',50)->default('')->comment('显示名称');
            $table->string('platform_type',32)->default('')->comment('所属类型');
            $table->integer('platform_sort')->default(1)->comment('排序');
            $table->string('platform_img',300)->default('')->comment('入口图片');
            $table->integer('remainder')->default(0)->comment('余额');
            $table->integer('state')->default(0)->comment('0为关闭 1为开启');
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
