<?php

namespace Database\Seeders;

use App\Models\Director;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class DirectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $directors = [
            [
                'nome' => 'Quentin',
                'cognome' => 'Tarantino',
                'data_nascita' => '1963-03-27',
                'nazionalità' => 'Statunitense'
            ],
            [
                'nome' => 'Christopher',
                'cognome' => 'Nolan',
                'data_nascita' => '1970-07-30',
                'nazionalità' => 'Britannico'
            ],
            [
                'nome' => 'Martin',
                'cognome' => 'Scorsese',
                'data_nascita' => '1942-11-17',
                'nazionalità' => 'Statunitense'
            ],
            [
                'nome' => 'Steven',
                'cognome' => 'Spielberg',
                'data_nascita' => '1946-12-18',
                'nazionalità' => 'Statunitense'
            ],
            [
                'nome' => 'Sofia',
                'cognome' => 'Coppola',
                'data_nascita' => '1971-05-14',
                'nazionalità' => 'Statunitense'
            ],
            [
                'nome' => 'Hayao',
                'cognome' => 'Miyazaki',
                'data_nascita' => '1941-01-05',
                'nazionalità' => 'Giapponese'
            ],
            [
                'nome' => 'Pedro',
                'cognome' => 'Almodóvar',
                'data_nascita' => '1949-09-25',
                'nazionalità' => 'Spagnola'
            ],
            [
                'nome' => 'Greta',
                'cognome' => 'Gerwig',
                'data_nascita' => '1983-08-04',
                'nazionalità' => 'Statunitense'
            ],
        ];

        foreach ($directors as $director) {
            $newDirector = new Director();

            $newDirector->name = $director["nome"];
            $newDirector->surname = $director["cognome"];
            $newDirector->date_of_birth = $director["data_nascita"];
            $newDirector->nationality = $director["nazionalità"];
            $newDirector->description = $faker->paragraph();

            $newDirector->save();
        }
        
    }
}
