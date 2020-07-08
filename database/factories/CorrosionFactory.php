<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Status;
use App\Corrosion;
use App\Inspection;
use Faker\Generator as Faker;

$factory->define(Corrosion::class, function (Faker $faker) {
    $active = Status::abbreviation('gen-act')->id;

    return [
        'status_id' => $active,
        'inspection_id' => Inspection::all()->random(1)->first()->id,
        'corrosion_type' => $faker->randomElement(Corrosion::CORROSION_TYPES),
        'remaining_thickness' => $faker->numberBetween($min = 20, $max = 30),
        'area' => $faker->numberBetween($min = 20, $max = 30),
        'large' => $faker->numberBetween($min = 20, $max = 30),
        'thickness' => $faker->numberBetween($min = 20, $max = 30),
        'depth' => $faker->numberBetween($min = 20, $max = 30),
        'observation' => $faker->sentence(5, false),
    ];
});
