<?php

namespace App\Http\Requests\Formation;

use Illuminate\Foundation\Http\FormRequest;

class ModuleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $moduleId = $this->route('module') ? $this->route('module')->id : null;

        return [
            'titre' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:modules,slug,' . $moduleId,
            'description' => 'required|string',
            'categorie_module_id' => 'required|exists:categories_modules,id',
            'niveau' => 'required|in:debutant,intermediaire,avance,expert',
            'duree_estimee' => 'nullable|integer|min:1',
            'image_couverture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'nullable|boolean'
        ];
    }

    public function messages(): array
    {
        return [
            'titre.required' => 'Le titre du module est requis.',
            'titre.max' => 'Le titre ne doit pas dépasser 255 caractères.',
            'slug.required' => 'Le slug est requis.',
            'slug.unique' => 'Ce slug est déjà utilisé.',
            'description.required' => 'La description est requise.',
            'categorie_module_id.required' => 'La catégorie est requise.',
            'categorie_module_id.exists' => 'La catégorie sélectionnée n\'existe pas.',
            'niveau.required' => 'Le niveau est requis.',
            'niveau.in' => 'Le niveau doit être: debutant, intermediaire, avance ou expert.',
            'duree_estimee.integer' => 'La durée doit être un nombre entier.',
            'duree_estimee.min' => 'La durée doit être d\'au moins 1 heure.',
            'image_couverture.image' => 'Le fichier doit être une image.',
            'image_couverture.mimes' => 'L\'image doit être au format: jpeg, png, jpg, gif.',
            'image_couverture.max' => 'L\'image ne doit pas dépasser 2 Mo.'
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
            $this->merge([
                'is_active' => true
            ]);
        }
    }
}