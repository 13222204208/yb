<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Transaction;
use Faker\Generator as Faker;

$factory->define(Transaction::class, function (Faker $faker) {
    return [
        'order_num'=>$faker->shuffle('123456789abcdefghijk'),
        'username'=>$faker->phoneNumber,
        'business_type'=>$faker->randomElement(['支付宝', '银行卡', '微信']),
        'business_money'=>$faker->randomNumber(3, true),
        'balance'=>$faker->randomNumber(5, true),
        'ask_time'=>$faker->dateTimeThisYear('now', 'PRC'),
        'auditing_time'=>$faker->dateTimeThisYear('now', 'PRC'),
    ];
});
