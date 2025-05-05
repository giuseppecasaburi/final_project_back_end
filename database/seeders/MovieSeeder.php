<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 30; $i++) {
            $newMovie = new Movie();

            $newMovie->title = $faker->sentence(3);
            $newMovie->story = $faker->paragraph();
            $newMovie->year_of_publication = $faker->date();
            $newMovie->duration = $faker->numberBetween(50, 200);

            $newMovie->save();

        }
    }
}
