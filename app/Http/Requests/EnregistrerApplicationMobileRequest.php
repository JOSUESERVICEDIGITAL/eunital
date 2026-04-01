<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnregistrerApplicationMobileRequest extends FormRequest
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
            'plateforme' => ['required', 'in:android,ios,hybride,pwa'],
            'stack_mobile' => ['nullable', 'string', 'max:20000'],
            'lien_demo' => ['nullable', 'url', 'max:2000'],
            'version' => ['nullable', 'string', 'max:50'],
            'statut' => ['required', 'in:conception,en_developpement,en_test,publiee,suspendue,archivee'],
        ];
    }

    public function messages(): array
    {
        return [
            'auteur_id.exists' => 'L’auteur sélectionné est invalide.',
            'responsable_id.exists' => 'Le responsable sélectionné est invalide.',
            'titre.required' => 'Le titre de l’application mobile est obligatoire.',
            'plateforme.required' => 'La plateforme est obligatoire.',
            'plateforme.in' => 'La plateforme sélectionnée est invalide.',
            'lien_demo.url' => 'Le lien de démonstration doit être valide.',
            'statut.required' => 'Le statut est obligatoire.',
            'statut.in' => 'Le statut sélectionné est invalide.',
        ];
    }
}