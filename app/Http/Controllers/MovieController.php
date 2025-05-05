<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies = Movie::all();
        return view("movies.index", compact("movies"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("movies.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        
        $newMovie = new Movie();

        $newMovie->title = $data["title"];
        $newMovie->story = $data["story"];
        $newMovie->year_of_publication = $data["year_of_publication"];
        $newMovie->duration = $data["duration"];
        
        $newMovie->save();

        return redirect()->route("movies.show", $newMovie->id);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $movie = Movie::findOrFail($id);
        return view("movies.show", compact("movie"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $movie = Movie::findOrFail($id);
        return view("movies.edit", compact("movie"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $movie = Movie::findOrFail($id);

        $movie->title = $data["title"];
        $movie->story = $data["story"];
        $movie->year_of_publication = $data["year_of_publication"];
        $movie->duration = $data["duration"];

        $movie->save();

        return redirect()->route("movies.show", $movie->id);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();

        return redirect()->route("movies.index");
    }
}
