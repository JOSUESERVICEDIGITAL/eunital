<?php

namespace App\Http\Requests\Formation;

use Illuminate\Foundation\Http\FormRequest;

class PresenceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'inscription_id' => 'required|exists:inscriptions,id',
            'cour_id' => 'required|exists:cours,id',
            'date_debut' => 'nullable|date',
            'date_fin' => 'nullable|date|after:date_debut',
            'duree_connexion' => 'nullable|integer|min:0',
            'present' => 'nullable|boolean',
            'statut' => 'nullable|in:absent,present,retard,excusé',
            'code_acces' => 'nullable|string|max:255'
        ];
    }

    public function messages(): array
    {
        return [
            'inscription_id.required' => 'L\'inscription est requise.',
            'inscription_id.exists' => 'L\'inscription sélectionnée n\'existe pas.',
            'cour_id.required' => 'Le cours est requis.',
            'cour_id.exists' => 'Le cours sélectionné n\'existe pas.',
            'date_fin.after' => 'La date de fin doit être postérieure à la date de début.',
            'duree_connexion.min' => 'La durée de connexion doit être positive.',
            'statut.in' => 'Le statut doit être: absent, present, retard ou excusé.'
        ];
    }

    protected function prepareForValidation(): void
    {
        if (!$this->has('present')) {
            $this->merge([
                'present' => $this->statut === 'present'
            ]);
        }

        if (!$this->has('statut')) {
            $this->merge([
                'statut' => $this->present ? 'present' : 'absent'
            ]);
        }

        // Calcul de la durée de connexion si date_debut et date_fin sont présentes
        if ($this->date_debut && $this->date_fin && !$this->duree_connexion) {
            $debut = \Carbon\Carbon::parse($this->date_debut);
            $fin = \Carbon\Carbon::parse($this->date_fin);
            $this->merge([
                'duree_connexion' => $debut->diffInSeconds($fin)
            ]);
        }
    }
}