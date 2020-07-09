<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Betting;
use Faker\Generator as Faker;

$factory->define(Betting::class, function (Faker $faker) {
    return [
        'username'=>$faker->phoneNumber,
        'platform_name'=>$faker->randomElement(['亚博体育', 'IM体育', 'BG真人', 'AG真人', 'IM电竞']),
        'login_ip'=>$faker->ipv4,
        'game_name'=>$faker->randomElement(['wow', '大话西游', '梦幻西游']),
        'room_num'=>$faker->randomElement(['五号房', '六号房间', '八号房间']),
        'bottom_pour'=>$faker->randomNumber(3, true),
        'group_money'=>$faker->randomNumber(3, true),
        'bottom_pour_time'=>$faker->dateTimeThisYear('+10 days', 'PRC'),
    ];
});
