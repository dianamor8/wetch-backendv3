<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\AreaConstruccion::class, function (Faker $faker) {
    return [
        'callePrincipal'=>$faker->sentence($nbWords = 6, $variableNbWords = true),
        'calleSecundaria'=>$faker->sentence($nbWords = 6, $variableNbWords = true),
        'retiroFrontal'=>$faker->randomFloat($nbMaxDecimals = 2, $min = 0.1, $max = 9999),
        'retiroPosterior'=>$faker->randomFloat($nbMaxDecimals = 2, $min = 0.1, $max = 9999),
        'retiroLateralIzquierdo'=>$faker->randomFloat($nbMaxDecimals = 2, $min = 0.1, $max = 9999),
        'retiroLateralDerecho'=>$faker->randomFloat($nbMaxDecimals = 2, $min = 0.1, $max = 9999),
        'medidaFrente'=>$faker->randomFloat($nbMaxDecimals = 2, $min = 0.1, $max = 999999),
        'medidaFondo'=>$faker->randomFloat($nbMaxDecimals = 2, $min = 0.1, $max = 999999),
        'propietario' => $faker->numberBetween($min = 1, $max = App\User::all()->count()),
    ];
});
