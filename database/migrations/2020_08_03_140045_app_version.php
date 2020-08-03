<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AppVersion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_version', function (Blueprint $table) {
            $table->increments('id');
            $table->string('new_version',20)->default('')->comment('最新版本号');
            $table->integer('compel_update')->default(0)->comment('是否强制更新');
            $table->string('update_content',600)->default('')->comment('更新内容');
            $table->integer('is_update')->default(0)->comment('是否更新');
            $table->string('ios_href',300)->default('')->comment('苹果更新链接');
            $table->string('android_href',300)->default('')->comment('安新更新链接');

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
