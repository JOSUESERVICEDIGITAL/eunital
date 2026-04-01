<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnregistrerPrototypeIngenieurieRequest extends FormRequest
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
            'description' => ['nullable', 'string', 'max:8000'],
            'objectif' => ['nullable', 'string', 'max:15000'],
            'lien_demo' => ['nullable', 'url', 'max:2000'],
            'depot_source' => ['nullable', 'url', 'max:2000'],
            'captures' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'statut' => ['required', 'in:en_cours,termine,abandonne'],
        ];
    }

    public function messages(): array
    {
        return [
            'auteur_id.exists' => 'L’auteur sélectionné est invalide.',
            'titre.required' => 'Le titre du prototype est obligatoire.',
            'lien_demo.url' => 'Le lien de démonstration doit être valide.',
            'depot_source.url' => 'Le lien du dépôt source doit être valide.',
            'captures.image' => 'La capture doit être une image.',
            'captures.mimes' => 'La capture doit être au format jpg, jpeg, png ou webp.',
            'captures.max' => 'La capture ne doit pas dépasser 4 Mo.',
            'statut.required' => 'Le statut est obligatoire.',
            'statut.in' => 'Le statut sélectionné est invalide.',
        ];
    }
}