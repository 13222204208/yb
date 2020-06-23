<?php

use App\Model\UserStatistics;
use Illuminate\Database\Seeder;

class UserStatisticsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(UserStatistics::class, 100)->create();
    }
}
