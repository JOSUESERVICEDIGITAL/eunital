<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnregistrerApiIntegrationRequest extends FormRequest
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
            'type_api' => ['required', 'in:rest,graphql,webhook,sdk,autre'],
            'methode_authentification' => ['nullable', 'string', 'max:255'],
            'url_base' => ['nullable', 'url', 'max:2000'],
            'documentation_url' => ['nullable', 'url', 'max:2000'],
            'statut' => ['required', 'in:conception,en_developpement,en_test,active,inactive,archivee'],
        ];
    }

    public function messages(): array
    {
        return [
            'auteur_id.exists' => 'L’auteur sélectionné est invalide.',
            'titre.required' => 'Le titre de l’API ou intégration est obligatoire.',
            'type_api.required' => 'Le type d’API est obligatoire.',
            'type_api.in' => 'Le type d’API sélectionné est invalide.',
            'url_base.url' => 'L’URL de base doit être valide.',
            'documentation_url.url' => 'L’URL de documentation doit être valide.',
            'statut.required' => 'Le statut est obligatoire.',
            'statut.in' => 'Le statut sélectionné est invalide.',
        ];
    }
}