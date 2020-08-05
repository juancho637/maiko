<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Accesory;
use App\Inspection;
use Faker\Generator as Faker;

$factory->define(Accesory::class, function (Faker $faker) {
    return [
        'inspection_id' => Inspection::all()->random(1)->first()->id,
        'name' => $faker->sentence(1, false),
    ];
});
