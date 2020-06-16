<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\City;
use App\Client;
use App\Status;
use App\Company;
use Faker\Generator as Faker;

$factory->define(Client::class, function (Faker $faker) {
    $active = Status::abbreviation('gen-act')->id;

    return [
        'status_id' => $active,
        'company_id' => Company::all()->random(1)->first()->id,
        'city_id' => City::all()->random(1)->first()->id,
        'name' => $faker->company,
        'address' => $faker->address,
    ];
});
