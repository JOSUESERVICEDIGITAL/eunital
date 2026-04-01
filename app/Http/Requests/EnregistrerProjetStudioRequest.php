<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnregistrerProjetStudioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titre' => ['required', 'string', 'max:255'],
            'client_studio_id' => ['nullable', 'exists:client_studios,id'],
            'type' => ['required', 'in:album,video,evenement'],
            'statut' => ['required', 'in:en_cours,termine,archive'],
            'date_sortie' => ['nullable', 'date'],
        ];
    }

    public function messages(): array
    {
        return [
            'titre.required' => 'Le titre du projet est obligatoire.',
            'titre.max' => 'Le titre ne doit pas dépasser 255 caractères.',
            'client_studio_id.exists' => 'Le client sélectionné est invalide.',
            'type.required' => 'Le type du projet est obligatoire.',
            'type.in' => 'Le type du projet est invalide.',
            'statut.required' => 'Le statut du projet est obligatoire.',
            'statut.in' => 'Le statut du projet est invalide.',
            'date_sortie.date' => 'La date de sortie est invalide.',
        ];
    }
}