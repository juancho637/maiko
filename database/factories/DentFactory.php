<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Dent;
use App\Status;
use App\Inspection;
use Faker\Generator as Faker;

$factory->define(Dent::class, function (Faker $faker) {
    $active = Status::abbreviation('gen-act')->id;

    return [
        'status_id' => $active,
        'inspection_id' => Inspection::all()->random(1)->first()->id,
        'large' => $faker->numberBetween($min = 20, $max = 30),
        'width' => $faker->numberBetween($min = 20, $max = 30),
        'average' => $faker->numberBetween($min = 20, $max = 30),
        'observation' => $faker->sentence(5, false),
    ];
});
