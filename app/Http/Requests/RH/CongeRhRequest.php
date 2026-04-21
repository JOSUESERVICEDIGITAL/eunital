<?php

namespace App\Http\Requests\RH;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CongeRhRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'motif' => $this->filled('motif') ? trim((string) $this->input('motif')) : null,
        ]);
    }

    public function rules(): array
    {
        return [
            'membre_equipe_id' => ['required', 'exists:membres_equipe,id'],
            'type_conge' => ['required', Rule::in(['annuel', 'maladie', 'maternite', 'paternite', 'exceptionnel', 'sans_solde'])],

            'date_debut' => ['required', 'date'],
            'date_fin' => ['required', 'date', 'after_or_equal:date_debut'],
            'nombre_jours' => ['nullable', 'integer', 'min:1'],

            'motif' => ['nullable', 'string'],
            'statut' => ['nullable', Rule::in(['en_attente', 'valide', 'refuse', 'annule'])],
            'valide_par' => ['nullable', 'exists:users,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'membre_equipe_id.required' => 'Le membre de l’équipe est obligatoire.',
            'membre_equipe_id.exists' => 'Le membre sélectionné est invalide.',
            'type_conge.required' => 'Le type de congé est obligatoire.',
            'type_conge.in' => 'Le type de congé est invalide.',
            'date_debut.required' => 'La date de début est obligatoire.',
            'date_fin.required' => 'La date de fin est obligatoire.',
            'date_fin.after_or_equal' => 'La date de fin doit être après ou égale à la date de début.',
            'nombre_jours.integer' => 'Le nombre de jours doit être un entier.',
            'nombre_jours.min' => 'Le nombre de jours doit être au moins de 1.',
            'statut.in' => 'Le statut du congé est invalide.',
            'valide_par.exists' => 'Le validateur sélectionné est invalide.',
        ];
    }
}