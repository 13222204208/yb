<?php

use App\Model\ApplyActivity;
use Illuminate\Database\Seeder;

class ApplyActivityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ApplyActivity::class, 100)->create();
    }
}
