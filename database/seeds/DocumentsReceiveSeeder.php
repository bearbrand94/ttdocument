<?php

use Illuminate\Database\Seeder;
use App\Document_Receive;

class DocumentsReceiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's clear the users table first
        Document_Receive::truncate();

        $faker = \Faker\Factory::create();

        // And now let's generate a few dozen users for our app:
        for ($i = 0; $i < 30; $i++) {
            Document_Receive::create([
            	'client' => $faker->numberBetween(1,30),
                'receiver1' => $faker->numberBetween(7,10),
                'receiver2' => $faker->numberBetween(4,6),
                'letter_number' => $faker->isbn10,
                'review_status' => $faker->numberBetween(0,2),
                'note' => $faker->catchPhrase,
            ]);
        }
    }
}
