<?php

use App\Model\UserInfo;
use Illuminate\Database\Seeder;

class UserInfoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(UserInfo::class, 100)->create();
    }
}
