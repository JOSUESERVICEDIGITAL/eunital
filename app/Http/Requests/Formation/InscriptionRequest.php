<?php

namespace App\Http\Requests\Formation;

use Illuminate\Foundation\Http\FormRequest;

class InscriptionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'module_id' => 'required|exists:modules,id',
            'statut' => 'nullable|in:en_attente,valide,termine,abandonne',
            'date_debut' => 'nullable|date',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',
            'progression' => 'nullable|integer|min:0|max:100',
            'derniere_activite' => 'nullable|date'
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'L\'utilisateur est requis.',
            'user_id.exists' => 'L\'utilisateur sélectionné n\'existe pas.',
            'module_id.required' => 'Le module est requis.',
            'module_id.exists' => 'Le module sélectionné n\'existe pas.',
            'statut.in' => 'Le statut doit être: en_attente, valide, termine ou abandonne.',
            'date_fin.after_or_equal' => 'La date de fin doit être postérieure ou égale à la date de début.',
            'progression.min' => 'La progression doit être supérieure ou égale à 0.',
            'progression.max' => 'La progression ne peut pas dépasser 100.'
        ];
    }

    protected function prepareForValidation(): void
    {
        if (!$this->has('statut')) {
            $this->merge([
                'statut' => 'en_attente'
            ]);
        }

        if (!$this->has('progression')) {
            $this->merge([
                'progression' => 0
            ]);
        }

        if ($this->statut === 'valide' && !$this->date_debut) {
            $this->merge([
                'date_debut' => now()
            ]);
        }

        if ($this->statut === 'termine' && !$this->date_fin) {
            $this->merge([
                'date_fin' => now()
            ]);
        }
    }
}