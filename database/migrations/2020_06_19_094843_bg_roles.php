<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BgRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bg_roles', function (Blueprint $table) {
            $table->increments('role_id');
            $table->string('role_name',50)->comment('角色名称');
            $table->string('role_scope',500)->default('')->comment('角色的权限范围');
            $table->string('describe',300)->default('')->comment('角色的具体描述');//角色
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
