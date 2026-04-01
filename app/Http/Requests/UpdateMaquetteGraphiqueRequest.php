<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMaquetteGraphiqueRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titre' => ['required', 'string', 'max:255'],
            'support' => ['nullable', 'string', 'max:255'],
            'fichier' => ['nullable', 'string', 'max:255'],
            'statut' => ['required', 'in:creation,validation,livre'],
        ];
    }
}
