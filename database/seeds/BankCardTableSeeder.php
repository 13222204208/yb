<?php

use App\Model\BankCard;
use Illuminate\Database\Seeder;

class BankCardTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(BankCard::class, 10)->create();
    }
}
