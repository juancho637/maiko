<?php

use App\Status;
use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Estados generales
        Status::create([
            'name' => 'activo',
            'description' => 'registro activo en la base de datos',
            'abbreviation' => 'gen-act',
            'type' => 'general',
        ]);
        Status::create([
            'name' => 'eliminado',
            'description' => 'registro eliminado parcialmente de la base de datos',
            'abbreviation' => 'gen-del',
            'type' => 'general-inac',
        ]);
        Status::create([
            'name' => 'inactivo',
            'description' => 'registro inactivo en la base de datos',
            'abbreviation' => 'gen-inact',
            'type' => 'general-inac',
        ]);

        // Inspection statuses
        Status::create([
            'name' => 'completada',
            'description' => 'inspección finalizada',
            'abbreviation' => 'insp-comp',
            'type' => 'inspections',
        ]);
    }
}
