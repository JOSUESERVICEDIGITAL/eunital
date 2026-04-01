<?php

namespace App\Http\Requests\Juridique;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LitigeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $litigeId = $this->route('litige') ? $this->route('litige')->id : null;

        return [
            'reference' => 'nullable|string|max:100|unique:litiges,reference,' . $litigeId,
            'titre' => 'required|string|max:255',
            'type' => ['required', Rule::in([
                'commercial', 'social', 'civil', 'administratif',
                'penal', 'fiscal', 'propriete_intellectuelle'
            ])],
            'statut' => ['nullable', Rule::in([
                'ouvert', 'instruction', 'mediation', 'arbitrage',
                'judiciaire', 'clos', 'abandonne'
            ])],
            'date_ouverture' => 'required|date',
            'date_cloture' => 'nullable|date|after_or_equal:date_ouverture',
            'montant_en_jeu' => 'nullable|numeric|min:0',
            'parties' => 'nullable|array',
            'parties.*.nom' => 'required|string',
            'parties.*.type' => 'required|in:physique,morale',
            'avocats' => 'nullable|array',
            'description' => 'required|string',
            'pieces_jointes' => 'nullable|array',
            'conclusion' => 'nullable|string',
            'cout_total' => 'nullable|numeric|min:0'
        ];
    }

    public function messages(): array
    {
        return [
            'titre.required' => 'Le titre du litige est requis.',
            'type.required' => 'Le type de litige est requis.',
            'type.in' => 'Le type sélectionné n\'est pas valide.',
            'date_ouverture.required' => 'La date d\'ouverture est requise.',
            'date_cloture.after_or_equal' => 'La date de clôture doit être postérieure ou égale à la date d\'ouverture.',
            'montant_en_jeu.min' => 'Le montant en jeu doit être positif.',
            'description.required' => 'La description est requise.',
            'cout_total.min' => 'Le coût total doit être positif.'
        ];
    }

    protected function prepareForValidation(): void
    {
        if (!$this->has('reference')) {
            $prefix = strtoupper(substr($this->type, 0, 3));
            $year = date('Y');
            $random = strtoupper(substr(uniqid(), -6));
            $this->merge(['reference' => "{$prefix}-{$year}-{$random}"]);
        }

        if (!$this->has('statut')) {
            $this->merge(['statut' => 'ouvert']);
        }
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Si le litige est clos, une date de clôture est obligatoire
            if ($this->statut === 'clos' && !$this->date_cloture) {
                $validator->errors()->add(
                    'date_cloture',
                    'La date de clôture est obligatoire pour un litige clos.'
                );
            }
        });
    }
}
