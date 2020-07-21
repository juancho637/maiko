<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\City;
use App\Status;
use App\Company;
use App\WorkOrder;
use Faker\Generator as Faker;

$factory->define(WorkOrder::class, function (Faker $faker) {
    $active = Status::abbreviation('gen-act')->id;

    return [
        'status_id' => $active,
        'company_id' => Company::all()->random(1)->first()->id,
        'quotation' => 'CO-'.$faker->numberBetween(1, 900000),
        'start' => $faker->date('Y-m-d', 'now'),
        'work_order_number' => 'MIK-'.$faker->unique()->numberBetween(1, 900000),
        'address' => $faker->address,
        'city_id' => City::all()->random(1)->first()->id,
        'contact_name' => $faker->name,
        'contact_number' => $faker->phoneNumber,
        'inspection_type' => $faker->randomElement(['total','parcial']),
        'certificate_name' => $faker->company,
        'owner_email' => $faker->email,
        'emails' => $faker->email,
        'invoice_name' => $faker->name,
        'invoice_nit' => $faker->numberBetween(100000, 900000),
        'invoice_contact_name' => $faker->email,
        'invoice_mail' => $faker->email,
        'r_mkc_002' => $faker->boolean,
        'r_mkc_031' => $faker->boolean,
        'r_mkc_032' => $faker->boolean,
        'r_mkc_033' => $faker->boolean,
        'r_mkc_045' => $faker->boolean,
        'r_mkc_046' => $faker->boolean,
        'r_mkc_090' => $faker->boolean,
        'tape_measure' => $faker->boolean,
        'caliper' => $faker->boolean,
        'multimeter' => $faker->boolean,
        'videoscopio' => $faker->boolean,
        'photometer' => $faker->boolean,
        'thermohygometer' => $faker->boolean,
        'bridge_cam_gauge' => $faker->boolean,
        'depth_gauge' => $faker->boolean,
        'gauge' => $faker->boolean,
        'thickness_gauge_ex' => $faker->boolean,
        'reference_block_ladder_ex' => $faker->boolean,
        'caliper_bagel' => $faker->boolean,
        'thickness_gauge_in' => $faker->boolean,
        'reference_block_ladder_in' => $faker->boolean,
        'thermometer' => $faker->boolean,
        'gas_multidetector' => $faker->boolean,
        'harness' => $faker->boolean,
        'mask' => $faker->boolean,
        'slings' => $faker->boolean,
        'lifeline' => $faker->boolean,
        'atmospheremeter' => $faker->boolean,
        'observation' => $faker->sentence(5, false),
        'transport' => $faker->sentence(3, false),
        'hospitals' => $faker->sentence(3, false),
    ];
});
