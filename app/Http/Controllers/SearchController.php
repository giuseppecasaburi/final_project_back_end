<?php

namespace App\Http\Controllers;

use App\Models\Director;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index (Request $request) {

        $directors_list = Director::all();

        $genres = Genre::all();

        $search = $request->query("query_search");

        $movies = Movie::where("title", "like", "%$search%")
            ->orWhere("story", "like", "%$search%")
            ->get();

        $directors = Director::where("name", "like", "%$search%")
            ->orWhere("surname", "like", "%$search%")
            ->get();

        return view("search.index", compact("movies", "directors", "genres", "directors_list"));
    }
}