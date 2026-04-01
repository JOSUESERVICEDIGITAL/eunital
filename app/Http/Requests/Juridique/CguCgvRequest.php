<?php

namespace App\Http\Requests\Juridique;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CguCgvRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $cguId = $this->route('cgu_cgv') ? $this->route('cgu_cgv')->id : null;

        return [
            'titre' => 'required|string|max:255',
            'type' => ['required', Rule::in(['cgu', 'cgv'])],
            'contenu' => 'required|string',
            'version' => 'required|string|max:20',
            'date_effet' => 'required|date',
            'date_fin' => 'nullable|date|after:date_effet',
            'articles' => 'nullable|array',
            'annexes' => 'nullable|array',
            'is_active' => 'nullable|boolean'
        ];
    }

    public function messages(): array
    {
        return [
            'titre.required' => 'Le titre est requis.',
            'type.required' => 'Le type est requis.',
            'type.in' => 'Le type doit être cgu ou cgv.',
            'contenu.required' => 'Le contenu est requis.',
            'version.required' => 'La version est requise.',
            'date_effet.required' => 'La date d\'effet est requise.',
            'date_fin.after' => 'La date de fin doit être postérieure à la date d\'effet.'
        ];
    }

    protected function prepareForValidation(): void
    {
        if (!$this->has('is_active')) {
            $this->merge(['is_active' => true]);
        }
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Vérifier qu'il n'y a pas de version active en conflit
            if ($this->is_active && $this->type) {
                $activeExists = \App\Models\Juridique\CguCgv::where('type', $this->type)
                    ->where('is_active', true)
                    ->where('id', '!=', $this->route('cgu_cgv') ? $this->route('cgu_cgv')->id : null)
                    ->exists();

                if ($activeExists) {
                    $validator->errors()->add(
                        'is_active',
                        'Il existe déjà une version active des ' . ($this->type === 'cgu' ? 'CGU' : 'CGV') . '.'
                    );
                }
            }
        });
    }
}
