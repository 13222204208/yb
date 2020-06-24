<?php

use App\Model\Betting;
use Illuminate\Database\Seeder;

class BettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Betting::class, 100)->create();
    }
}
