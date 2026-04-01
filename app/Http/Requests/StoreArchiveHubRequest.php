<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArchiveHubRequest extends FormRequest
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

            'fichier' => 'required|file|max:10000',

            'date_archive' => 'nullable|date',
            'description' => 'nullable|string',

            'visible' => 'nullable|boolean',
        ];
    }
}
