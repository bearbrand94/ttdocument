<?php

use Illuminate\Database\Seeder;
use App\Document_Send;

class DocumentsSendSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's clear the users table first
        Documents_Receive::truncate();

        $faker = \Faker\Factory::create();

        // And now let's generate a few dozen users for our app:
        for ($i = 0; $i < 30; $i++) {
            Document_Send::create([
            	'requested_by' => $faker->numberBetween(0,2),
                'submitted_to' => $faker->email,
                'send_to' => $faker->address,
                'letter_number' => $faker->phoneNumber,
                'approval_status' => $faker->numberBetween(0,2),
                'note' => $faker->catchPhrase,
            ]);
        }
    }
}
