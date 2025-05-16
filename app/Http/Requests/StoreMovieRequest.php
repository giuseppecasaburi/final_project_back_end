<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMovieRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|min:5|unique:movies,title',
            'story' => 'required|string|min:10',
            'director_id' => 'nullable|exists:directors,id',
            'duration' => 'required|integer|min:1',
            'year_of_publication' => 'required|date',
            'genres' => 'required|array|min:1',
            'genres.*' => 'exists:genres,id',
            'review' => 'nullable|string|min:10',
            'vote' => 'nullable|numeric|min:1|max:10',
            'image' => 'nullable|image|max:2048',
            'remove_image' => "string"
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Il titolo è obbligatorio.',
            'title.min' => 'Il titolo deve contenere almeno :min caratteri.',
            'title.unique' => 'Questo Film è già presente nel Database.',
            'story.required' => 'La trama è obbligatoria.',
            'story.min' => 'La trama deve contenere almeno :min caratteri.',
            'director_id.exists' => 'Il regista selezionato non è valido.',
            'duration.required' => 'La durata è obbligatoria.',
            'duration.integer' => 'La durata deve essere un numero intero.',
            'duration.min' => 'La durata deve essere di almeno :min minuti.',
            'year_of_publication.required' => 'L\'anno di pubblicazione è obbligatorio.',
            'year_of_publication.date' => 'L\'anno di pubblicazione deve essere una data valida.',
            'genres.required' => 'È necessario selezionare almeno un genere.',
            'genres.array' => 'Il formato dei generi non è valido.',
            'genres.min' => 'È necessario selezionare almeno un genere.',
            'genres.*.exists' => 'Uno dei generi selezionati non è valido.',
            'review.required' => 'La recensione è obbligatoria.',
            'review.min' => 'La recensione deve contenere almeno :min caratteri.',
            'vote.required' => 'Il voto è obbligatorio.',
            'vote.numeric' => 'Il voto deve essere un numero.',
            'vote.min' => 'Il voto deve essere almeno :min.',
            'vote.max' => 'Il voto non può essere superiore a :max.',
            'image.image' => 'Il file selezionato deve essere un\'immagine.',
            'image.max' => 'L\'immagine non può superare i :max kilobyte.',
        ];
    }
}
