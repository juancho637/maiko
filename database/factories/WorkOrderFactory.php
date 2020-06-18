<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Company;
use App\Status;
use App\WorkOrder;
use Faker\Generator as Faker;

$factory->define(WorkOrder::class, function (Faker $faker) {
    $active = Status::abbreviation('gen-act')->id;

    return [
        'status_id' => $active,
        'company_id' => Company::all()->random(1)->first()->id,
        'quotation' => $faker->numberBetween(100000, 900000),
        'start' => $faker->date('Y-m-d', 'now'),
        'duration' => $faker->numberBetween(2, 9).' '.$faker->randomElement(['horas','dias']),
        'transport' => $faker->sentence(3, false),
        'feeding' => $faker->sentence(3, false),
        'hotel' => $faker->sentence(3, false),
        'lodging' => $faker->sentence(3, false),
    ];
});
