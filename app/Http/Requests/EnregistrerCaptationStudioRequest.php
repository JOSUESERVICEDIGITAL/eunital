<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnregistrerCaptationStudioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titre' => ['required', 'string', 'max:255'],
            'evenement_studio_id' => ['nullable', 'exists:evenement_studios,id'],
            'date' => ['required', 'date'],
            'lieu' => ['nullable', 'string', 'max:255'],
            'type' => ['required', 'in:conference,concert,mariage,evenement'],
            'statut' => ['required', 'in:planifie,en_cours,termine'],
        ];
    }

    public function messages(): array
    {
        return [
            'titre.required' => 'Le titre de la captation est obligatoire.',
            'titre.max' => 'Le titre ne doit pas dépasser 255 caractères.',
            'evenement_studio_id.exists' => 'L’événement sélectionné est invalide.',
            'date.required' => 'La date de captation est obligatoire.',
            'date.date' => 'La date de captation est invalide.',
            'lieu.max' => 'Le lieu ne doit pas dépasser 255 caractères.',
            'type.required' => 'Le type de captation est obligatoire.',
            'type.in' => 'Le type de captation est invalide.',
            'statut.required' => 'Le statut est obligatoire.',
            'statut.in' => 'Le statut est invalide.',
        ];
    }
}