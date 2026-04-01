<?php

namespace App\Http\Requests\Formation;

use Illuminate\Foundation\Http\FormRequest;

class CategorieModuleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // À modifier selon vos permissions
    }

    public function rules(): array
    {
        $categorieId = $this->route('categorie_module') ? $this->route('categorie_module')->id : null;

        return [
            'nom' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories_modules,slug,' . $categorieId,
            'description' => 'nullable|string',
            'ordre' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean'
        ];
    }

    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom de la catégorie est requis.',
            'nom.max' => 'Le nom ne doit pas dépasser 255 caractères.',
            'slug.required' => 'Le slug est requis.',
            'slug.unique' => 'Ce slug est déjà utilisé.',
            'ordre.integer' => 'L\'ordre doit être un nombre entier.',
            'ordre.min' => 'L\'ordre doit être supérieur ou égal à 0.'
        ];
    }

    protected function prepareForValidation(): void
    {
        if (!$this->has('slug') && $this->has('nom')) {
            $this->merge([
                'slug' => \Str::slug($this->nom)
            ]);
        }

        if (!$this->has('ordre')) {
            $this->merge([
                'ordre' => 0
            ]);
        }

        if (!$this->has('is_active')) {
            $this->merge([
                'is_active' => true
            ]);
        }
    }
}