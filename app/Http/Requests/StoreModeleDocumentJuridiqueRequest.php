<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreModeleDocumentJuridiqueRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nom' => 'required|string|max:255',
            'type_document' => 'required|string',

            'contenu' => 'nullable|string',

            'actif' => 'nullable|boolean',
            'version' => 'nullable|string|max:50',
        ];
    }
}
