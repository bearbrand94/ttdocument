<?php

use Illuminate\Database\Seeder;
use App\Client;
use App\User;
use App\Staff_Relation;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's clear the users table first
        Client::truncate();

        $faker = \Faker\Factory::create();

        // And now let's generate a few dozen users for our app:
        for ($i = 0; $i < 30; $i++) {
            $client_data = Client::create([
            	'name' => $faker->company,
                'email' => $faker->email,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
            ]);
            $staff_handle = User::get_user_data()->where("roles.name", "staff")->inRandomOrder()->get()[0];
            $staff_relation = new Staff_Relation();
            $staff_relation->staff_id = $staff_handle->id;
            $staff_relation->client_id = $client_data->id;
            $staff_relation->save();
        }
    }
}
