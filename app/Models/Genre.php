<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    // Definizione relazione N:N con la tabella Movies attraverso il model
    public function movies() {
        return $this->belongsToMany(Movie::class);
    }
}
