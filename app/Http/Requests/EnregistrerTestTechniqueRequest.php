<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnregistrerTestTechniqueRequest extends FormRequest
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
            'type_test' => ['required', 'in:fonctionnel,unitaire,integration,performance,securite,recette'],
            'resultat' => ['required', 'in:reussi,echoue,partiel,non_execute'],
            'environnement_test' => ['nullable', 'string', 'max:255'],
            'statut' => ['required', 'in:planifie,en_cours,termine,annule'],
        ];
    }

    public function messages(): array
    {
        return [
            'auteur_id.exists' => 'L’auteur sélectionné est invalide.',
            'titre.required' => 'Le titre du test technique est obligatoire.',
            'type_test.required' => 'Le type de test est obligatoire.',
            'type_test.in' => 'Le type de test sélectionné est invalide.',
            'resultat.required' => 'Le résultat est obligatoire.',
            'resultat.in' => 'Le résultat sélectionné est invalide.',
            'statut.required' => 'Le statut est obligatoire.',
            'statut.in' => 'Le statut sélectionné est invalide.',
        ];
    }
}