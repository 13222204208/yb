<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BgSupport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bg_support', function (Blueprint $table) {//赞助表
            $table->increments('id');
            $table->string('app_img_url',200)->default('')->comment('入口图片');
            $table->string('icon_url',200)->default('')->comment('入口图标');
            $table->string('title',50)->default('')->comment('标题');
            $table->string('first_line',50)->default('')->comment('图标下第一行');
            $table->string('second_line',50)->default('')->comment('图标下第二行');
            $table->string('button_text',50)->default('')->comment('按钮名称');
            $table->string('link_url',50)->default('')->comment('跳转的url');
            $table->integer('sort')->default(1)->comment('排序');
            $table->integer('state')->default(1)->comment('状态');
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
