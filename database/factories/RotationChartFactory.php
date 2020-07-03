<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\RotationChart;
use Faker\Generator as Faker;

$factory->define(RotationChart::class, function (Faker $faker) {
    return [
        'img_url'=>$faker->imageUrl(),
        'jump_url'=>$faker->imageUrl(),
        'img_sort'=>$faker->randomNumber(1, true),
    ];
});
