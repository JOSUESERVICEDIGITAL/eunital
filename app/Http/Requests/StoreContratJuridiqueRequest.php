<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContratJuridiqueRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titre' => 'required|string|max:255',
            'reference' => 'required|string|max:255|unique:contrats_juridiques,reference',

            'type_contrat' => 'required|string',
            'partie_type' => 'required|string',

            'client_studio_id' => 'nullable|exists:client_studios,id',
            'user_id' => 'nullable|exists:users,id',
            'projet_studio_id' => 'nullable|exists:projet_studios,id',

            'statut' => 'nullable|string',

            'date_debut' => 'nullable|date',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',

            'montant' => 'nullable|numeric|min:0',

            'fichier_pdf' => 'nullable|file|mimes:pdf|max:2048',

            'contenu' => 'nullable|string',
            'notes' => 'nullable|string',
        ];
    }
}
