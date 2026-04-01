<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModifierSiteVitrineRequest extends FormRequest
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
            'client' => ['nullable', 'string', 'max:255'],
            'url_site' => ['nullable', 'url', 'max:2000'],
            'technologies' => ['nullable', 'string', 'max:20000'],
            'statut' => ['required', 'in:maquette,en_developpement,en_revision,livre,en_ligne,archive'],
            'date_livraison_prevue' => ['nullable', 'date'],
        ];
    }

    public function messages(): array
    {
        return [
            'auteur_id.exists' => 'L’auteur sélectionné est invalide.',
            'titre.required' => 'Le titre du site vitrine est obligatoire.',
            'url_site.url' => 'L’URL du site doit être valide.',
            'statut.required' => 'Le statut est obligatoire.',
            'statut.in' => 'Le statut sélectionné est invalide.',
            'date_livraison_prevue.date' => 'La date de livraison prévue est invalide.',
        ];
    }
}