<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Platform;
use Faker\Generator as Faker;

$factory->define(Platform::class, function (Faker $faker) {
    return [
        'platform_name'=>$faker->randomElement(['亚博体育', 'IM体育', 'BG真人', 'AG真人', 'IM电竞']),
        'show_name'=>$faker->company,
        'platform_type'=>$faker->jobTitle,
        'platform_sort'=>$faker->randomDigitNotNull,
        'platform_img'=>$faker->imageUrl(320, 320, 'cats'),
    ];
});
