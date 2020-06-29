<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\WechatPay;
use Faker\Generator as Faker;

$factory->define(WechatPay::class, function (Faker $faker) {
    return [
        'wechat_name'=>$faker->name('female'),
        'wechat_url'=>$faker->imageUrl(),
        'min_money'=>$faker->randomNumber(4, true),
        'max_money'=>$faker->randomNumber(4, true),
        'day_max_money'=>$faker->randomNumber(4, true),
        'day_money'=>$faker->randomNumber(3, true),
    ];
});
