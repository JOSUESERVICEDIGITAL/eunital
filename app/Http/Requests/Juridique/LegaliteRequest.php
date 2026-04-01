<?php

namespace App\Http\Requests\Juridique;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LegaliteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $legaliteId = $this->route('legalite') ? $this->route('legalite')->id : null;

        return [
            'titre' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:legalites,slug,' . $legaliteId,
            'type' => ['required', Rule::in([
                'loi', 'decret', 'arrete', 'circulaire', 'directive',
                'reglement', 'norme', 'standard', 'jurisprudence'
            ])],
            'reference' => 'nullable|string|max:100',
            'date_publication' => 'nullable|date',
            'date_application' => 'nullable|date',
            'resume' => 'required|string',
            'contenu_complet' => 'nullable|string',
            'articles' => 'nullable|array',
            'champs_application' => 'nullable|array',
            'exceptions' => 'nullable|array',
            'sanctions' => 'nullable|array',
            'obligations' => 'nullable|array',
            'url_officielle' => 'nullable|url',
            'est_en_vigueur' => 'nullable|boolean'
        ];
    }

    public function messages(): array
    {
        return [
            'titre.required' => 'Le titre du texte légal est requis.',
            'type.required' => 'Le type de texte est requis.',
            'type.in' => 'Le type sélectionné n\'est pas valide.',
            'resume.required' => 'Le résumé est requis.',
            'url_officielle.url' => 'L\'URL officielle doit être une URL valide.',
            'date_publication.date' => 'La date de publication n\'est pas valide.',
            'date_application.date' => 'La date d\'application n\'est pas valide.'
        ];
    }

    protected function prepareForValidation(): void
    {
        if (!$this->has('slug') && $this->has('titre')) {
            $this->merge([
                'slug' => \Str::slug($this->titre)
            ]);
        }

        if (!$this->has('est_en_vigueur')) {
            $this->merge(['est_en_vigueur' => true]);
        }

        // Si date_application non fournie, utiliser date_publication
        if (!$this->has('date_application') && $this->has('date_publication')) {
            $this->merge(['date_application' => $this->date_publication]);
        }
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Vérifier que la date d'application n'est pas antérieure à la publication
            if ($this->date_application && $this->date_publication &&
                $this->date_application < $this->date_publication) {
                $validator->errors()->add(
                    'date_application',
                    'La date d\'application ne peut pas être antérieure à la date de publication.'
                );
            }
        });
    }
}
