<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\UserStatistics;
use Faker\Generator as Faker;

$factory->define(UserStatistics::class, function (Faker $faker) {
    return [
        'username'=>$faker->phoneNumber,
        'true_name'=>$faker->name('female'),
        'deposit_num'=>$faker->randomNumber(3, true),
        'deposit_sum'=>$faker->randomNumber(4, true),
        'draw_money_num'=>$faker->randomNumber(2, true),
        'draw_money_sum'=>$faker->randomNumber(4, true),
        'backwater_num'=>$faker->randomNumber(2, true),
        'backwater_sum'=>$faker->randomNumber(4, true),
        'reward_num'=>$faker->randomNumber(2, true),
        'reward_sum'=>$faker->randomNumber(4, true),
        'profit_loss_sum'=>$faker->randomNumber(4, true),
        'time'=>$faker->dateTimeThisYear('+10 days', 'PRC'),
    ];
});
