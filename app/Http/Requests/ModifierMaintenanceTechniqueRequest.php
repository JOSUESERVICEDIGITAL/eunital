<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModifierMaintenanceTechniqueRequest extends FormRequest
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
            'description' => ['nullable', 'string', 'max:10000'],
            'type_maintenance' => ['required', 'in:corrective,preventive,evolutive,urgence,securite'],
            'niveau_urgence' => ['required', 'in:faible,moyenne,haute,critique'],
            'statut' => ['required', 'in:ouverte,en_cours,resolue,fermee,reportee'],
            'date_signalement' => ['nullable', 'date'],
            'date_resolution' => ['nullable', 'date'],
        ];
    }

    public function messages(): array
    {
        return [
            'auteur_id.exists' => 'L’auteur sélectionné est invalide.',
            'responsable_id.exists' => 'Le responsable sélectionné est invalide.',
            'titre.required' => 'Le titre de la maintenance est obligatoire.',
            'type_maintenance.required' => 'Le type de maintenance est obligatoire.',
            'type_maintenance.in' => 'Le type de maintenance sélectionné est invalide.',
            'niveau_urgence.required' => 'Le niveau d’urgence est obligatoire.',
            'niveau_urgence.in' => 'Le niveau d’urgence sélectionné est invalide.',
            'statut.required' => 'Le statut est obligatoire.',
            'statut.in' => 'Le statut sélectionné est invalide.',
            'date_signalement.date' => 'La date de signalement est invalide.',
            'date_resolution.date' => 'La date de résolution est invalide.',
        ];
    }
}