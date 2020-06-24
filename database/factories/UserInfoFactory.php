<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\UserInfo;
use Faker\Generator as Faker;

$factory->define(UserInfo::class, function (Faker $faker) {
    return [
        'username'=>$faker->phoneNumber,
        'nickname'=>$faker->title('female'),
        'password'=>$faker->password,
        'take_password'=>$faker->password,
        'recharge_account'=>$faker->creditCardNumber,
        'reward_account'=>$faker->creditCardNumber,
        'true_name'=>$faker->name('female'),
        'phone'=>$faker->phoneNumber,
        'register_ip'=>$faker->ipv4,
        'register_time'=>$faker->dateTimeThisYear('now', 'PRC'),
        'login_time'=>$faker->dateTimeThisYear('now', 'PRC'),
        'off_time'=>$faker->dateTimeThisYear('now', 'PRC'),
        'ask_time'=>$faker->dateTimeThisYear('now', 'PRC'),
        'account_freeze'=>$faker->dateTimeThisYear('now', 'PRC'),
    ];
});
