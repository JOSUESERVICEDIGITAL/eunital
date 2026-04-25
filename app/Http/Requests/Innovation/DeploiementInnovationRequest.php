<?php

namespace App\Http\Requests\Innovation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DeploiementInnovationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'innovation_id' => ['required', 'exists:innovations,id'],

            'titre' => ['required', 'string'],
            'description' => ['nullable', 'string'],

            'mode_deploiement' => ['nullable', 'string'],

            'date_debut' => ['nullable', 'date'],
            'date_fin_previsionnelle' => ['nullable', 'date', 'after_or_equal:date_debut'],
            'date_fin_reelle' => ['nullable', 'date', 'after_or_equal:date_debut'],

            'statut' => ['required', Rule::in(['planifie', 'en_cours', 'termine', 'suspendu'])],
        ];
    }
}
