<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDossierJuridiqueRequest extends FormRequest
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

            'statut' => 'nullable|string',
            'priorite' => 'nullable|string',
        ];
    }
}
