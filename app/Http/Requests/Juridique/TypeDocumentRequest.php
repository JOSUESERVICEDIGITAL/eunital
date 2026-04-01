<?php

namespace App\Http\Requests\Juridique;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TypeDocumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // À adapter selon vos permissions
    }

    public function rules(): array
    {
        $typeId = $this->route('type_document') ? $this->route('type_document')->id : null;

        return [
            'nom' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:types_documents,slug,' . $typeId,
            'code' => 'required|string|max:50|unique:types_documents,code,' . $typeId,
            'description' => 'nullable|string',
            'categorie' => ['required', Rule::in([
                'contrat', 'engagement', 'legal', 'administratif',
                'conformite', 'rgpd', 'commercial', 'rh', 'formation',
                'partenariat', 'finance', 'technique'
            ])],
            'icon' => 'nullable|string|max:50',
            'couleur' => 'nullable|string|max:20|regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/',
            'duree_validite' => 'nullable|integer|min:1',
            'necessite_signature' => 'nullable|boolean',
            'necessite_timbre' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'ordre' => 'nullable|integer|min:0',
            'metadatas' => 'nullable|array'
        ];
    }

    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom du type de document est requis.',
            'code.required' => 'Le code est requis.',
            'code.unique' => 'Ce code est déjà utilisé.',
            'categorie.required' => 'La catégorie est requise.',
            'categorie.in' => 'La catégorie sélectionnée n\'est pas valide.',
            'couleur.regex' => 'La couleur doit être au format hexadécimal (#RRGGBB).',
            'duree_validite.min' => 'La durée de validité doit être d\'au moins 1 jour.'
        ];
    }

    protected function prepareForValidation(): void
    {
        // Générer le slug si non fourni
        if (!$this->has('slug') && $this->has('nom')) {
            $this->merge([
                'slug' => \Str::slug($this->nom)
            ]);
        }

        // Valeurs par défaut
        if (!$this->has('icon')) {
            $this->merge(['icon' => 'fa-file-contract']);
        }

        if (!$this->has('couleur')) {
            $this->merge(['couleur' => '#6c757d']);
        }

        if (!$this->has('necessite_signature')) {
            $this->merge(['necessite_signature' => true]);
        }

        if (!$this->has('is_active')) {
            $this->merge(['is_active' => true]);
        }

        if (!$this->has('ordre')) {
            $this->merge(['ordre' => 0]);
        }
    }
}
