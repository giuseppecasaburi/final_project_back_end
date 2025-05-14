<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Models\Director;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies = Movie::paginate(9);
        return view("movies.index", compact("movies"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genres = Genre::all();
        $directors = Director::all();
        return view("movies.create", compact("genres", "directors"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMovieRequest $request)
    {
        $data = $request->validated();

        $newMovie = new Movie();
        $genres = $data["genres"];

        $newMovie->title = $data["title"];
        $newMovie->story = $data["story"];
        $newMovie->year_of_publication = $data["year_of_publication"];
        $newMovie->duration = $data["duration"];
        $newMovie->review = $data["review"];
        $newMovie->vote = $data["vote"];

        if ($data["director_id"]) {
            $newMovie->director_id = $data["director_id"];
        }

        if (array_key_exists("image", $data)) {
            // Crea un nome univoco, la cartella "locandine se non la trova", salva il file e ritorna il path;
            $img_path = Storage::putFile("locandine", $data["image"]);

            $newMovie->image = $img_path;
        }

        $newMovie->save();

        if (array_key_exists("genres", $data)) {
            $newMovie->genres()->attach($genres);
        }

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
        $genres = Genre::all();
        $directors = Director::all();
        return view("movies.edit", compact("movie", "genres", "directors"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMovieRequest $request, string $id)
    {
        $data = $request->validated();
        $movie = Movie::findOrFail($id);

        $movie->title = $data["title"];
        $movie->story = $data["story"];
        $movie->year_of_publication = $data["year_of_publication"];
        $movie->duration = $data["duration"];
        $movie->director_id = $data["director_id"];
        $movie->review = $data["review"];
        $movie->vote = $data["vote"];

        if (array_key_exists("remove_image", $data) && $data["remove_image"] != 0) {
            Storage::disk("public")->delete($movie->image);
            $movie->image = null;
        }

        if (array_key_exists("image", $data)) {
            // Elimina vecchia
            if ($movie->image && Storage::disk("public")->exists($movie->image)) {
                Storage::disk("public")->delete($movie->image);
            }

            // Aggiungi nuova
            $img_path = Storage::putFile("locandine", $data["image"]);

            // Aggiorna db
            $movie->image = $img_path;
        }

        $movie->save();

        $movie->genres()->sync($data["genres"]);

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
