<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Model\Feedback;
use Faker\Generator as Faker;

$factory->define(Feedback::class, function (Faker $faker) {
    return [
        'username'=>$faker->shuffle('123ghijk'),
        'feedback_type'=>$faker->word,
        'feedback_content'=> $faker->text(100),
        'img_url'=>$faker->imageUrl(),
    ];
});
