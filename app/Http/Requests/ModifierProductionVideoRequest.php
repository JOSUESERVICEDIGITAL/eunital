<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModifierProductionVideoRequest extends FormRequest
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

            'type' => ['required', 'in:clip,spot,interview,evenement,mariage'],
            'statut' => ['required', 'in:tournage,montage,validation,livre,archive'],

            'fichier_video' => ['nullable', 'string', 'max:255'],

            'auteur_id' => ['nullable', 'exists:users,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'titre.required' => 'Le titre de la production est obligatoire.',
            'titre.max' => 'Le titre ne doit pas dépasser 255 caractères.',

            'client_studio_id.exists' => 'Le client sélectionné est invalide.',
            'projet_studio_id.exists' => 'Le projet sélectionné est invalide.',

            'type.required' => 'Le type de production est obligatoire.',
            'type.in' => 'Le type de production est invalide.',

            'statut.required' => 'Le statut est obligatoire.',
            'statut.in' => 'Le statut est invalide.',

            'fichier_video.max' => 'Le nom du fichier est trop long.',

            'auteur_id.exists' => 'L’utilisateur sélectionné est invalide.',
        ];
    }
}