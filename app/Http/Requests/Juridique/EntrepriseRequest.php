<?php

namespace App\Http\Requests\Juridique;

use Illuminate\Foundation\Http\FormRequest;

class EntrepriseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $entrepriseId = $this->route('entreprise') ? $this->route('entreprise')->id : null;

        return [
            'nom' => 'required|string|max:255',
            'siret' => 'nullable|string|size:14|unique:entreprises,siret,' . $entrepriseId,
            'siren' => 'nullable|string|size:9',
            'ape' => 'nullable|string|size:5',
            'forme_juridique' => 'nullable|string|max:50',
            'capital_social' => 'nullable|string|max:50',
            'adresse' => 'nullable|string|max:255',
            'code_postal' => 'nullable|string|max:10',
            'ville' => 'nullable|string|max:100',
            'pays' => 'nullable|string|max:100',
            'telephone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'site_web' => 'nullable|url|max:255',
            'date_creation' => 'nullable|date',
            'metadatas' => 'nullable|array'
        ];
    }

    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom de l\'entreprise est requis.',
            'siret.size' => 'Le SIRET doit comporter 14 chiffres.',
            'siret.unique' => 'Ce SIRET est déjà utilisé.',
            'siren.size' => 'Le SIREN doit comporter 9 chiffres.',
            'ape.size' => 'Le code APE doit comporter 5 caractères.',
            'email.email' => 'L\'email n\'est pas valide.',
            'site_web.url' => 'L\'URL du site web n\'est pas valide.',
            'date_creation.date' => 'La date de création n\'est pas valide.'
        ];
    }

    protected function prepareForValidation(): void
    {
        // Nettoyer le SIRET (enlever les espaces)
        if ($this->has('siret')) {
            $this->merge([
                'siret' => preg_replace('/\s+/', '', $this->siret)
            ]);
        }

        // Définir la France par défaut
        if (!$this->has('pays')) {
            $this->merge(['pays' => 'France']);
        }
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Vérifier la cohérence SIRET/SIREN
            if ($this->siret && $this->siren) {
                $sirenFromSiret = substr($this->siret, 0, 9);
                if ($sirenFromSiret !== $this->siren) {
                    $validator->errors()->add(
                        'siren', 
                        'Le SIREN doit correspondre aux 9 premiers chiffres du SIRET.'
                    );
                }
            }
        });
    }
}