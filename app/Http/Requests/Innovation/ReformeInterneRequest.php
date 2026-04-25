<?php

namespace App\Http\Requests\Innovation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ReformeInterneRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => ['nullable', 'unique:reformes_internes,code'],
            'titre' => ['required', 'string'],

            'description' => ['nullable', 'string'],
            'domaine' => ['nullable', 'string'],
            'objectif' => ['nullable', 'string'],

            'responsable_id' => ['nullable', 'exists:users,id'],

            'statut' => ['required', Rule::in(['brouillon', 'planifiee', 'en_cours', 'suspendue', 'terminee', 'archivee'])],

            'date_debut' => ['nullable', 'date'],
            'date_fin_previsionnelle' => ['nullable', 'date', 'after_or_equal:date_debut'],
            'date_fin_reelle' => ['nullable', 'date', 'after_or_equal:date_debut'],

            'niveau_priorite' => ['required', Rule::in(['faible', 'moyenne', 'haute', 'critique'])],
        ];
    }
}
