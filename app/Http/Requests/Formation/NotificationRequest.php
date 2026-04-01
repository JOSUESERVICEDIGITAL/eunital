<?php

namespace App\Http\Requests\Formation;

use Illuminate\Foundation\Http\FormRequest;

class NotificationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'type' => 'required|string|max:50',
            'message' => 'required|string|max:1000',
            'data' => 'nullable|array',
            'is_read' => 'nullable|boolean'
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'L\'utilisateur est requis.',
            'user_id.exists' => 'L\'utilisateur sélectionné n\'existe pas.',
            'type.required' => 'Le type de notification est requis.',
            'type.max' => 'Le type ne doit pas dépasser 50 caractères.',
            'message.required' => 'Le message est requis.',
            'message.max' => 'Le message ne doit pas dépasser 1000 caractères.'
        ];
    }

    protected function prepareForValidation(): void
    {
        if (!$this->has('is_read')) {
            $this->merge([
                'is_read' => false
            ]);
        }

        // Si is_read est true, ajouter read_at
        if ($this->is_read && !$this->has('read_at')) {
            $this->merge([
                'read_at' => now()
            ]);
        }
    }
}