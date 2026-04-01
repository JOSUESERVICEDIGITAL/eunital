<?php

namespace App\Http\Requests\Juridique;

use Illuminate\Foundation\Http\FormRequest;

class ModeleDocumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $modeleId = $this->route('modele_document') ? $this->route('modele_document')->id : null;

        return [
            'titre' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:modeles_documents,slug,' . $modeleId,
            'description' => 'nullable|string',
            'type_document_id' => 'required|exists:types_documents,id',
            'contenu_html' => 'required|string',
            'contenu_pdf' => 'required|string',
            'variables' => 'nullable|array',
            'champs_requis' => 'nullable|array',
            'version' => 'nullable|string|max:20',
            'is_default' => 'nullable|boolean',
            'is_active' => 'nullable|boolean'
        ];
    }

    public function messages(): array
    {
        return [
            'titre.required' => 'Le titre du modèle est requis.',
            'type_document_id.required' => 'Le type de document est requis.',
            'type_document_id.exists' => 'Le type de document sélectionné n\'existe pas.',
            'contenu_html.required' => 'Le contenu HTML est requis.',
            'contenu_pdf.required' => 'Le contenu PDF est requis.',
            'version.max' => 'La version ne doit pas dépasser 20 caractères.'
        ];
    }

    protected function prepareForValidation(): void
    {
        if (!$this->has('slug') && $this->has('titre')) {
            $this->merge([
                'slug' => \Str::slug($this->titre)
            ]);
        }

        if (!$this->has('version')) {
            $this->merge(['version' => '1.0']);
        }

        if (!$this->has('is_active')) {
            $this->merge(['is_active' => true]);
        }

        if (!$this->has('is_default')) {
            $this->merge(['is_default' => false]);
        }
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Vérifier que les variables mentionnées dans le template existent
            if ($this->variables) {
                $contenu = $this->contenu_html;
                preg_match_all('/{{(.*?)}}/', $contenu, $matches);
                $variablesDansTemplate = array_map('trim', $matches[1]);

                foreach ($variablesDansTemplate as $var) {
                    if (!in_array($var, $this->variables)) {
                        $validator->errors()->add(
                            'variables',
                            "La variable '{$var}' est utilisée dans le template mais n'est pas déclarée."
                        );
                    }
                }
            }
        });
    }
}
