<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Model\Withdrawal;
use Faker\Generator as Faker;

$factory->define(Withdrawal::class, function (Faker $faker) {
    return [
        'order_num'=>$faker->shuffle('123456789abcdefghijk'),
        'username'=>$faker->phoneNumber,
        'draw_money'=>$faker->randomNumber(4, true),
        'make_card'=>$faker->creditCardNumber,
        'account_holder'=>$faker->name('female'),
        'bank_holder'=> $faker->creditCardType,
        'ask_time'=>$faker->dateTimeThisYear('now', 'PRC')
    ];
});
