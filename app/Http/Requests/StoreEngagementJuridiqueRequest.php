<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEngagementJuridiqueRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nom_complet' => 'required|string|max:255',
            'email' => 'nullable|email',
            'telephone' => 'nullable|string|max:50',

            'type_engagement' => 'required|string',
            'service_concerne' => 'nullable|string|max:255',
            'chambre_source' => 'nullable|string|max:255',

            'description' => 'nullable|string',

            'user_id' => 'nullable|exists:users,id',
            'client_studio_id' => 'nullable|exists:client_studios,id',

            'fichier_formulaire' => 'nullable|file|max:2048',
            'fichier_contrat' => 'nullable|file|max:2048',
        ];
    }
}
