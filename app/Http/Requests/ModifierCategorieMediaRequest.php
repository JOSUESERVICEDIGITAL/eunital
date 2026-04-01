<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ModifierCategorieMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $categorieMedia = $this->route('categorieMedia');

        return [
            'nom' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories_medias', 'nom')->ignore($categorieMedia?->id),
            ],
            'description' => ['nullable', 'string', 'max:3000'],
            'est_actif' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom de la catégorie média est obligatoire.',
            'nom.unique' => 'Cette catégorie média existe déjà.',
        ];
    }
}