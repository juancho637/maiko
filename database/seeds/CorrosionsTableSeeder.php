<?php

use App\Corrosion;
use App\Inspection;
use Illuminate\Database\Seeder;

class CorrosionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Inspection::all()->each(function ($inspection) {
            factory(Corrosion::class, 1)->create([
                'inspection_id' => $inspection->id,
            ]);
        });
    }
}
