<?php

namespace App\Http\Requests\Juridique;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DemarcheAdministrativeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $demarcheId = $this->route('demarche_administrative') ? $this->route('demarche_administrative')->id : null;

        return [
            'titre' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:demarches_administratives,slug,' . $demarcheId,
            'categorie' => ['required', Rule::in([
                'creation', 'modification', 'autorisation', 'declaration',
                'agrement', 'certification', 'enregistrement', 'radiation'
            ])],
            'description' => 'required|string',
            'etapes' => 'nullable|array',
            'etapes.*.titre' => 'required|string',
            'etapes.*.description' => 'nullable|string',
            'etapes.*.delai' => 'nullable|integer',
            'documents_requis' => 'nullable|array',
            'intervenants' => 'nullable|array',
            'delai_estime' => 'nullable|integer|min:1',
            'cout_estime' => 'nullable|numeric|min:0',
            'organismes' => 'nullable|array',
            'url_officielle' => 'nullable|url',
            'notes' => 'nullable|string',
            'is_active' => 'nullable|boolean'
        ];
    }

    public function messages(): array
    {
        return [
            'titre.required' => 'Le titre de la démarche est requis.',
            'categorie.required' => 'La catégorie est requise.',
            'categorie.in' => 'La catégorie sélectionnée n\'est pas valide.',
            'description.required' => 'La description est requise.',
            'delai_estime.min' => 'Le délai estimé doit être d\'au moins 1 jour.',
            'cout_estime.min' => 'Le coût estimé doit être positif.',
            'url_officielle.url' => 'L\'URL officielle doit être une URL valide.'
        ];
    }

    protected function prepareForValidation(): void
    {
        if (!$this->has('slug') && $this->has('titre')) {
            $this->merge([
                'slug' => \Str::slug($this->titre)
            ]);
        }

        if (!$this->has('is_active')) {
            $this->merge(['is_active' => true]);
        }
    }
}
