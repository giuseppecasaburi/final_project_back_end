<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {

        $genres = [
            'Azione',
            'Avventura',
            'Animazione',
            'Biografico',
            'Commedia',
            'Crime',
            'Documentario',
            'Drammatico',
            'Fantasy',
            'Fantascienza',
            'Giallo',
            'Guerra',
            'Horror',
            'Musicale',
            'Romantico',
            'Storico',
            'Thriller',
            'Western',
            'Sportivo',
            'Famiglia'
        ];

        foreach($genres as $genre) {
            $newGenre = new Genre();

            $newGenre->name = $genre;
            $newGenre->color = $faker->hexColor();

            $newGenre->save();
        }
    }
}
