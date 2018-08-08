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
        Document_Send::truncate();

        $faker = \Faker\Factory::create();

        // And now let's generate a few dozen users for our app:
        for ($i = 0; $i < 30; $i++) {
            Document_Send::create([
            	'requested_by' => $faker->numberBetween(4,6),
                'submitted_to' => $faker->numberBetween(7,10),
                'send_to' => $faker->numberBetween(1,30),
                'letter_number' => Document_Send::get_letter_number(),
                'approval_status' => $faker->numberBetween(0,2),
                'note' => $faker->catchPhrase,
            ]);
        }
    }
}
