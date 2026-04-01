<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnregistrerIdeeIngenieurieRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'auteur_id' => ['nullable', 'exists:users,id'],
            'responsable_id' => ['nullable', 'exists:users,id'],
            'titre' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'probleme_identifie' => ['nullable', 'string', 'max:15000'],
            'solution_proposee' => ['nullable', 'string', 'max:15000'],
            'niveau_priorite' => ['required', 'in:faible,moyenne,haute,critique'],
            'statut' => ['required', 'in:nouvelle,en_etude,retenue,rejetee,realisee'],
        ];
    }

    public function messages(): array
    {
        return [
            'auteur_id.exists' => 'L’auteur sélectionné est invalide.',
            'responsable_id.exists' => 'Le responsable sélectionné est invalide.',
            'titre.required' => 'Le titre de l’idée est obligatoire.',
            'niveau_priorite.required' => 'Le niveau de priorité est obligatoire.',
            'niveau_priorite.in' => 'Le niveau de priorité sélectionné est invalide.',
            'statut.required' => 'Le statut de l’idée est obligatoire.',
            'statut.in' => 'Le statut sélectionné est invalide.',
        ];
    }
}