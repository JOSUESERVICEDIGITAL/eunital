<?php

namespace App\Http\Requests\Formation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SalleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $salleId = $this->route('salle')?->id;

        return [
            'titre' => ['required', 'string', 'max:255'],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('salles', 'slug')->ignore($salleId),
            ],
            'description' => ['nullable', 'string'],
            'cour_id' => ['nullable', 'exists:cours,id'],
            'module_id' => ['nullable', 'exists:modules,id'],
            'acces_salle_id' => ['nullable', 'exists:acces_salles,id'],
            'type_salle' => ['required', Rule::in(['presentiel', 'distance', 'hybride'])],
            'is_active' => ['nullable', 'boolean'],
            'is_open' => ['nullable', 'boolean'],
            'image_couverture' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'parametres' => ['nullable', 'array'],

            'parametres.chat_active' => ['nullable', 'boolean'],
            'parametres.documents_visibles' => ['nullable', 'boolean'],
            'parametres.videos_visibles' => ['nullable', 'boolean'],
            'parametres.devoirs_visibles' => ['nullable', 'boolean'],
            'parametres.tutoriels_visibles' => ['nullable', 'boolean'],
            'parametres.telechargement_autorise' => ['nullable', 'boolean'],
            'parametres.qr_active' => ['nullable', 'boolean'],
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => $this->boolean('is_active'),
            'is_open' => $this->boolean('is_open'),
        ]);
    }

    public function messages(): array
    {
        return [
            'titre.required' => 'Le titre de la salle est obligatoire.',
            'cour_id.exists' => 'Le cours sélectionné est invalide.',
            'module_id.exists' => 'Le module sélectionné est invalide.',
            'acces_salle_id.exists' => 'Le code d’accès sélectionné est invalide.',
            'type_salle.required' => 'Le type de salle est obligatoire.',
            'type_salle.in' => 'Le type de salle est invalide.',
            'image_couverture.image' => 'Le fichier doit être une image.',
        ];
    }
}
