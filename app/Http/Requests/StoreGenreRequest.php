<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGenreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:genres,name'],
            'color' => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Il campo "Genere" è obbligatorio.',
            'name.string' => 'Il genere deve essere una stringa valida.',
            'name.max' => 'Il nome del genere non può superare i 255 caratteri.',
            'name.unique' => 'Questo genere è già presente nel database.',

            'color.required' => 'Il campo "Colore HEX" è obbligatorio.',
            'color.regex' => 'Inserisci un codice HEX valido, ad esempio "#ff8800".',
        ];
    }
}
