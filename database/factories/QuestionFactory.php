<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Question;
use Faker\Generator as Faker;

$factory->define(Question::class, function (Faker $faker) {
    return [
        'module' => $faker->randomElement(Question::MODULES),
        'question' => $faker->sentence(5, false),
        'response_type' => $faker->randomElement(Question::RESPONSE_TYPES),
        'possible_response' => implode(', ', $faker->words($nb = 4, $asText = false)),
    ];
});
