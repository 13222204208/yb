<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(ActivityTableSeeder::class);
         $this->call(ApplyActivityTableSeeder::class);
         $this->call(BettingTableSeeder::class);
         $this->call(BgUsersTableSeeder::class);
         $this->call(FeedbackTableSeeder::class);
         $this->call(FRechargeTableSeeder::class);
         $this->call(PlatformTableSeeder::class);
         $this->call(TransactionTableSeeder::class);
         $this->call(UserInfoTableSeeder::class);
         $this->call(UserStatisticsTableSeeder::class);
         $this->call(WithdrawalTableSeeder::class);
    }
}
