<?php

use App\Model\Recharge;
use Illuminate\Database\Seeder;

class FRechargeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Recharge::class, 100)->create();
    }
}
