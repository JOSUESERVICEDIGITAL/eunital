<?php

namespace App\Http\Requests\Innovation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InnovationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('id');

        return [
            'innovation_portefeuille_id' => ['required', 'exists:innovation_portefeuilles,id'],

            'code' => ['nullable', Rule::unique('innovations', 'code')->ignore($id)],
            'slug' => ['nullable', Rule::unique('innovations', 'slug')->ignore($id)],

            'titre' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],

            'type_innovation' => ['required', Rule::in(['digitale', 'organisationnelle', 'sociale', 'territoriale', 'technique'])],
            'niveau_maturite' => ['required', Rule::in(['idee', 'etude', 'prototype', 'pilote', 'deploiement', 'industrialisee'])],

            'portee_geographique' => ['required', Rule::in(['locale', 'communale', 'provinciale', 'regionale', 'nationale'])],

            'responsable_id' => ['required', 'exists:users,id'],
            'sponsor_id' => ['nullable', 'exists:users,id'],

            'date_lancement' => ['required', 'date'],
            'date_fin_previsionnelle' => ['nullable', 'date', 'after_or_equal:date_lancement'],
            'date_fin_reelle' => ['nullable', 'date', 'after_or_equal:date_lancement'],

            'budget_previsionnel' => ['nullable', 'numeric', 'min:0'],
            'budget_consomme' => ['nullable', 'numeric', 'min:0'],

            'statut' => ['required', Rule::in(['brouillon', 'en_cours', 'suspendue', 'terminee', 'archivee'])],
            'niveau_priorite' => ['required', Rule::in(['faible', 'moyenne', 'haute', 'critique'])],
        ];
    }
}
