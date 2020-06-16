<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\City;
use App\Status;
use App\Company;
use Faker\Generator as Faker;

$factory->define(Company::class, function (Faker $faker) {
    $active = Status::abbreviation('gen-act')->id;

    return [
        'status_id' => $active,
        'city_id' => City::all()->random(1)->first()->id,
        'name' => $faker->company,
        'address' => $faker->address,
        'contact_name' => $faker->name,
        'contact_number' => $faker->tollFreePhoneNumber,
    ];
});
