<?php

namespace App\Http\Requests\RH;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CandidatureRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'nom' => $this->filled('nom') ? trim((string) $this->input('nom')) : null,
            'prenom' => $this->filled('prenom') ? trim((string) $this->input('prenom')) : null,
            'email' => $this->filled('email') ? strtolower(trim((string) $this->input('email'))) : null,
            'telephone' => $this->filled('telephone') ? trim((string) $this->input('telephone')) : null,
            'observation' => $this->filled('observation') ? trim((string) $this->input('observation')) : null,
        ]);
    }

    public function rules(): array
    {
        return [
            'recrutement_id' => ['required', 'exists:recrutements,id'],

            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'telephone' => ['nullable', 'string', 'max:255'],

            'cv' => ['nullable', 'string', 'max:255'],
            'lettre_motivation' => ['nullable', 'string', 'max:255'],

            'statut' => ['nullable', Rule::in(['recu', 'en_etude', 'entretien', 'retenu', 'rejete'])],
            'date_candidature' => ['nullable', 'date'],
            'observation' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'recrutement_id.required' => 'Le recrutement est obligatoire.',
            'recrutement_id.exists' => 'Le recrutement sélectionné est invalide.',
            'nom.required' => 'Le nom du candidat est obligatoire.',
            'email.email' => 'L’adresse email est invalide.',
            'statut.in' => 'Le statut de la candidature est invalide.',
        ];
    }
}