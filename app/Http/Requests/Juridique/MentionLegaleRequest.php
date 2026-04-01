<?php

namespace App\Http\Requests\Juridique;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MentionLegaleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $mentionId = $this->route('mention_legale') ? $this->route('mention_legale')->id : null;

        return [
            'titre' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:mentions_legales,slug,' . $mentionId,
            'contenu' => 'required|string',
            'type' => ['required', Rule::in([
                'mentions_legales', 'politique_confidentialite', 'cgu', 'cgv',
                'politique_cookies', 'charte_utilisation', 'conditions_vente'
            ])],
            'version' => 'required|string|max:20',
            'date_effet' => 'required|date',
            'date_fin' => 'nullable|date|after:date_effet',
            'is_active' => 'nullable|boolean',
            'metadatas' => 'nullable|array'
        ];
    }

    public function messages(): array
    {
        return [
            'titre.required' => 'Le titre est requis.',
            'contenu.required' => 'Le contenu est requis.',
            'type.required' => 'Le type est requis.',
            'type.in' => 'Le type sélectionné n\'est pas valide.',
            'version.required' => 'La version est requise.',
            'date_effet.required' => 'La date d\'effet est requise.',
            'date_fin.after' => 'La date de fin doit être postérieure à la date d\'effet.'
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

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Vérifier qu'il n'y a pas de version active en conflit
            if ($this->is_active && $this->type) {
                $activeExists = \App\Models\Juridique\MentionLegale::where('type', $this->type)
                    ->where('is_active', true)
                    ->where('id', '!=', $this->route('mention_legale') ? $this->route('mention_legale')->id : null)
                    ->exists();

                if ($activeExists) {
                    $validator->errors()->add(
                        'is_active',
                        'Il existe déjà une version active de ce type de mention légale.'
                    );
                }
            }
        });
    }
}
