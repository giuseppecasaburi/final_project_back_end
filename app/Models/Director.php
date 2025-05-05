<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Movie;

class Director extends Model
{
    // Definizione relazione 1:N con la tabella Movies attraverso il model
    public function movie() {
        return $this->hasMany(Movie::class);
    }
}
