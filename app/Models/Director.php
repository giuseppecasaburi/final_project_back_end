<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Movie;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Director extends Model
{

    // Abilitazione softDelete()
    use SoftDeletes;

    // Metodo booted per eseguire il forceDeleted() anche sulla relazione
    protected static function booted() {
        
        // In caso di forceDeleted
        static::forceDeleted(function ($director) {
            // Eliminazione dei film collegati
            if($director->isForceDeleting()) {
                // Elimina definitivamente anche i film collegati
                $director->movies()->forceDelete();
            } else {
                // Soft-delete
                $director->movies()->delete();
            }

            // Eliminazione dell'immagine collegata
            // Se l'immagine esiste
            if($director->image && Storage::disk("public")->exists($director->image)) {
                Storage::disk("public")->delete($director->image);
            }
        });

    }

    // Definizione relazione 1:N con la tabella Movies attraverso il model
    public function movies() {
        return $this->hasMany(Movie::class);
    }
}
