<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BgRebate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bg_rebate', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rebate_grade',30)->default('')->comment('返水等级');
            $table->string('game_type',40)->default('')->comment('游戏类型');
            $table->string('rebate_name')->default('')->comment('返水名称');
            $table->integer('money')->default(1)->comment('额度');
            $table->integer('rebate_scale')->default(1)->comment('返水比例');
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
