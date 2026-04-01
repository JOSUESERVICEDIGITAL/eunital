<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDocumentJuridiqueRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titre' => 'required|string|max:255',
            'categorie' => 'required|string',

            'contenu' => 'nullable|string',
            'fichier' => 'nullable|file|max:4096',

            'statut' => 'nullable|string',
        ];
    }
}
