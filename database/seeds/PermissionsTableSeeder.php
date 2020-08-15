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

        // States
        Permission::create(['name' => 'view states', 'module' => 'states']);
        Permission::create(['name' => 'view state', 'module' => 'states']);
        Permission::create(['name' => 'create states', 'module' => 'states']);
        Permission::create(['name' => 'edit states', 'module' => 'states']);
        Permission::create(['name' => 'delete states', 'module' => 'states']);

        // Cities
        Permission::create(['name' => 'view cities', 'module' => 'cities']);
        Permission::create(['name' => 'view city', 'module' => 'cities']);
        Permission::create(['name' => 'create cities', 'module' => 'cities']);
        Permission::create(['name' => 'edit cities', 'module' => 'cities']);
        Permission::create(['name' => 'delete cities', 'module' => 'cities']);

        // Companies
        Permission::create(['name' => 'view companies', 'module' => 'companies']);
        Permission::create(['name' => 'view company', 'module' => 'companies']);
        Permission::create(['name' => 'create companies', 'module' => 'companies']);
        Permission::create(['name' => 'edit companies', 'module' => 'companies']);
        Permission::create(['name' => 'delete companies', 'module' => 'companies']);

        // Clients
        Permission::create(['name' => 'view clients', 'module' => 'clients']);
        Permission::create(['name' => 'view client', 'module' => 'clients']);
        Permission::create(['name' => 'create clients', 'module' => 'clients']);
        Permission::create(['name' => 'edit clients', 'module' => 'clients']);
        Permission::create(['name' => 'delete clients', 'module' => 'clients']);

        // Tanks
        Permission::create(['name' => 'view tanks', 'module' => 'tanks']);
        Permission::create(['name' => 'view tank', 'module' => 'tanks']);
        Permission::create(['name' => 'create tanks', 'module' => 'tanks']);
        Permission::create(['name' => 'edit tanks', 'module' => 'tanks']);
        Permission::create(['name' => 'delete tanks', 'module' => 'tanks']);

        // WorkOrders
        Permission::create(['name' => 'view work orders', 'module' => 'work orders']);
        Permission::create(['name' => 'view work order', 'module' => 'work orders']);
        Permission::create(['name' => 'create work orders', 'module' => 'work orders']);
        Permission::create(['name' => 'edit work orders', 'module' => 'work orders']);
        Permission::create(['name' => 'delete work orders', 'module' => 'work orders']);

        // Inspections
        Permission::create(['name' => 'view inspections', 'module' => 'inspections']);
        Permission::create(['name' => 'view inspection', 'module' => 'inspections']);
        //  Permission::create(['name' => 'create inspections', 'module' => 'inspections']);
        Permission::create(['name' => 'edit inspections', 'module' => 'inspections']);
        Permission::create(['name' => 'delete inspections', 'module' => 'inspections']);
        Permission::create(['name' => 'download inspection cert', 'module' => 'inspections']);

        // Corrosions
        Permission::create(['name' => 'view corrosions', 'module' => 'corrosions']);
        Permission::create(['name' => 'view corrosion', 'module' => 'corrosions']);
        //  Permission::create(['name' => 'create corrosions', 'module' => 'corrosions']);
        Permission::create(['name' => 'edit corrosions', 'module' => 'corrosions']);
        Permission::create(['name' => 'delete corrosions', 'module' => 'corrosions']);

        // Dents
        Permission::create(['name' => 'view dents', 'module' => 'dents']);
        Permission::create(['name' => 'view dent', 'module' => 'dents']);
        //  Permission::create(['name' => 'create dents', 'module' => 'dents']);
        Permission::create(['name' => 'edit dents', 'module' => 'dents']);
        Permission::create(['name' => 'delete dents', 'module' => 'dents']);

        // Questions
        Permission::create(['name' => 'view questions', 'module' => 'questions']);
        Permission::create(['name' => 'view question', 'module' => 'questions']);
        Permission::create(['name' => 'create questions', 'module' => 'questions']);
        Permission::create(['name' => 'edit questions', 'module' => 'questions']);
        Permission::create(['name' => 'delete questions', 'module' => 'questions']);
    }
}
