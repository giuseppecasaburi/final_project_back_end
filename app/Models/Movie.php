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

    // Definizione relazione 1:N con la tabella Directors attraverso il model
    public function director() {
        return $this->belongsTo(Director::class);
    }

    // Definizione relazione N:N con la tabella Genre attraverso il model
    public function genres() {
        return $this->belongsToMany(Genre::class);
    }
}