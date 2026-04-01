<?php

namespace App\Http\Requests\Formation;

use Illuminate\Foundation\Http\FormRequest;

class DevoirRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'cour_id' => 'required|exists:cours,id',
            'type' => 'required|in:exercice,quiz,projet,examen',
            'date_limite' => 'nullable|date|after:now',
            'duree_limite' => 'nullable|integer|min:1',
            'note_maximale' => 'nullable|integer|min:1|max:100',
            'is_published' => 'nullable|boolean',
            'visible' => 'nullable|boolean',
            'resources' => 'nullable|array',
            'resources.*' => 'file|max:10240' // 10 Mo max par fichier
        ];
    }

    public function messages(): array
    {
        return [
            'titre.required' => 'Le titre du devoir est requis.',
            'titre.max' => 'Le titre ne doit pas dépasser 255 caractères.',
            'description.required' => 'La description est requise.',
            'cour_id.required' => 'Le cours est requis.',
            'cour_id.exists' => 'Le cours sélectionné n\'existe pas.',
            'type.required' => 'Le type de devoir est requis.',
            'type.in' => 'Le type doit être: exercice, quiz, projet ou examen.',
            'date_limite.after' => 'La date limite doit être postérieure à maintenant.',
            'duree_limite.min' => 'La durée limite doit être d\'au moins 1 minute.',
            'note_maximale.min' => 'La note maximale doit être d\'au moins 1.',
            'note_maximale.max' => 'La note maximale ne peut pas dépasser 100.',
            'resources.*.max' => 'Chaque fichier ne doit pas dépasser 10 Mo.'
        ];
    }

    protected function prepareForValidation(): void
    {
        if (!$this->has('note_maximale')) {
            $this->merge([
                'note_maximale' => 20
            ]);
        }

        if (!$this->has('is_published')) {
            $this->merge([
                'is_published' => false
            ]);
        }

        if (!$this->has('visible')) {
            $this->merge([
                'visible' => true
            ]);
        }
    }
}