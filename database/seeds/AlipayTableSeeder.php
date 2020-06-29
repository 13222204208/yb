<?php

use App\Model\Alipay;
use Illuminate\Database\Seeder;

class AlipayTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Alipay::class, 10)->create();
    }
}
