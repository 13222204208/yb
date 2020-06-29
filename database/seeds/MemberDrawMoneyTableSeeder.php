<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemberDrawMoneyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bg_member_draw_money')->insert([
            'draw_money_num'=>10000,
            'min_draw_money' => 5000,
            'max_draw_money' => 10000,
            'draw_money_scale' => 20,
            'poundage_full' => 1000,
            'created_at' => '2020-07-18 16:19:51',
            'updated_at' => '2020-07-18 18:19:51'
        ]);
    }
}
