<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BgNotice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bg_notice', function (Blueprint $table) {
            $table->increments('id');
            $table->string('notice_receive',20)->default('all')->comment('消息接收者');
            $table->string('notice_title',100)->default('')->comment('通知标题');
            $table->string('notice_content',600)->default('')->comment('通知内容');
            $table->integer('state')->default(0)->comment('是否已读，1 为是 0为否');
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
