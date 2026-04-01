<?php

namespace App\Http\Requests\Formation;

use Illuminate\Foundation\Http\FormRequest;

class CourRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $courId = $this->route('cour') ? $this->route('cour')->id : null;

        return [
            'titre' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:cours,slug,' . $courId,
            'description' => 'required|string',
            'objectifs' => 'nullable|string',
            'pre_requis' => 'nullable|string',
            'module_id' => 'required|exists:modules,id',
            'ordre' => 'nullable|integer|min:0',
            'niveau_difficulte' => 'required|in:debutant,intermediaire,avance,expert',
            'duree_estimee' => 'nullable|integer|min:1',
            'image_couverture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video_intro' => 'nullable|url',
            'is_published' => 'nullable|boolean',
            'is_visible' => 'nullable|boolean',
            'commentable' => 'nullable|boolean',
            'published_at' => 'nullable|date',
            'enseignants' => 'nullable|array',
            'enseignants.*' => 'exists:users,id'
        ];
    }

    public function messages(): array
    {
        return [
            'titre.required' => 'Le titre du cours est requis.',
            'titre.max' => 'Le titre ne doit pas dépasser 255 caractères.',
            'slug.required' => 'Le slug est requis.',
            'slug.unique' => 'Ce slug est déjà utilisé.',
            'description.required' => 'La description est requise.',
            'module_id.required' => 'Le module est requis.',
            'module_id.exists' => 'Le module sélectionné n\'existe pas.',
            'niveau_difficulte.required' => 'Le niveau de difficulté est requis.',
            'niveau_difficulte.in' => 'Le niveau doit être: debutant, intermediaire, avance ou expert.',
            'duree_estimee.integer' => 'La durée doit être un nombre entier.',
            'duree_estimee.min' => 'La durée doit être d\'au moins 1 minute.',
            'video_intro.url' => 'La vidéo d\'introduction doit être une URL valide.',
            'enseignants.array' => 'Les enseignants doivent être un tableau.',
            'enseignants.*.exists' => 'Un ou plusieurs enseignants n\'existent pas.'
        ];
    }

    protected function prepareForValidation(): void
    {
        if (!$this->has('slug') && $this->has('titre')) {
            $this->merge([
                'slug' => \Str::slug($this->titre)
            ]);
        }

        if (!$this->has('ordre')) {
            $this->merge([
                'ordre' => 0
            ]);
        }

        if ($this->is_published && !$this->published_at) {
            $this->merge([
                'published_at' => now()
            ]);
        }
    }
}