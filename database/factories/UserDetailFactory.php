<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\UserDetail;
use Faker\Generator as Faker;

$factory->define(UserDetail::class, function (Faker $faker) {
    return [
        'username' => factory('App\Model\UserInfo')->create()->username,
        'user_head' => $faker->imageUrl(),
        'true_name' => $faker->title('female'),
        'phone' => $faker->phoneNumber, 
       
    ];
});
