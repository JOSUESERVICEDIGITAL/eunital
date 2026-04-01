<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAfficheFlyerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titre' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'type' => ['required', 'in:affiche,flyer'],
            'fichier' => ['nullable', 'string', 'max:255'],
            'statut' => ['required', 'in:creation,validation,livre'],
            'client_studio_id' => ['nullable', 'exists:client_studios,id'],
        ];
    }
}
