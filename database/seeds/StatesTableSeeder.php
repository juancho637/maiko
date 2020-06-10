<?php

use App\State;
use App\Status;
use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $active = Status::abbreviation('gen-act')->id;

        State::create([
            'id' => 775,
            'status_id' => $active,
            'country_id' => 47,
            'name' => 'Amazonas'
        ]);
        State::create([
            'id' => 776,
            'status_id' => $active,
            'country_id' => 47,
            'name' => 'Antioquia'
        ]);
        State::create([
            'id' => 777,
            'status_id' => $active,
            'country_id' => 47,
            'name' => 'Arauca'
        ]);
        State::create([
            'id' => 778,
            'status_id' => $active,
            'country_id' => 47,
            'name' => 'Atlantico'
        ]);
        State::create([
            'id' => 779,
            'status_id' => $active,
            'country_id' => 47,
            'name' => 'Bogota'
        ]);
        State::create([
            'id' => 780,
            'status_id' => $active,
            'country_id' => 47,
            'name' => 'Bolivar'
        ]);
        State::create([
            'id' => 781,
            'status_id' => $active,
            'country_id' => 47,
            'name' => 'Boyaca'
        ]);
        State::create([
            'id' => 782,
            'status_id' => $active,
            'country_id' => 47,
            'name' => 'Caldas'
        ]);
        State::create([
            'id' => 783,
            'status_id' => $active,
            'country_id' => 47,
            'name' => 'Caqueta'
        ]);
        State::create([
            'id' => 784,
            'status_id' => $active,
            'country_id' => 47,
            'name' => 'Casanare'
        ]);
        State::create([
            'id' => 785,
            'status_id' => $active,
            'country_id' => 47,
            'name' => 'Cauca'
        ]);
        State::create([
            'id' => 786,
            'status_id' => $active,
            'country_id' => 47,
            'name' => 'Cesar'
        ]);
        State::create([
            'id' => 787,
            'status_id' => $active,
            'country_id' => 47,
            'name' => 'Choco'
        ]);
        State::create([
            'id' => 788,
            'status_id' => $active,
            'country_id' => 47,
            'name' => 'Cordoba'
        ]);
        State::create([
            'id' => 789,
            'status_id' => $active,
            'country_id' => 47,
            'name' => 'Cundinamarca'
        ]);
        State::create([
            'id' => 790,
            'status_id' => $active,
            'country_id' => 47,
            'name' => 'Guainia'
        ]);
        State::create([
            'id' => 791,
            'status_id' => $active,
            'country_id' => 47,
            'name' => 'Guaviare'
        ]);
        State::create([
            'id' => 792,
            'status_id' => $active,
            'country_id' => 47,
            'name' => 'Huila'
        ]);
        State::create([
            'id' => 793,
            'status_id' => $active,
            'country_id' => 47,
            'name' => 'La Guajira'
        ]);
        State::create([
            'id' => 794,
            'status_id' => $active,
            'country_id' => 47,
            'name' => 'Magdalena'
        ]);
        State::create([
            'id' => 795,
            'status_id' => $active,
            'country_id' => 47,
            'name' => 'Meta'
        ]);
        State::create([
            'id' => 796,
            'status_id' => $active,
            'country_id' => 47,
            'name' => 'Narino'
        ]);
        State::create([
            'id' => 797,
            'status_id' => $active,
            'country_id' => 47,
            'name' => 'Norte de Santander'
        ]);
        State::create([
            'id' => 798,
            'status_id' => $active,
            'country_id' => 47,
            'name' => 'Putumayo'
        ]);
        State::create([
            'id' => 799,
            'status_id' => $active,
            'country_id' => 47,
            'name' => 'Quindio'
        ]);
        State::create([
            'id' => 800,
            'status_id' => $active,
            'country_id' => 47,
            'name' => 'Risaralda'
        ]);
        State::create([
            'id' => 801,
            'status_id' => $active,
            'country_id' => 47,
            'name' => 'San Andres y Providencia'
        ]);
        State::create([
            'id' => 802,
            'status_id' => $active,
            'country_id' => 47,
            'name' => 'Santander'
        ]);
        State::create([
            'id' => 803,
            'status_id' => $active,
            'country_id' => 47,
            'name' => 'Sucre'
        ]);
        State::create([
            'id' => 804,
            'status_id' => $active,
            'country_id' => 47,
            'name' => 'Tolima'
        ]);
        State::create([
            'id' => 805,
            'status_id' => $active,
            'country_id' => 47,
            'name' => 'Valle del Cauca'
        ]);
        State::create([
            'id' => 806,
            'status_id' => $active,
            'country_id' => 47,
            'name' => 'Vaupes'
        ]);
        State::create([
            'id' => 807,
            'status_id' => $active,
            'country_id' => 47,
            'name' => 'Vichada'
        ]);
    }
}
