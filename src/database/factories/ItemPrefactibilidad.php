<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\ItemPrefactibilidad::class, function (Faker $faker) {
    return [
        'cantidad'=>$faker->randomDigit(),
        'subtotal'=>$faker->randomFloat($nbMaxDecimals = 2, $min = 0.1, $max = 999999),
        'Ambiente_id' => $faker->numberBetween($min = 1, $max = App\Ambiente::all()->count()),
        'Prefactbilidad_id' => $faker->numberBetween($min = 1, $max = App\Prefactibilidad::all()->count()),        
        'propietario' => $faker->numberBetween($min = 1, $max = App\User::all()->count()),
    ];
});
