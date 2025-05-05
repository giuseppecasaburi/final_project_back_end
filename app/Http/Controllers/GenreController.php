<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genres = Genre::all();
        return view("genres.index", compact("genres"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("genres.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $newGenre = new Genre();

        $newGenre->name = $data["name"];
        $newGenre->color = $data["color"];

        $newGenre->save();

        return redirect()->route("genre.show", $newGenre->id);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $genre = Genre::findOrFail($id);

        return view("genres.show", compact("genre"));
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
    public function update(Request $request, string $id)
    {
        $data = $request->all();
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
        $genre->delete();

        return redirect()->route("genre.index");
    }
}
