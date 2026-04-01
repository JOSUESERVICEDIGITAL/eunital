<?php

namespace App\Http\Requests\Formation;

use Illuminate\Foundation\Http\FormRequest;

class SoumissionDevoirRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'devoir_id' => 'required|exists:devoirs,id',
            'user_id' => 'required|exists:users,id',
            'contenu' => 'nullable|string',
            'fichiers' => 'nullable|array',
            'fichiers.*' => 'file|max:20480', // 20 Mo max par fichier
            'note' => 'nullable|numeric|min:0',
            'commentaire_enseignant' => 'nullable|string'
        ];
    }

    public function messages(): array
    {
        return [
            'devoir_id.required' => 'Le devoir est requis.',
            'devoir_id.exists' => 'Le devoir sélectionné n\'existe pas.',
            'user_id.required' => 'L\'utilisateur est requis.',
            'user_id.exists' => 'L\'utilisateur sélectionné n\'existe pas.',
            'note.numeric' => 'La note doit être un nombre.',
            'note.min' => 'La note ne peut pas être négative.',
            'fichiers.*.max' => 'Chaque fichier ne doit pas dépasser 20 Mo.'
        ];
    }

    protected function prepareForValidation(): void
    {
        if (!$this->has('soumis_le')) {
            $this->merge([
                'soumis_le' => now()
            ]);
        }

        // Si une note est fournie, ajouter la date de notation
        if ($this->has('note') && !$this->has('note_le')) {
            $this->merge([
                'note_le' => now()
            ]);
        }
    }
}