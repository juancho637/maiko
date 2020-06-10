<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Roles
        Permission::create(['name' => 'view roles', 'module' => 'roles']);
        Permission::create(['name' => 'view role', 'module' => 'roles']);
        Permission::create(['name' => 'create roles', 'module' => 'roles']);
        Permission::create(['name' => 'edit roles', 'module' => 'roles']);
        Permission::create(['name' => 'delete roles', 'module' => 'roles']);

         // Users
         Permission::create(['name' => 'view users', 'module' => 'users']);
         Permission::create(['name' => 'view user', 'module' => 'users']);
         Permission::create(['name' => 'create users', 'module' => 'users']);
         Permission::create(['name' => 'edit users', 'module' => 'users']);
         Permission::create(['name' => 'delete users', 'module' => 'users']);

         // Countries
         Permission::create(['name' => 'view countries', 'module' => 'countries']);
         Permission::create(['name' => 'view country', 'module' => 'countries']);
         Permission::create(['name' => 'create countries', 'module' => 'countries']);
         Permission::create(['name' => 'edit countries', 'module' => 'countries']);
         Permission::create(['name' => 'delete countries', 'module' => 'countries']);
    }
}
