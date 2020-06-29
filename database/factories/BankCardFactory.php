<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\BankCard;
use Faker\Generator as Faker;

$factory->define(BankCard::class, function (Faker $faker) {
    return [
        'card_name'=>$faker->name('female'),
        'bank_name'=>$faker->bank,
        'open_bank'=>$faker->bank."支行",
        'card_num'=>$faker->creditCardNumber,
        'min_money'=>$faker->randomNumber(4, true),
        'max_money'=>$faker->randomNumber(4, true),
        'day_max_money'=>$faker->randomNumber(4, true),
        'day_money'=>$faker->randomNumber(3, true),
    ];
});
