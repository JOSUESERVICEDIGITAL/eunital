<?php

namespace App\Http\Requests\RH;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EvaluationRhRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'titre' => $this->filled('titre') ? trim((string) $this->input('titre')) : null,
            'points_forts' => $this->filled('points_forts') ? trim((string) $this->input('points_forts')) : null,
            'points_a_ameliorer' => $this->filled('points_a_ameliorer') ? trim((string) $this->input('points_a_ameliorer')) : null,
            'recommandations' => $this->filled('recommandations') ? trim((string) $this->input('recommandations')) : null,
        ]);
    }

    public function rules(): array
    {
        return [
            'membre_equipe_id' => ['required', 'exists:membres_equipe,id'],
            'evaluateur_id' => ['nullable', 'exists:users,id'],

            'titre' => ['required', 'string', 'max:255'],
            'date_evaluation' => ['nullable', 'date'],
            'note_globale' => ['nullable', 'integer', 'min:0', 'max:10'],

            'points_forts' => ['nullable', 'string'],
            'points_a_ameliorer' => ['nullable', 'string'],
            'recommandations' => ['nullable', 'string'],

            'statut' => ['nullable', Rule::in(['brouillon', 'validee', 'archivee'])],
        ];
    }

    public function messages(): array
    {
        return [
            'membre_equipe_id.required' => 'Le membre de l’équipe est obligatoire.',
            'membre_equipe_id.exists' => 'Le membre sélectionné est invalide.',
            'evaluateur_id.exists' => 'L’évaluateur sélectionné est invalide.',
            'titre.required' => 'Le titre de l’évaluation est obligatoire.',
            'note_globale.integer' => 'La note globale doit être un nombre entier.',
            'note_globale.min' => 'La note globale ne peut pas être inférieure à 0.',
            'note_globale.max' => 'La note globale ne peut pas dépasser 10.',
            'statut.in' => 'Le statut de l’évaluation est invalide.',
        ];
    }
}