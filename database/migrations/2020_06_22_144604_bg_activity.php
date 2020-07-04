<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BgActivity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bg_activity', function (Blueprint $table) {
            $table->increments('id');
            $table->string('activity_type',30)->default('')->comment('活动的类型');
            $table->string('application_mode',30)->default('')->comment('申请的模式');
            $table->string('activity_title',300)->default('')->comment('活动的标题');
            $table->string('activity_url',300)->default('')->comment('活动链接地址');
            $table->integer('activity_sort')->default(1)->comment('活动前端显示的排序，以数字 1,2,3 ...排序');
            $table->string('activity_img')->default('')->comment('活动列表显示的图片');
            $table->string('label_img')->default('')->comment('活动列表左上角标签图片');
            $table->string('start_time',30)->default('')->comment('开始时间');
            $table->string('stop_time',30)->default('')->comment('结束时间');
            $table->string('activity_term',50)->default('')->comment('活动条件');
            $table->string('term_num',50)->default('')->comment('条件数量');
            $table->integer('award_num')->comment('活动奖励的金额');
            $table->string('activity_describe',600)->default('')->comment('活动的描述');
            $table->integer('activity_state')->default(1)->comment('活动状态1为开启 0为关闭');
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
