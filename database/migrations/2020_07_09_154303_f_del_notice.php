<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FDelNotice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('f_del_notice', function (Blueprint $table) {//删除的通知
            $table->increments('id');
            $table->string('username',20)->default('')->comment('用户名');
            $table->string('del_id',20)->default('')->comment('要删除的通知id');
            $table->string('type',20)->default('')->comment('删除的类型');
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
