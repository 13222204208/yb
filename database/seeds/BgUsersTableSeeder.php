<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BgUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bg_users')->insert([
            'account_num'=>'myadmin',
            'nickname' => '夜店小王子',
            'role' =>  '超级管理员',
            'password' => encrypt('myyabo123'),
            'state'=>'开启',
            'created_at' => '2020-06-18 16:19:51',
            'updated_at' => '2020-06-18 18:19:51'
        ]);
    }
}
