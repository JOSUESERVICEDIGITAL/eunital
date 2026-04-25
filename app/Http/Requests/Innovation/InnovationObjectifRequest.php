<?php

namespace App\Http\Requests\Innovation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InnovationObjectifRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'innovation_id' => ['required', 'exists:innovations,id'],
            'titre' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'valeur_cible' => ['nullable', 'string', 'max:255'],
            'valeur_actuelle' => ['nullable', 'string', 'max:255'],
            'statut' => ['required', Rule::in(['non_demarre', 'en_cours', 'atteint', 'non_atteint'])],
        ];
    }
}
