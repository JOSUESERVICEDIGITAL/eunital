<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnregistrerEquipementStudioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nom' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:camera,micro,eclairage,ordinateur,console,autre'],
            'marque' => ['nullable', 'string', 'max:255'],
            'modele' => ['nullable', 'string', 'max:255'],

            'etat' => ['required', 'in:neuf,bon,usage,reparation,hs'],

            'date_acquisition' => ['nullable', 'date'],

            'statut' => ['required', 'in:disponible,en_utilisation,maintenance,indisponible'],

            'notes' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom de l’équipement est obligatoire.',
            'nom.max' => 'Le nom ne doit pas dépasser 255 caractères.',

            'type.required' => 'Le type est obligatoire.',
            'type.in' => 'Le type d’équipement est invalide.',

            'marque.max' => 'La marque ne doit pas dépasser 255 caractères.',
            'modele.max' => 'Le modèle ne doit pas dépasser 255 caractères.',

            'etat.required' => 'L’état est obligatoire.',
            'etat.in' => 'L’état est invalide.',

            'date_acquisition.date' => 'La date d’acquisition est invalide.',

            'statut.required' => 'Le statut est obligatoire.',
            'statut.in' => 'Le statut est invalide.',
        ];
    }
}