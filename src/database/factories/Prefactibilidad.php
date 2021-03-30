<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Prefactibilidad::class, function (Faker $faker) {
    return [
        'fecha'=>$faker->dateTime($max = 'now', $timezone = null),
        'User_id' => $faker->numberBetween($min = 1, $max = App\User::all()->count()),
        'typeArea' => $faker->text($maxNbChars = 10),
        'AreaConstruccion_id' => $faker->numberBetween($min = 1, $max = App\AreaConstruccion::all()->count()), 
        'proyecto_id' => $faker->numberBetween($min = 1, $max = App\Proyecto::all()->count()), 
        'Acabado_id' => $faker->numberBetween($min = 1, $max = App\TipoAcabado::all()->count()),
        'subtotalAreaConstruccion'=>$faker->randomFloat($nbMaxDecimals = 2, $min = 0.1, $max = 999999),
        'areaCirculacionParedes'=>$faker->randomFloat($nbMaxDecimals = 2, $min = 0.1, $max = 999999),
        'areaTotalConstruccion'=>$faker->randomFloat($nbMaxDecimals = 2, $min = 0.1, $max = 999999),
    ];
});
