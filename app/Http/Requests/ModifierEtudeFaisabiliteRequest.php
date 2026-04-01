<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModifierEtudeFaisabiliteRequest extends FormRequest
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
            'description' => ['nullable', 'string', 'max:8000'],
            'faisabilite_technique' => ['nullable', 'string', 'max:15000'],
            'faisabilite_financiere' => ['nullable', 'string', 'max:15000'],
            'faisabilite_humaine' => ['nullable', 'string', 'max:15000'],
            'risques' => ['nullable', 'string', 'max:15000'],
            'recommandation_finale' => ['nullable', 'string', 'max:15000'],
            'decision' => ['required', 'in:favorable,reservee,defavorable'],
        ];
    }

    public function messages(): array
    {
        return [
            'auteur_id.exists' => 'L’auteur sélectionné est invalide.',
            'titre.required' => 'Le titre de l’étude de faisabilité est obligatoire.',
            'decision.required' => 'La décision finale est obligatoire.',
            'decision.in' => 'La décision sélectionnée est invalide.',
        ];
    }
}