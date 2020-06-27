<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BgNews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bg_news', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('news_type')->default(1)->comment('消息类型，1为个人消息 0为全服消息');
            $table->string('username',30)->default('')->comment('收件人用户名');
            $table->string('news_title',100)->default('')->comment('消息标题');
            $table->string('news_content',600)->default('')->comment('消息内容');
            $table->string('start_time',30)->default('')->comment('消息发送时间');
            $table->string('destroy_time',30)->default('')->comment('消息销毁时间');       
            $table->integer('great_news')->default(0)->comment('是否是重大消息，1 为是 0为否');       
            $table->integer('award_gold')->default(0)->comment('奖励金币数量');
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
