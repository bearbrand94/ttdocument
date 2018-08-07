<?php

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
        App\Role::truncate();
        App\Role::create(['name' => 'Webadmin']);
        App\Role::create(['name' => 'Supervisor']);
        App\Role::create(['name' => 'Staff']);
        App\Role::create(['name' => 'Receptionist']);      
    }
}
