<?php

namespace App\Http\Controllers;

use App\Models\Director;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        // Carico i dati per popolare i filtri
        $directorsList = Director::all();
        $genresList    = Genre::all();

        // Prendo i parametri
        $search    = $request->query('query_search');
        $genreIds  = $request->input('genres', []);
        $directorIds = $request->input('directors', []);

        // Costruisco la query dei film
        $movies = Movie::query()
            // filtro testo
            ->when($search, fn($q) => $q->where(
                fn($q2) =>
                $q2->where('title', 'like', "%{$search}%")
                    ->orWhere('story', 'like', "%{$search}%")
            ))
            // filtro generi
            ->when(!empty($genreIds), fn($q) => $q->whereHas(
                'genres',
                fn($q2) =>
                $q2->whereIn('genres.id', $genreIds)
            ))
            // filtro registi
            ->when(!empty($directorIds), fn($q) => $q->whereIn('director_id', $directorIds))
            ->get();

        // Se c'è ricerca testuale, cerco anche i registi matching
        $directors = collect();
        if ($search) {
            $directors = Director::where('name', 'like', "%{$search}%")
                ->orWhere('surname', 'like', "%{$search}%")
                ->get();
        }

        return view('search.index', [
            'movies'         => $movies,
            'directors'      => $directors,
            'genresList'     => $genresList,
            'directorsList'  => $directorsList,
            'search'         => $search,
            'selectedGenres' => $genreIds,
            'selectedDirectors' => $directorIds,
        ]);
    }
}