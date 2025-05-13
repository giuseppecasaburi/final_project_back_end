<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDirectorRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:50'],
            'surname' => ['required', 'string', 'min:3', 'max:50'],
            'date_of_birth' => ['required', 'date', 'before:today'],
            'nationality' => ['required', 'string', 'min:2', 'max:50'],
            'description' => ['required', 'string', 'min:10', 'max:1000'],
            'image' => ['nullable', 'image', 'max:2048'], // max 2MB
            'remove_image' => "string"
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Il nome è obbligatorio.',
            'name.min' => 'Il nome deve contenere almeno :min caratteri.',
            'name.max' => 'Il nome non può superare i :max caratteri.',

            'surname.required' => 'Il cognome è obbligatorio.',
            'surname.min' => 'Il cognome deve contenere almeno :min caratteri.',
            'surname.max' => 'Il cognome non può superare i :max caratteri.',

            'date_of_birth.required' => 'La data di nascita è obbligatoria.',
            'date_of_birth.date' => 'Inserisci una data valida.',
            'date_of_birth.before' => 'La data di nascita deve essere nel passato.',

            'nationality.required' => 'La nazionalità è obbligatoria.',
            'nationality.min' => 'La nazionalità deve contenere almeno :min caratteri.',
            'nationality.max' => 'La nazionalità non può superare i :max caratteri.',

            'description.required' => 'La descrizione è obbligatoria.',
            'description.min' => 'La descrizione deve contenere almeno :min caratteri.',
            'description.max' => 'La descrizione non può superare i :max caratteri.',

            'image.image' => 'Il file deve essere un\'immagine valida (jpg, png, ecc).',
            'image.max' => 'L\'immagine non può superare i 2MB di dimensione.',
        ];
    }
}
