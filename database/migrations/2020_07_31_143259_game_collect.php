<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GameCollect extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_collect', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username',20)->default('')->comment('用户名');
            $table->string('productType',20)->default('')->comment('商品类型');
            $table->string('tcgGameCode',20)->default('')->comment('游戏代码');
            $table->string('productCode',20)->default('')->comment('商品代码');
            $table->string('gameName',30)->default('')->comment('游戏名称');
            $table->integer('state')->default(1)->comment('已收藏');
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
