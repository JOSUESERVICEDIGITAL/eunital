<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModifierApplicationWebRequest extends FormRequest
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
            'stack_technique' => ['nullable', 'string', 'max:20000'],
            'url_production' => ['nullable', 'url', 'max:2000'],
            'url_staging' => ['nullable', 'url', 'max:2000'],
            'statut' => ['required', 'in:conception,en_developpement,en_test,en_ligne,suspendue,archivee'],
            'priorite' => ['required', 'in:faible,moyenne,haute,critique'],
            'version' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'auteur_id.exists' => 'L’auteur sélectionné est invalide.',
            'responsable_id.exists' => 'Le responsable sélectionné est invalide.',
            'titre.required' => 'Le titre de l’application web est obligatoire.',
            'url_production.url' => 'L’URL de production doit être valide.',
            'url_staging.url' => 'L’URL de staging doit être valide.',
            'statut.required' => 'Le statut est obligatoire.',
            'statut.in' => 'Le statut sélectionné est invalide.',
            'priorite.required' => 'La priorité est obligatoire.',
            'priorite.in' => 'La priorité sélectionnée est invalide.',
        ];
    }
}