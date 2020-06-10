<?php

use App\Status;
use App\Country;
use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $active = Status::abbreviation('gen-act')->id;

        Country::create([
            'id' => 47,
            'status_id' => $active,
            'short_name' => 'CO',
            'name' => 'Colombia',
            'phone_code' => 57,
        ]);
    }
}
