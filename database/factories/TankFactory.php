<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Tank;
use App\Client;
use App\Status;
use Faker\Generator as Faker;

$factory->define(Tank::class, function (Faker $faker) {
    $active = Status::abbreviation('gen-act')->id;

    return [
        'status_id' => $active,
        'client_id' => Client::all()->random(1)->first()->id,
        'internal_serial_number' => $faker->numberBetween($min = 1000, $max = 9000),
        'serial_number' => $faker->ean8,
        'maker' => $faker->company,
        'fabrication_year' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'capacity' => $faker->numberBetween($min = 100, $max = 200),
        'large' => $faker->numberBetween($min = 100, $max = 200),
        'diameter' => $faker->numberBetween($min = 100, $max = 200),
        'head_thickness' => $faker->numberBetween($min = 50, $max = 100),
        'body_thickness' => $faker->numberBetween($min = 100, $max = 200),
    ];
});
