<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGenreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'color' => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Il campo "Genere" è obbligatorio.',
            'name.string' => 'Il genere deve essere una stringa valida.',
            'name.max' => 'Il nome del genere non può superare i 255 caratteri.',

            'color.required' => 'Il campo "Colore HEX" è obbligatorio.',
            'color.regex' => 'Inserisci un codice HEX valido, ad esempio "#ff8800".',
        ];
    }
}
