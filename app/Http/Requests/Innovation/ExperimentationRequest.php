<?php

namespace App\Http\Requests\Innovation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ExperimentationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'innovation_id' => ['nullable', 'exists:innovations,id'],

            'titre' => ['required', 'string'],
            'description' => ['nullable', 'string'],

            'hypothese' => ['nullable', 'string'],
            'protocole' => ['nullable', 'string'],

            'responsable_id' => ['nullable', 'exists:users,id'],

            'date_debut' => ['nullable', 'date'],
            'date_fin' => ['nullable', 'date', 'after_or_equal:date_debut'],

            'statut' => ['required', Rule::in(['planifiee', 'en_cours', 'terminee', 'suspendue', 'abandonnee'])],
        ];
    }
}
