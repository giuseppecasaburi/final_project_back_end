<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGenreRequest;
use App\Http\Requests\UpdateGenreRequest;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genres = Genre::paginate(9);
        return view("genres.index", compact("genres"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view("genres.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGenreRequest $request)
    {
        $data = $request->validated();
        $newGenre = new Genre();

        $newGenre->name = $data["name"];
        $newGenre->color = $data["color"];

        $newGenre->save();

        if($request->has("from") && $request->input("from") === "movies.create") {
            // Torna alla create di movies con il genere già selezionato
            return redirect()->route("movies.create")->with("new_genre_id", $newGenre->id);
        }

        return redirect()->route("genre.show", $newGenre->id);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $genre = Genre::findOrFail($id);

        $relatedMovies = $genre->movies()->limit(3)->get();

        return view("genres.show", compact("genre", "relatedMovies"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $genre = Genre::findOrFail($id);
        return view("genres.edit", compact("genre"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGenreRequest $request, string $id)
    {
        $data = $request->validated();
        $genre = Genre::findOrFail($id);

        $genre->name = $data["name"];
        $genre->color = $data["color"];

        $genre->save();

        return redirect()->route("genre.show", $genre->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $genre = Genre::findOrFail($id);
        
        $genre->movies()->detach();

        $genre->delete();

        return redirect()->route("genre.index");
    }
}
