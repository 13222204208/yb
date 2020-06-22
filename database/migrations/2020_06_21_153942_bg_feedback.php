<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BgFeedback extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bg_feedback', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account_num',50)->comment('意见反馈提交人帐号');
            $table->string('feedback_type',50)->default('')->comment('反馈问题类型');
            $table->string('feedback_content',500)->default('')->comment('反馈问题具体描述');
            $table->string('img_url',200)->default('')->comment('反馈截图');
            $table->string('state',20)->default('')->comment('状态');
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
