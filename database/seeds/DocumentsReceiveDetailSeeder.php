<?php

use Illuminate\Database\Seeder;
use App\Document_Receive_Detail;

class DocumentsReceiveDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's clear the users table first
        Document_Receive_Detail::truncate();

        $faker = \Faker\Factory::create();

        // And now let's generate a few dozen users for our app:
        for ($i = 1; $i <= 30; $i++) {
        	for ($j = 0; $j < $faker->numberBetween(1,10); $j++) {
	            Document_Receive_Detail::create([
	            	'document_receive_id' => $i,
	                'description' => $faker->catchPhrase,
	            ]);
        	}
        }
    }
}
