<?php

namespace App\Http\Requests\Innovation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PropositionAmeliorationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titre' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],

            'origine' => ['required', Rule::in(['interne', 'citoyen', 'partenaire', 'institution'])],

            'auteur_id' => ['nullable', 'exists:users,id'],
            'porteur_nom' => ['nullable', 'string'],
            'porteur_email' => ['nullable', 'email'],

            'institution_source' => ['nullable', 'string'],
            'service_concerne' => ['nullable', 'string'],

            'probleme_identifie' => ['nullable', 'string'],
            'solution_proposee' => ['nullable', 'string'],
            'impact_attendu' => ['nullable', 'string'],

            'cout_estime' => ['nullable', 'numeric', 'min:0'],

            'faisabilite' => ['nullable', Rule::in(['faible', 'moyenne', 'haute'])],
            'niveau_priorite' => ['nullable', Rule::in(['faible', 'moyenne', 'haute', 'critique'])],

            'statut' => ['required', Rule::in(['soumis', 'en_etude', 'retenu', 'rejete', 'transforme'])],

            'date_soumission' => ['nullable', 'date'],
            'date_decision' => ['nullable', 'date', 'after_or_equal:date_soumission'],

            'decideur_id' => ['nullable', 'exists:users,id'],
        ];
    }
}
