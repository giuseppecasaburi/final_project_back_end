<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $contents_cards_show = [
            [
                'route' => 'movies.index',
                'img' => 'films.webp',
                'title' => 'Films',
                'text' => "Ogni film è un'opera unica che racconta una storia attraverso immagini, suoni ed emozioni. Può appartenere a diversi generi e avere uno o più registi. Ogni titolo è accompagnato da un descrizione, una locandina e dati specifici come l’anno di uscita e la durata.",
            ],
            [
                'route' => 'directors.index',
                'img' => 'tarantino.webp',
                'title' => 'Registi',
                'text' => 'I registi sono le menti creative dietro la macchina da presa. Supervisionano ogni aspetto della produzione di un film, dalla sceneggiatura alla direzione degli attori, trasformando idee in esperienze visive. Ogni regista può avere diretto uno o più film.'
            ],
            [
                'route' => 'genre.index',
                'img' => 'generi.jpg',
                'title' => 'Generi',
                'text' => 'I generi classificano i film in base a temi e stili narrativi. Thriller, commedia, drammatico, fantascienza: ogni genere aiuta lo spettatore a scegliere l’atmosfera e il tipo di emozione che vuole vivere. Un film può appartenere a più generi'
            ]
        ];

        $contents_cards_edit = [
            [
                'route' => 'movies.create',
                'img' => 'film.jpg',
                'title' => 'Film',
                'text' => 'Aggiungi un nuovo film, con titolo, regista, genere e immagine.'
            ], 
            [
                'route' => 'directors.create',
                'img' => 'nolan.png',
                'title' => 'Regista',
                'text' => 'Aggiungi un nuovo regista da associare ai tuoi film.'
            ],
            [
                'route' => 'genre.create',
                'img' => 'genere.jpg',
                'title' => 'Genere',
                'text' => 'Aggiungi un nuovo genere per classificare meglio i film presenti.'
            ]
        ];

        return view("dashboard", compact("contents_cards_show", "contents_cards_edit"));
    }
}
