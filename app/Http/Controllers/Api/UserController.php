<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Director;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function indexMovies()
    {
        // Preleva tutti i film con annessi tutti i generi collegati e il regista
        $movies = Movie::with(["director", "genres"])->paginate(9);

        return response()->json([
            "success" => true,
            "data" => $movies
        ]);
    }

    public function showMovie($id)
    {
        // Preleva un singolo film con tutti i generi annessi e il regista
        $movie = Movie::with(["director", "genres"])->FindOrFail($id);

        return response()->json([
            "success" => true,
            "data" => $movie
        ]);
    }

    public function indexDirectors()
    {
        // Preleva tutti registi
        $directors = Director::paginate(9);

        return response()->json([
            "success" => true,
            "data" => $directors
        ]);
    }

    public function showDirector($id)
    {
        // Preleva un singolo film con tutti i generi annessi e il regista
        $director = Director::with(["movies.genres"])->findOrFail($id);

        return response()->json([
            "success" => true,
            "data" => $director
        ]);
    }

        public function selectDirectors()
    {
        // Preleva tutti i registi
        $directors = Director::all();

        return response()->json([
            "success" => true,
            "data" => $directors
        ]);
    }

    public function indexGenres() {
        // Preleva tutti i generi
        $genres = Genre::all();

        return response()->json([
            "success" => true,
            "data" => $genres
        ]);
    }
}