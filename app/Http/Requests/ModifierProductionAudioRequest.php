<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModifierProductionAudioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titre' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],

            'client_studio_id' => ['nullable', 'exists:client_studios,id'],
            'projet_studio_id' => ['nullable', 'exists:projet_studios,id'],

            'type' => ['required', 'in:voix,chant,podcast,instrumental'],
            'statut' => ['required', 'in:enregistrement,mixage,mastering,livre,archive'],

            'duree' => ['nullable', 'integer', 'min:0'],
            'fichier_audio' => ['nullable', 'string', 'max:255'],

            'auteur_id' => ['nullable', 'exists:users,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'titre.required' => 'Le titre de la production audio est obligatoire.',
            'titre.max' => 'Le titre ne doit pas dépasser 255 caractères.',

            'client_studio_id.exists' => 'Le client sélectionné est invalide.',
            'projet_studio_id.exists' => 'Le projet sélectionné est invalide.',

            'type.required' => 'Le type audio est obligatoire.',
            'type.in' => 'Le type audio est invalide.',

            'statut.required' => 'Le statut est obligatoire.',
            'statut.in' => 'Le statut est invalide.',

            'duree.integer' => 'La durée doit être un nombre entier.',
            'duree.min' => 'La durée ne peut pas être négative.',

            'fichier_audio.max' => 'Le nom du fichier audio est trop long.',

            'auteur_id.exists' => 'L’utilisateur sélectionné est invalide.',
        ];
    }
}