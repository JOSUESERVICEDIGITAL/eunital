<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModifierEvenementStudioRequest extends FormRequest
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
            'type' => ['nullable', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'lieu' => ['nullable', 'string', 'max:255'],
            'statut' => ['required', 'in:planifie,realise,annule'],
        ];
    }

    public function messages(): array
    {
        return [
            'titre.required' => 'Le titre de l’événement est obligatoire.',
            'titre.max' => 'Le titre ne doit pas dépasser 255 caractères.',
            'client_studio_id.exists' => 'Le client sélectionné est invalide.',
            'type.max' => 'Le type ne doit pas dépasser 255 caractères.',
            'date.required' => 'La date de l’événement est obligatoire.',
            'date.date' => 'La date de l’événement est invalide.',
            'lieu.max' => 'Le lieu ne doit pas dépasser 255 caractères.',
            'statut.required' => 'Le statut est obligatoire.',
            'statut.in' => 'Le statut est invalide.',
        ];
    }
}