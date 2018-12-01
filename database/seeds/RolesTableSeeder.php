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
        App\Role::create([
            'name' => 'Webadmin',
            'permissions' => [
                'review-document-send' => true,
                'review-document-receive' => true,
                'manage-document-send' => true,
                'manage-document-receive' => true,
                'create-document-send' => true,
                'create-document-receive' => true,
                'manage-user' => true,
                'manage-client' => true,
                'manage-supervisor-staff-relation' => true,
                'manage-staff-client-relation' => true,
                'manage-my-account' => true,
            ]
        ]);
        App\Role::create([
            'name' => 'Supervisor',
            'permissions' => [
                'review-document-send' => true,
                'review-document-receive' => true,
                'manage-document-send' => true,
                'manage-document-receive' => true,
                'manage-client' => true,
                'manage-staff-client-relation' => true,
                'manage-my-account' => true,
            ]
        ]);
        App\Role::create([
            'name' => 'Staff',
            'permissions' => [
                'review-document-receive' => true,
                'manage-document-send' => true,
                'manage-document-receive' => true,
                'create-document-send' => true,
                'manage-client' => true,
                'manage-my-account' => true,
            ]
        ]);
        App\Role::create([
            'name' => 'Receptionist',
            'permissions' => [
                'manage-document-send' => true,
                'manage-document-receive' => true,
                'create-document-receive' => true,
                'manage-client' => true,
                'manage-my-account' => true,
            ]
        ]);    
        App\Role::create([
            'name' => 'Guest',
            'permissions' => [
                'manage-my-account' => true,
            ]
        ]);  
    }
}
