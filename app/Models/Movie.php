<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Director;
use App\Models\Genre;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Movie extends Model
{

    use SoftDeletes;

    protected static function booted() {

        // Metodo eseguito al forceDeleted di un'istanza di Movie
        static::forceDeleted(function (Movie $movie){
            // Controllo se l'immagine esiste
            if($movie->image && Storage::disk("public")->exists($movie->image)) {
                Storage::disk("public")->delete($movie->image);
            }

            // Elimina i collegamenti con i generi
            $movie->genres()->detach();
        });
    }

    // Definizione relazione 1:N con la tabella Directors attraverso il model
    public function director() {
        return $this->belongsTo(Director::class);
    }

    // Definizione relazione N:N con la tabella Genre attraverso il model
    public function genres() {
        return $this->belongsToMany(Genre::class);
    }
}
