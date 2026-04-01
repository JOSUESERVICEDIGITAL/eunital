<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModifierReservationStudioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'client_studio_id' => ['required', 'exists:client_studios,id'],
            'date_debut' => ['required', 'date'],
            'date_fin' => ['required', 'date', 'after:date_debut'],
            'salle' => ['nullable', 'string', 'max:255'],
            'statut' => ['required', 'in:reserve,confirme,annule'],
        ];
    }

    public function messages(): array
    {
        return [
            'client_studio_id.required' => 'Le client est obligatoire.',
            'client_studio_id.exists' => 'Le client sélectionné est invalide.',
            'date_debut.required' => 'La date de début est obligatoire.',
            'date_debut.date' => 'La date de début est invalide.',
            'date_fin.required' => 'La date de fin est obligatoire.',
            'date_fin.date' => 'La date de fin est invalide.',
            'date_fin.after' => 'La date de fin doit être après la date de début.',
            'salle.max' => 'Le nom de la salle ne doit pas dépasser 255 caractères.',
            'statut.required' => 'Le statut est obligatoire.',
            'statut.in' => 'Le statut est invalide.',
        ];
    }
}