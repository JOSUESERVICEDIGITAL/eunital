<?php

namespace App\Http\Requests\Formation;

use Illuminate\Foundation\Http\FormRequest;

class ChapitreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cour_id' => 'required|exists:cours,id',
            'ordre' => 'nullable|integer|min:0',
            'duree_estimee' => 'nullable|integer|min:1',
            'is_free' => 'nullable|boolean'
        ];
    }

    public function messages(): array
    {
        return [
            'titre.required' => 'Le titre du chapitre est requis.',
            'titre.max' => 'Le titre ne doit pas dépasser 255 caractères.',
            'cour_id.required' => 'Le cours est requis.',
            'cour_id.exists' => 'Le cours sélectionné n\'existe pas.',
            'ordre.integer' => 'L\'ordre doit être un nombre entier.',
            'ordre.min' => 'L\'ordre doit être supérieur ou égal à 0.',
            'duree_estimee.integer' => 'La durée doit être un nombre entier.',
            'duree_estimee.min' => 'La durée doit être d\'au moins 1 minute.'
        ];
    }

    protected function prepareForValidation(): void
    {
        if (!$this->has('ordre')) {
            $this->merge([
                'ordre' => 0
            ]);
        }

        if (!$this->has('is_free')) {
            $this->merge([
                'is_free' => false
            ]);
        }
    }
}