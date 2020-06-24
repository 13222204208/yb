<?php

use App\Model\Platform;
use Illuminate\Database\Seeder;

class PlatformTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Platform::class, 10)->create();
    }
}
