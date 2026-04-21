<?php

namespace App\Http\Requests\RH;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SanctionDisciplinaireRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'motif' => $this->filled('motif') ? trim((string) $this->input('motif')) : null,
            'description' => $this->filled('description') ? trim((string) $this->input('description')) : null,
        ]);
    }

    public function rules(): array
    {
        return [
            'membre_equipe_id' => ['required', 'exists:membres_equipe,id'],
            'auteur_id' => ['nullable', 'exists:users,id'],

            'motif' => ['required', 'string', 'max:255'],
            'type_sanction' => ['required', Rule::in(['avertissement', 'blame', 'mise_a_pied', 'autre'])],
            'date_sanction' => ['nullable', 'date'],
            'description' => ['nullable', 'string'],
            'statut' => ['nullable', Rule::in(['active', 'levee', 'archivee'])],
        ];
    }

    public function messages(): array
    {
        return [
            'membre_equipe_id.required' => 'Le membre de l’équipe est obligatoire.',
            'membre_equipe_id.exists' => 'Le membre sélectionné est invalide.',
            'auteur_id.exists' => 'L’auteur sélectionné est invalide.',
            'motif.required' => 'Le motif de la sanction est obligatoire.',
            'type_sanction.required' => 'Le type de sanction est obligatoire.',
            'type_sanction.in' => 'Le type de sanction est invalide.',
            'statut.in' => 'Le statut de la sanction est invalide.',
        ];
    }
}