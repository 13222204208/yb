<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FUserDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('f_user_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username',20)->comment('用户名');
            $table->string('user_head',200)->default('')->comment('用户头像');
            $table->string('true_name',30)->default('')->comment('真实姓名');
            $table->integer('gender')->default(2)->comment('0为女 1为男');  
            $table->string('date_brith',50)->default('')->comment('出生日期');
            $table->string('phone',11)->default('')->comment('手机号码');
            $table->integer('phone_code')->default(0)->comment('手机验证码 通常为6位');
            $table->integer('email_code')->default(0)->comment('邮箱验证码 通常为6位');
            $table->string('email',50)->default('')->comment('电子邮箱');
            $table->integer('vip')->default(0)->comment('vip级别');  
   
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
