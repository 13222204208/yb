<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BgRunHorse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bg_run_horse', function (Blueprint $table) {
            $table->increments('id');
            $table->string('content',300)->default('')->comment('通知的内容');
            $table->string('type',30)->default('')->comment('通知的类型');
            $table->string('start_time',30)->default('')->comment('开始时间');
            $table->string('stop_time',30)->default('')->comment('结束时间');
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
