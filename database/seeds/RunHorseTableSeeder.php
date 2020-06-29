<?php

use App\Model\RunHorse;
use Illuminate\Database\Seeder;

class RunHorseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(RunHorse::class, 10)->create();
    }
}
