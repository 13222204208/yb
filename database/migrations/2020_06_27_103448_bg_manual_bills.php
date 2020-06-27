<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BgManualBills extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bg_manual_bills', function (Blueprint $table) {
            $table->increments('id');
            $table->string('time',30)->default('')->comment('时间');
            $table->string('business_type',30)->default('')->comment('交易类型');
            $table->string('bank_card',30)->default('')->comment('银行卡号');
            $table->string('operation',30)->default('')->comment('操作人');
            $table->string('remarks',300)->default('')->comment('备注');
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
