<?php

namespace App\Http\Requests\Formation;

use Illuminate\Foundation\Http\FormRequest;

class CommentaireCoursRequest extends FormRequest
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
            'parent_id' => 'nullable|exists:commentaires_cours,id',
            'contenu' => 'required|string|min:2|max:5000',
            'is_approved' => 'nullable|boolean'
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'L\'utilisateur est requis.',
            'user_id.exists' => 'L\'utilisateur sélectionné n\'existe pas.',
            'cour_id.required' => 'Le cours est requis.',
            'cour_id.exists' => 'Le cours sélectionné n\'existe pas.',
            'parent_id.exists' => 'Le commentaire parent n\'existe pas.',
            'contenu.required' => 'Le contenu du commentaire est requis.',
            'contenu.min' => 'Le commentaire doit contenir au moins 2 caractères.',
            'contenu.max' => 'Le commentaire ne doit pas dépasser 5000 caractères.'
        ];
    }

    protected function prepareForValidation(): void
    {
        if (!$this->has('is_approved')) {
            $this->merge([
                'is_approved' => true // Par défaut approuvé, à modifier selon les besoins
            ]);
        }

        if (!$this->has('likes')) {
            $this->merge([
                'likes' => 0
            ]);
        }
    }
}