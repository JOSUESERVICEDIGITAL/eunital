<?php

namespace App\Http\Requests\Juridique;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ConseilJuridiqueRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $conseilId = $this->route('conseil_juridique') ? $this->route('conseil_juridique')->id : null;

        return [
            'titre' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:conseils_juridiques,slug,' . $conseilId,
            'contenu' => 'required|string',
            'categorie' => ['required', Rule::in([
                'entreprise', 'rh', 'fiscal', 'social', 'commercial',
                'international', 'propriete_intellectuelle', 'numerique', 'rgpd'
            ])],
            'tags' => 'nullable|array',
            'faq' => 'nullable|array',
            'exemples' => 'nullable|array',
            'references_legales' => 'nullable|array',
            'is_published' => 'nullable|boolean'
        ];
    }

    public function messages(): array
    {
        return [
            'titre.required' => 'Le titre du conseil est requis.',
            'contenu.required' => 'Le contenu du conseil est requis.',
            'categorie.required' => 'La catégorie est requise.',
            'categorie.in' => 'La catégorie sélectionnée n\'est pas valide.'
        ];
    }

    protected function prepareForValidation(): void
    {
        if (!$this->has('slug') && $this->has('titre')) {
            $this->merge([
                'slug' => \Str::slug($this->titre)
            ]);
        }

        if (!$this->has('is_published')) {
            $this->merge(['is_published' => true]);
        }
    }
}
