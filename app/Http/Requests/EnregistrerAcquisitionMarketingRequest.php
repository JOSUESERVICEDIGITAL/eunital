<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnregistrerAcquisitionMarketingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'auteur_id' => ['nullable', 'exists:users,id'],
            'campagne_marketing_id' => ['nullable', 'exists:campagnes_marketing,id'],
            'titre' => ['required', 'string', 'max:255'],
            'source' => ['nullable', 'string', 'max:255'],
            'canal' => ['nullable', 'string', 'max:255'],
            'visiteurs' => ['nullable', 'integer', 'min:0'],
            'leads' => ['nullable', 'integer', 'min:0'],
            'cout_acquisition' => ['nullable', 'numeric', 'min:0'],
            'taux_conversion' => ['nullable', 'numeric', 'min:0'],
            'statut' => ['required', 'in:active,optimisation,stoppee,archivee'],
        ];
    }

    public function messages(): array
    {
        return [
            'auteur_id.exists' => 'L’auteur sélectionné est invalide.',
            'campagne_marketing_id.exists' => 'La campagne sélectionnée est invalide.',
            'titre.required' => 'Le titre de l’acquisition est obligatoire.',
            'visiteurs.integer' => 'Le nombre de visiteurs doit être un entier.',
            'visiteurs.min' => 'Le nombre de visiteurs ne peut pas être négatif.',
            'leads.integer' => 'Le nombre de leads doit être un entier.',
            'leads.min' => 'Le nombre de leads ne peut pas être négatif.',
            'cout_acquisition.numeric' => 'Le coût d’acquisition doit être un nombre.',
            'cout_acquisition.min' => 'Le coût d’acquisition ne peut pas être négatif.',
            'statut.required' => 'Le statut est obligatoire.',
            'statut.in' => 'Le statut sélectionné est invalide.',
        ];
    }
}
