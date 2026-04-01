<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnregistrerReflexionStrategiqueRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'auteur_id' => ['nullable', 'exists:users,id'],
            'titre' => ['required', 'string', 'max:255'],
            'contexte' => ['nullable', 'string', 'max:15000'],
            'analyse' => ['nullable', 'string', 'max:20000'],
            'orientation_recommandee' => ['nullable', 'string', 'max:15000'],
            'impact_attendu' => ['nullable', 'string', 'max:15000'],
            'statut' => ['required', 'in:ouverte,validee,archivee'],
        ];
    }

    public function messages(): array
    {
        return [
            'auteur_id.exists' => 'L’auteur sélectionné est invalide.',
            'titre.required' => 'Le titre de la réflexion stratégique est obligatoire.',
            'statut.required' => 'Le statut est obligatoire.',
            'statut.in' => 'Le statut sélectionné est invalide.',
        ];
    }
}