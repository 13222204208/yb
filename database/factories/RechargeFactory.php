<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Model\Recharge;
use Faker\Generator as Faker;

$factory->define(Recharge::class, function (Faker $faker) {
    return [
        'order_num'=>$faker->shuffle('123456789abcdefghijk'),
        'username'=>$faker->userName,
        'recharge_money'=>$faker->randomNumber(5, true),
        'remit_way'=>$faker->creditCardType,
        'remit_card'=>$faker->creditCardNumber,
        'make_card'=>$faker->creditCardNumber,
        'remit_time'=>$faker->dateTimeThisYear('now', 'PRC')
    ];
});
