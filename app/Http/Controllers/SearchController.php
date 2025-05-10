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

        $directors_list = Director::all();
        $genres_list = Genre::all();

        $movies = collect();
        $directors = collect();

        // Dati dalla ricerca testuale
        $search = $request->query('query_search');

        $hasSearch = $search || $request->has("genres") || $request->has("directors");

        if ($hasSearch) {

            // Avvia la query per i film
            $moviesQuery = Movie::query();

            // Filtro per titolo o trama (search bar)
            if ($search) {
                $moviesQuery->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%$search%")
                        ->orWhere('story', 'like', "%$search%");
                });
            }

            // Filtro per generi (checkbox o select multipla)
            if ($request->has('genres')) {
                $genreIds = $request->input('genres');
                $moviesQuery->whereHas('genres', function ($query) use ($genreIds) {
                    $query->whereIn('genres.id', $genreIds);
                });
            }

            // Filtro per registi (checkbox o select multipla)
            if ($request->has('directors')) {
                $directorIds = $request->input('directors');
                $moviesQuery->whereIn('director_id', $directorIds);
            }

            // Ottieni i risultati
            $movies = $moviesQuery->get();

            if ($search) {
                //  Anche la lista di registi (per mostrarli eventualmente)
                $directors = Director::where(function ($query) use ($search) {
                    $query->where('name', 'like', "%$search%")
                        ->orWhere('surname', 'like', "%$search%");
                })->get();
            } 
            return view('search.index', compact('movies', 'directors', 'genres_list', 'directors_list'));
        }
        return view('search.index', compact("directors_list", "genres_list", "movies", "directors"));
    }
}
