<?php


use App\Model\RotationChart;
use Illuminate\Database\Seeder;

class RotationChartTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(RotationChart::class, 10)->create();
    }
}
