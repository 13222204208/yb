<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BgLoginRecord extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bg_login_record', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username',50)->comment('用户名  ');
            $table->string('login_ip',50)->default('')->comment('登陆ip');
            $table->string('login_time',50)->comment('登陆时间');

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
