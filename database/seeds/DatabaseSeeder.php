<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

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
            $this->call(QuestionsTableSeeder::class);
        } else {
            Storage::deleteDirectory('inspections');
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
            $this->call(AccesoriesTableSeeder::class);
            $this->call(CorrosionsTableSeeder::class);
            $this->call(AnswersTableSeeder::class);
        }
    }
}
