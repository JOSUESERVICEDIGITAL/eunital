<?php

namespace App\Http\Requests\Innovation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IdeeInnovationRequest extends FormRequest
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

            'categorie' => ['nullable', 'string'],

            'origine' => ['required', Rule::in(['interne', 'citoyen', 'partenaire', 'institution'])],

            'auteur_id' => ['nullable', 'exists:users,id'],
            'anonyme' => ['boolean'],

            'niveau_maturite' => ['required', Rule::in(['idee', 'concept', 'prototype', 'pret'])],

            'impact_potentiel' => ['required', Rule::in(['faible', 'moyen', 'fort', 'majeur'])],
            'faisabilite' => ['required', Rule::in(['faible', 'moyenne', 'haute'])],

            'statut' => ['required', Rule::in(['soumise', 'en_etude', 'retenue', 'rejetee', 'transformee'])],
        ];
    }
}
