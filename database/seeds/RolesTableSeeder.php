<?php

use App\Permission;
use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $super_admin = Role::create([
            'name' => 'super administrator'
        ]);
        $super_admin->syncPermissions(Permission::all());

        Role::create([
            'name' => 'inspector'
        ]);
    }
}
