<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDemandeClientGraphismeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titre' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'type' => ['required', 'in:logo,affiche,reseaux,uiux,branding'],
            'priorite' => ['required', 'in:faible,normale,urgente'],
            'statut' => ['required', 'in:en_attente,en_cours,termine'],
            'client_studio_id' => ['nullable', 'exists:client_studios,id'],
        ];
    }
}
