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

    // Definizione relazione 1:N con la tabella Movies attraverso il model
    public function movies() {
        return $this->hasMany(Movie::class);
    }
}
