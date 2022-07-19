<?php

namespace Database\Seeders;

use App\Models\Lots;
use Faker\Factory;
use Illuminate\Database\Seeder;

class LotsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        for ($i = 150; $i; $i--) {
            Lots::create([
                'title' => ucfirst($faker->words(rand(1, 3), true)),
                'user_id' => 1,
                'description' => ucfirst($faker->words(rand(2, 13), true)),
                'author' => ucfirst($faker->words(1, true)),
                'num' => rand(1, 10000),
                'low_estimate' => rand(1, 10000),
                'high_estimate' => rand(1, 10000),
                'starting_price' => rand(1, 10000),
            ]);
        }
    }
}
