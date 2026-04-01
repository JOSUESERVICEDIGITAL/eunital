<?php

namespace App\Http\Requests\Formation;

use Illuminate\Foundation\Http\FormRequest;

class ContenuRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'titre' => 'required|string|max:255',
            'type' => 'required|in:video,document,image,audio,quiz,exercice,tutoriel',
            'contenu' => 'required_if:type,quiz,exercice,tutoriel|nullable|string',
            'chapitre_id' => 'required|exists:chapitres,id',
            'ordre' => 'nullable|integer|min:0',
            'telechargeable' => 'nullable|boolean',
            'is_visible' => 'nullable|boolean'
        ];

        // Règles selon le type de contenu
        if ($this->type === 'video' || $this->type === 'document' || $this->type === 'image' || $this->type === 'audio') {
            $rules['fichier'] = 'required|file|max:102400'; // 100 Mo max
            $rules['type_fichier'] = 'nullable|string';
            $rules['taille_fichier'] = 'nullable|integer';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'titre.required' => 'Le titre du contenu est requis.',
            'titre.max' => 'Le titre ne doit pas dépasser 255 caractères.',
            'type.required' => 'Le type de contenu est requis.',
            'type.in' => 'Le type doit être: video, document, image, audio, quiz, exercice ou tutoriel.',
            'contenu.required_if' => 'Le contenu est requis pour ce type.',
            'chapitre_id.required' => 'Le chapitre est requis.',
            'chapitre_id.exists' => 'Le chapitre sélectionné n\'existe pas.',
            'fichier.required' => 'Le fichier est requis.',
            'fichier.file' => 'Le fichier doit être un fichier valide.',
            'fichier.max' => 'Le fichier ne doit pas dépasser 100 Mo.',
            'ordre.integer' => 'L\'ordre doit être un nombre entier.',
            'ordre.min' => 'L\'ordre doit être supérieur ou égal à 0.'
        ];
    }

    protected function prepareForValidation(): void
    {
        if (!$this->has('ordre')) {
            $this->merge([
                'ordre' => 0
            ]);
        }

        if (!$this->has('telechargeable')) {
            $this->merge([
                'telechargeable' => false
            ]);
        }

        if (!$this->has('is_visible')) {
            $this->merge([
                'is_visible' => true
            ]);
        }
    }
}