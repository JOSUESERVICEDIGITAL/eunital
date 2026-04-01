<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDossierJuridiqueRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titre' => 'required|string|max:255',
            'type_dossier' => 'required|string',

            'description' => 'nullable|string',

            'priorite' => 'nullable|string',

            'responsable_id' => 'nullable|exists:users,id',
            'client_studio_id' => 'nullable|exists:client_studios,id',
        ];
    }
}
