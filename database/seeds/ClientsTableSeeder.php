<?php

use App\Client;
use App\Company;
use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::all()->each(function ($company) {
            factory(Client::class, 5)->create([
                'company_id' => $company->id,
            ]);
        });
    }
}
