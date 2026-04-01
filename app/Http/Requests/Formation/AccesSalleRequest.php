<?php

namespace App\Http\Requests\Formation;

use Illuminate\Foundation\Http\FormRequest;

class AccesSalleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cour_id' => 'required|exists:cours,id',
            'code_acces' => 'nullable|string|max:255',
            'expires_at' => 'nullable|date|after:now',
            'is_active' => 'nullable|boolean',
            'max_utilisateurs' => 'nullable|integer|min:1',
            'utilisateurs_actifs' => 'nullable|array',
            'utilisateurs_actifs.*' => 'exists:users,id'
        ];
    }

    public function messages(): array
    {
        return [
            'cour_id.required' => 'Le cours est requis.',
            'cour_id.exists' => 'Le cours sélectionné n\'existe pas.',
            'expires_at.after' => 'La date d\'expiration doit être postérieure à maintenant.',
            'max_utilisateurs.min' => 'Le nombre maximum d\'utilisateurs doit être d\'au moins 1.',
            'utilisateurs_actifs.*.exists' => 'Un ou plusieurs utilisateurs n\'existent pas.'
        ];
    }

    protected function prepareForValidation(): void
    {
        // Générer un code d'accès si non fourni
        if (!$this->has('code_acces')) {
            $this->merge([
                'code_acces' => strtoupper(substr(md5(uniqid() . $this->cour_id . now()), 0, 8))
            ]);
        }

        // Définir une expiration par défaut (2 heures) si non fournie
        if (!$this->has('expires_at')) {
            $this->merge([
                'expires_at' => now()->addHours(2)
            ]);
        }

        if (!$this->has('generated_at')) {
            $this->merge([
                'generated_at' => now()
            ]);
        }

        if (!$this->has('is_active')) {
            $this->merge([
                'is_active' => true
            ]);
        }
    }
}