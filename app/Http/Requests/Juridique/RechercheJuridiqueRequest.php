<?php

namespace App\Http\Requests\Juridique;

use Illuminate\Foundation\Http\FormRequest;

class RechercheJuridiqueRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'q' => 'nullable|string|min:2',
            'type' => 'nullable|in:document,contrat,litige,legalite,conseil,tout',
            'categorie' => 'nullable|string',
            'statut' => 'nullable|string',
            'date_debut' => 'nullable|date',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',
            'tags' => 'nullable|array',
            'page' => 'nullable|integer|min:1',
            'per_page' => 'nullable|integer|min:1|max:100',
            'order_by' => 'nullable|string|in:created_at,updated_at,titre,date_effet',
            'order_dir' => 'nullable|string|in:asc,desc'
        ];
    }

    public function messages(): array
    {
        return [
            'q.min' => 'La recherche doit contenir au moins 2 caractères.',
            'date_fin.after_or_equal' => 'La date de fin doit être postérieure ou égale à la date de début.',
            'page.min' => 'La page doit être au moins 1.',
            'per_page.min' => 'Le nombre d\'éléments par page doit être au moins 1.',
            'per_page.max' => 'Le nombre d\'éléments par page ne peut pas dépasser 100.',
            'order_by.in' => 'Le champ de tri n\'est pas valide.',
            'order_dir.in' => 'Le sens de tri n\'est pas valide.'
        ];
    }

    protected function prepareForValidation(): void
    {
        if (!$this->has('type')) {
            $this->merge(['type' => 'tout']);
        }

        if (!$this->has('page')) {
            $this->merge(['page' => 1]);
        }

        if (!$this->has('per_page')) {
            $this->merge(['per_page' => 15]);
        }

        if (!$this->has('order_by')) {
            $this->merge(['order_by' => 'created_at']);
        }

        if (!$this->has('order_dir')) {
            $this->merge(['order_dir' => 'desc']);
        }
    }
}
