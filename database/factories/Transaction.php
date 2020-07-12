<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Transaction;
use Faker\Generator as Faker;

$factory->define(Transaction::class, function (Faker $faker) {
    return [
        'order_num'=>$faker->shuffle('123456789abcdefghijk'),
        'username'=>$faker->phoneNumber,
        'business_type'=>$faker->randomElement(['存款', '转帐', '取款','其它']),
        'business_mode'=>$faker->randomElement(['支付宝', '银行卡', '网银支付']),
        'business_money'=>$faker->randomNumber(3, true)+$faker->randomFloat(2, 4, 10),
        'balance'=>$faker->randomNumber(3, true)+$faker->randomFloat(2, 4, 10),
        'ask_time'=>$faker->dateTimeThisYear('+10 days', 'PRC'),
        'auditing_time'=>$faker->dateTimeThisYear('+10 days', 'PRC'),
    ];
});
