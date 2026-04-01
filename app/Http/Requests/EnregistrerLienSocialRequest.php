<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnregistrerLienSocialRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nom' => ['required', 'string', 'max:255', 'unique:liens_sociaux,nom'],
            'icone' => ['nullable', 'string', 'max:255'],
            'url' => ['required', 'url', 'max:2000'],
            'emplacement' => ['required', 'in:header,footer,partout'],
            'ordre_affichage' => ['nullable', 'integer', 'min:0'],
            'est_actif' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom du lien social est obligatoire.',
            'nom.unique' => 'Ce lien social existe déjà.',
            'url.required' => 'L’URL est obligatoire.',
            'url.url' => 'L’URL fournie est invalide.',
            'emplacement.required' => 'L’emplacement est obligatoire.',
            'emplacement.in' => 'L’emplacement sélectionné est invalide.',
        ];
    }
}