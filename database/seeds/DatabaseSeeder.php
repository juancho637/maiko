<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (app()->environment() === 'production') {
            $this->call(StatusesTableSeeder::class);
            $this->call(CountriesTableSeeder::class);
            $this->call(StatesTableSeeder::class);
            $this->call(CitiesTableSeeder::class);
            $this->call(PermissionsTableSeeder::class);
            $this->call(RolesTableSeeder::class);
            $this->call(UsersTableSeeder::class);
        } else {
            $this->call(StatusesTableSeeder::class);
            $this->call(CountriesTableSeeder::class);
            $this->call(StatesTableSeeder::class);
            $this->call(CitiesTableSeeder::class);
            $this->call(PermissionsTableSeeder::class);
            $this->call(RolesTableSeeder::class);
            $this->call(UsersTableSeeder::class);
            $this->call(CompaniesTableSeeder::class);
            $this->call(ClientsTableSeeder::class);
            $this->call(TanksTableSeeder::class);
            $this->call(WorkOrdersTableSeeder::class);
            $this->call(QuestionsTableSeeder::class);
            $this->call(InspectionsTableSeeder::class);
        }
    }
}
