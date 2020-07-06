<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BgAffiche extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bg_affiche', function (Blueprint $table) {
            $table->increments('id');
            $table->string('affiche_title',100)->default('')->comment('消息标题');
            $table->string('affiche_content',600)->default('')->comment('消息内容');    
            $table->integer('great_affiche')->default(0)->comment('是否是重大消息，1 为是 0为否');      
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
