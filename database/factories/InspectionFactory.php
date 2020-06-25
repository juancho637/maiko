<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\City;
use App\User;
use App\Status;
use App\Inspection;
use App\Tank;
use App\WorkOrder;
use Faker\Generator as Faker;

$factory->define(Inspection::class, function (Faker $faker) {
    $active = Status::abbreviation('gen-act')->id;
    $work_order = WorkOrder::all()->random(1)->first();
    $tank = Tank::all()->random(1)->first();

    return [
        'status_id' => $active,
        'user_id' => User::role('inspector')->get()->random(1)->first()->id,
        'work_order_id' => $work_order->id,
        'city_id' => $tank->client->city_id,
        'tank_id' => $tank->id,
        'date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'address' => $tank->client->address,
        'light_intensity' => $faker->numberBetween($min = 20, $max = 30),
        'humidity' => $faker->numberBetween($min = 20, $max = 30),
        'temperature' => $faker->numberBetween($min = 20, $max = 30),
        'latitude' => $faker->latitude($min = -90, $max = 90),
        'longitude' => $faker->longitude($min = -180, $max = 180),
        'observation' => $faker->sentence(5, false),
    ];
});
