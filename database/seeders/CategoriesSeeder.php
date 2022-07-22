<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Faker\Factory;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        for ($i = 6; $i; $i--) {
            Category::create(['title' => ucfirst($faker->words(rand(2, 3), true)), 'user_id' => 1]);
        }
    }
}
