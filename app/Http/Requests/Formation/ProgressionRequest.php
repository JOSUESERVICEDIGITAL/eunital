<?php

namespace App\Http\Requests\Formation;

use Illuminate\Foundation\Http\FormRequest;

class ProgressionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'cour_id' => 'required|exists:cours,id',
            'chapitre_id' => 'nullable|exists:chapitres,id',
            'progression' => 'nullable|integer|min:0|max:100',
            'termine' => 'nullable|boolean',
            'dernier_acces' => 'nullable|date',
            'metadatas' => 'nullable|array'
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'L\'utilisateur est requis.',
            'user_id.exists' => 'L\'utilisateur sélectionné n\'existe pas.',
            'cour_id.required' => 'Le cours est requis.',
            'cour_id.exists' => 'Le cours sélectionné n\'existe pas.',
            'chapitre_id.exists' => 'Le chapitre sélectionné n\'existe pas.',
            'progression.min' => 'La progression doit être supérieure ou égale à 0.',
            'progression.max' => 'La progression ne peut pas dépasser 100.'
        ];
    }

    protected function prepareForValidation(): void
    {
        if (!$this->has('progression')) {
            $this->merge([
                'progression' => 0
            ]);
        }

        if (!$this->has('termine')) {
            $this->merge([
                'termine' => $this->progression >= 100
            ]);
        }

        if (!$this->has('dernier_acces')) {
            $this->merge([
                'dernier_acces' => now()
            ]);
        }

        // Si termine est true, forcer progression à 100
        if ($this->termine && $this->progression < 100) {
            $this->merge([
                'progression' => 100
            ]);
        }

        // Si progression est 100, forcer termine à true
        if ($this->progression >= 100 && !$this->termine) {
            $this->merge([
                'termine' => true
            ]);
        }
    }
}