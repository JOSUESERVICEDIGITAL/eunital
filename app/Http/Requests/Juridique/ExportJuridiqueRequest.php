<?php

namespace App\Http\Requests\Juridique;

use Illuminate\Foundation\Http\FormRequest;

class ExportJuridiqueRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => 'required|in:documents,contrats,litiges,legalites,conseils,conformites,tous',
            'format' => 'required|in:excel,pdf,csv',
            'date_debut' => 'nullable|date',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',
            'statut' => 'nullable|string',
            'categorie' => 'nullable|string',
            'champs' => 'nullable|array',
            'champs.*' => 'string',
            'filtres' => 'nullable|array'
        ];
    }

    public function messages(): array
    {
        return [
            'type.required' => 'Le type d\'export est requis.',
            'type.in' => 'Le type d\'export doit être: documents, contrats, litiges, legalites, conseils, conformites ou tous.',
            'format.required' => 'Le format d\'export est requis.',
            'format.in' => 'Le format doit être excel, pdf ou csv.',
            'date_fin.after_or_equal' => 'La date de fin doit être postérieure ou égale à la date de début.'
        ];
    }

    protected function prepareForValidation(): void
    {
        // Si pas de date début, prendre le début du mois
        if (!$this->has('date_debut')) {
            $this->merge(['date_debut' => now()->startOfMonth()]);
        }

        // Si pas de date fin, prendre aujourd'hui
        if (!$this->has('date_fin')) {
            $this->merge(['date_fin' => now()]);
        }

        // Champs par défaut si non spécifiés
        if (!$this->has('champs')) {
            $defaultChamps = [
                'documents' => ['id', 'numero_unique', 'titre', 'statut', 'created_at'],
                'contrats' => ['id', 'reference', 'type_contrat', 'montant', 'date_debut', 'date_fin'],
                'litiges' => ['id', 'reference', 'titre', 'type', 'statut', 'montant_en_jeu'],
                'legalites' => ['id', 'titre', 'type', 'reference', 'date_publication', 'est_en_vigueur'],
                'conseils' => ['id', 'titre', 'categorie', 'vues', 'is_published'],
                'conformites' => ['id', 'statut', 'score_conformite', 'date_controle']
            ];

            $type = $this->type === 'tous' ? 'documents' : $this->type;
            $this->merge(['champs' => $defaultChamps[$type] ?? ['id', 'titre', 'created_at']]);
        }
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Vérifier que la période n'est pas trop grande
            $debut = \Carbon\Carbon::parse($this->date_debut);
            $fin = \Carbon\Carbon::parse($this->date_fin);
            $diff = $debut->diffInDays($fin);

            if ($diff > 365) {
                $validator->errors()->add(
                    'date_fin',
                    'La période d\'export ne peut pas dépasser 365 jours.'
                );
            }
        });
    }
}
