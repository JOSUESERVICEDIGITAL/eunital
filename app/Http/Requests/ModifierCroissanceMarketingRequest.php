<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModifierCroissanceMarketingRequest extends FormRequest
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
            'objectif' => ['nullable', 'string', 'max:255'],
            'levier' => ['nullable', 'string', 'max:255'],
            'action_prevue' => ['nullable', 'string', 'max:10000'],
            'metrique_cible' => ['nullable', 'string', 'max:255'],
            'priorite' => ['required', 'in:faible,moyenne,haute,critique'],
            'statut' => ['required', 'in:planifiee,en_cours,test,validee,abandonnee,archivee'],
            'date_debut' => ['nullable', 'date'],
            'date_fin' => ['nullable', 'date', 'after_or_equal:date_debut'],
        ];
    }

    public function messages(): array
    {
        return [
            'auteur_id.exists' => 'L’auteur sélectionné est invalide.',
            'responsable_id.exists' => 'Le responsable sélectionné est invalide.',
            'titre.required' => 'Le titre de l’action de croissance est obligatoire.',
            'priorite.required' => 'La priorité est obligatoire.',
            'priorite.in' => 'La priorité sélectionnée est invalide.',
            'statut.required' => 'Le statut est obligatoire.',
            'statut.in' => 'Le statut sélectionné est invalide.',
            'date_debut.date' => 'La date de début est invalide.',
            'date_fin.date' => 'La date de fin est invalide.',
            'date_fin.after_or_equal' => 'La date de fin doit être postérieure ou égale à la date de début.',
        ];
    }
}
