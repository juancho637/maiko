<?php

use App\Role;
use App\User;
use App\Status;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::all()->pluck('id')->toArray();
        $active_id = Status::abbreviation('gen-act')->id;
        $now = Carbon::now()->toDateTimeString();

        $juan = User::create([
            'status_id' => $active_id,
            'full_name' => 'Juan David Garcia Reyes',
            'email' => 'super@maiko.com',
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'email_verified_at' => $now,
        ]);
        $juan->syncRoles($adminRole);

        $inspectorRole = Role::where('name', 'inspector')->first()->id;
        factory(User::class, 5)->create()->each(function ($user) use ($inspectorRole){
            $user->syncRoles($inspectorRole);
        });
    }
}
