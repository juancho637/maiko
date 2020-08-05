<?php

use App\Accesory;
use App\Inspection;
use Illuminate\Database\Seeder;

class AccesoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Inspection::all()->each(function ($inspection) {
            factory(Accesory::class, 5)->create([
                'inspection_id' => $inspection->id
            ]);
        });
    }
}
