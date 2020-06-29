<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemberRechargeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bg_member_recharge')->insert([
            'min_money'=>10000,
            'largess_scale' => 2,
            'largess_toplimit' => 1000,
            'created_at' => '2020-07-18 16:19:51',
            'updated_at' => '2020-07-18 18:19:51'
        ]);
    }
}
