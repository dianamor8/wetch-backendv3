<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\AreaVivienda;
use App\TipoAreaVivienda;
use Faker\Generator as Faker;

$factory->define(App\AreaVivienda::class, function (Faker $faker) {
    return [
        'area'=>$faker->randomFloat($nbMaxDecimals = 2, $min = 0.1, $max = 999999),
        'unidadMedida'=>$faker->word(),
        'TipoAreaVivienda_id' => $faker->numberBetween($min = 1, $max = App\TipoAreaVivienda::all()->count()),
        'Ambiente_id' => $faker->numberBetween($min = 1, $max = App\Ambiente::all()->count()),
        'propietario' => $faker->numberBetween($min = 1, $max = App\User::all()->count()),
    ];
});
