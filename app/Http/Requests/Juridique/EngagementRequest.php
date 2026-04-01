<?php

namespace App\Http\Requests\Juridique;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EngagementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'document_id' => 'required|exists:documents,id|unique:engagements,document_id,' . ($this->route('engagement') ? $this->route('engagement')->id : null),
            'reference' => 'nullable|string|max:100|unique:engagements,reference,' . ($this->route('engagement') ? $this->route('engagement')->id : null),
            'type_engagement' => ['required', Rule::in([
                'charte', 'ethique', 'confidentialite', 'conformite',
                'qualite', 'securite', 'environnement', 'social'
            ])],
            'contenu' => 'required|string',
            'principes' => 'nullable|array',
            'obligations' => 'nullable|array',
            'date_adhesion' => 'nullable|date',
            'date_fin' => 'nullable|date|after_or_equal:date_adhesion',
            'est_public' => 'nullable|boolean'
        ];
    }

    public function messages(): array
    {
        return [
            'document_id.required' => 'Le document est requis.',
            'document_id.exists' => 'Le document sélectionné n\'existe pas.',
            'document_id.unique' => 'Ce document a déjà un engagement associé.',
            'type_engagement.required' => 'Le type d\'engagement est requis.',
            'type_engagement.in' => 'Le type d\'engagement sélectionné n\'est pas valide.',
            'contenu.required' => 'Le contenu de l\'engagement est requis.',
            'date_fin.after_or_equal' => 'La date de fin doit être postérieure ou égale à la date d\'adhésion.'
        ];
    }

    protected function prepareForValidation(): void
    {
        if (!$this->has('date_adhesion')) {
            $this->merge(['date_adhesion' => now()]);
        }

        if (!$this->has('est_public')) {
            $this->merge(['est_public' => false]);
        }

        // Générer une référence si non fournie
        if (!$this->has('reference')) {
            $prefix = strtoupper(substr($this->type_engagement, 0, 3));
            $year = date('Y');
            $random = strtoupper(substr(uniqid(), -6));
            $this->merge(['reference' => "{$prefix}-{$year}-{$random}"]);
        }
    }
}
