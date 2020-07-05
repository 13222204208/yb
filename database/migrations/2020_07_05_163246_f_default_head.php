<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FDefaultHead extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('f_default_head', function (Blueprint $table) {
            $table->increments('id');
            $table->string('img_name',20)->comment('默认头像');
            $table->string('default_head',200)->default('')->comment('默认的用户头像');
            $table->string('type',20)->default('')->comment('default');
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
