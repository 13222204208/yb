<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Betting;
use Faker\Generator as Faker;

$factory->define(Betting::class, function (Faker $faker) {
    return [
        'username'=>$faker->phoneNumber,
        'platform_name'=>$faker->randomElement(['taptap', '多玩', '大脚']),
        'login_ip'=>$faker->ipv4,
        'game_name'=>$faker->randomElement(['wow', '大话西游', '梦幻西游']),
        'room_num'=>$faker->randomElement(['五号房', '六号房间', '八号房间']),
        'bottom_pour'=>$faker->randomNumber(3, true),
        'group_money'=>$faker->randomNumber(3, true),
        'bottom_pour_time'=>$faker->dateTimeThisYear('+10 days', 'PRC'),
    ];
});
