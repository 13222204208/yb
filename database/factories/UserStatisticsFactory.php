<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\UserStatistics;
use Faker\Generator as Faker;

$factory->define(UserStatistics::class, function (Faker $faker) {
    return [
        'username'=>$faker->phoneNumber,
        'true_name'=>$faker->name('female'),
        'deposit_num'=>$faker->randomNumber(3, true),
        'deposit_sum'=>$faker->randomNumber(7, true),
        'draw_money_num'=>$faker->randomNumber(3, true),
        'draw_money_sum'=>$faker->randomNumber(7, true),
        'backwater_sum'=>$faker->randomNumber(6, true),
        'reward_sum'=>$faker->randomNumber(6, true),
        'profit_loss_sum'=>$faker->randomNumber(6, true),
    ];
});
