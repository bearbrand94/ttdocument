<?php

use Illuminate\Database\Seeder;
use App\Document_Send_Detail;

class DocumentsSendDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Document_Send_Detail::truncate();

        $faker = \Faker\Factory::create();

        // And now let's generate a few dozen users for our app:
        for ($i = 1; $i <= 30; $i++) {
        	for ($j = 0; $j < $faker->numberBetween(1,10); $j++) {
	            Document_Send_Detail::create([
	            	'document_send_id' => $i,
	                'description' => $faker->text,
	            ]);
        	}
        }
    }
}
