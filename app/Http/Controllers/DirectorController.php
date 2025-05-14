<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDirectorRequest;
use App\Http\Requests\UpdateDirectorRequest;
use App\Models\Director;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DirectorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $directors = Director::paginate(9);

        return view("directors.index", compact("directors"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view("directors.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDirectorRequest $request)
    {
        $data = $request->validated();

        $newDirector = new Director();

        $newDirector->name = $data["name"];
        $newDirector->surname = $data["surname"];
        $newDirector->date_of_birth = $data["date_of_birth"];
        $newDirector->nationality = $data["nationality"];
        $newDirector->description = $data["description"];

        if (array_key_exists("image", $data)) {
            $image_path = Storage::putFile("directors_image", $data["image"]);
            $newDirector->image = $image_path;
        }

        $newDirector->save();

        if ($request->has("from") && $request->input("from") === "movies.create") {
            // Torna alla create dei film con il regista preinserito
            return redirect()
                ->route("movies.create")
                ->with("new_director_id", $newDirector->id);
        }

        return redirect()->route("directors.show", $newDirector->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $director = Director::findOrFail($id);
        // Recupero massimo 3 film di questo regista
        $relatedMovies = Movie::where('director_id', $director->id)
            ->limit(3)
            ->get();
        return view("directors.show", compact("director", "relatedMovies"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $director = Director::findOrFail($id);
        return view("directors.edit", compact("director"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDirectorRequest $request, string $id)
    {
        $data = $request->validated();
        $director = Director::findOrFail($id);

        $director->name = $data["name"];
        $director->surname = $data["surname"];
        $director->date_of_birth = $data["date_of_birth"];
        $director->nationality = $data["nationality"];
        $director->description = $data["description"];

        if (array_key_exists("remove_image", $data) && $data["remove_image"] != 0) {
            Storage::disk("public")->delete($director->image);
            $director->image = null;
        }

        if (array_key_exists("image", $data)) {

            // Eliminazione vecchia immagine
            if ($director->image != null && Storage::disk("public")->exists($director->image)) {
                Storage::disk("public")->delete($director->image);
            }

            // Aggiunta nuova immagine
            $image_path = Storage::putFile("directors_image", $data["image"]);

            // Aggiornamento DB
            $director->image = $image_path;
        }

        $director->save();

        return redirect()->route("directors.show", $director->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $director = Director::findOrFail($id);

        $director->delete();

        return redirect()->route("directors.index");
    }
}
