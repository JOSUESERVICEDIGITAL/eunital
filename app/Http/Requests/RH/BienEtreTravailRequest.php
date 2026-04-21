<?php

namespace App\Http\Requests\RH;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BienEtreTravailRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'titre' => $this->filled('titre') ? trim((string) $this->input('titre')) : null,
            'description' => $this->filled('description') ? trim((string) $this->input('description')) : null,
        ]);
    }

    public function rules(): array
    {
        return [
            'membre_equipe_id' => ['nullable', 'exists:membres_equipe,id'],
            'auteur_id' => ['nullable', 'exists:users,id'],

            'type' => ['required', Rule::in(['signalement', 'accompagnement', 'incident', 'suggestion', 'suivi'])],
            'titre' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],

            'niveau_priorite' => ['nullable', Rule::in(['faible', 'moyenne', 'haute', 'urgente'])],
            'statut' => ['nullable', Rule::in(['ouvert', 'en_cours', 'traite', 'archive'])],
        ];
    }

    public function messages(): array
    {
        return [
            'membre_equipe_id.exists' => 'Le membre sélectionné est invalide.',
            'auteur_id.exists' => 'L’auteur sélectionné est invalide.',
            'type.required' => 'Le type est obligatoire.',
            'type.in' => 'Le type est invalide.',
            'titre.required' => 'Le titre est obligatoire.',
            'niveau_priorite.in' => 'Le niveau de priorité est invalide.',
            'statut.in' => 'Le statut est invalide.',
        ];
    }
}