<?php

use App\Model\WechatPay;
use Illuminate\Database\Seeder;

class WechatPayTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(WechatPay::class, 10)->create();
    }
}
