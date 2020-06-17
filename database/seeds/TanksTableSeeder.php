<?php

use App\Tank;
use App\Client;
use Illuminate\Database\Seeder;

class TanksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Client::all()->each(function ($client) {
            factory(Tank::class, 2)->create([
                'client_id' => $client->id,
            ]);
        });
    }
}
