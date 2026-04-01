<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModifierDepotVersionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'auteur_id' => ['nullable', 'exists:users,id'],
            'titre' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:10000'],
            'url_depot' => ['nullable', 'url', 'max:2000'],
            'branche_principale' => ['nullable', 'string', 'max:255'],
            'version_actuelle' => ['nullable', 'string', 'max:50'],
            'type_version' => ['required', 'in:majeure,mineure,corrective,hotfix'],
            'statut' => ['required', 'in:actif,en_preparation,deploie,gele,archive'],
        ];
    }

    public function messages(): array
    {
        return [
            'auteur_id.exists' => 'L’auteur sélectionné est invalide.',
            'titre.required' => 'Le titre du dépôt ou de la version est obligatoire.',
            'url_depot.url' => 'L’URL du dépôt doit être valide.',
            'type_version.required' => 'Le type de version est obligatoire.',
            'type_version.in' => 'Le type de version sélectionné est invalide.',
            'statut.required' => 'Le statut est obligatoire.',
            'statut.in' => 'Le statut sélectionné est invalide.',
        ];
    }
}