<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\RunHorse;
use Faker\Generator as Faker;

$factory->define(RunHorse::class, function (Faker $faker) {
    return [
        'content'=>$faker->text(100),
        'type'=>$faker->randomElement(['公告', '活动']),
        'start_time'=>$faker->time('Y-m-d H:i:s', '+1 days'),
        'stop_time'=>$faker->time('Y-m-d H:i:s', '+15 days'),
    ];
});
