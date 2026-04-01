<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModifierPositionnementMarketingRequest extends FormRequest
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
            'segment_cible' => ['nullable', 'string', 'max:255'],
            'probleme_adresse' => ['nullable', 'string', 'max:10000'],
            'promesse' => ['nullable', 'string', 'max:10000'],
            'differenciation' => ['nullable', 'string', 'max:10000'],
            'message_central' => ['nullable', 'string', 'max:10000'],
            'canal_principal' => ['nullable', 'string', 'max:255'],
            'statut' => ['required', 'in:brouillon,actif,a_revoir,archive'],
        ];
    }

    public function messages(): array
    {
        return [
            'auteur_id.exists' => 'L’auteur sélectionné est invalide.',
            'titre.required' => 'Le titre du positionnement est obligatoire.',
            'statut.required' => 'Le statut est obligatoire.',
            'statut.in' => 'Le statut sélectionné est invalide.',
        ];
    }
}
