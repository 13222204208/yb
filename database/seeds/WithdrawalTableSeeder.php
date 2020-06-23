<?php

use App\Model\Withdrawal;
use Illuminate\Database\Seeder;

class WithdrawalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Withdrawal::class, 100)->create();
    }
}
