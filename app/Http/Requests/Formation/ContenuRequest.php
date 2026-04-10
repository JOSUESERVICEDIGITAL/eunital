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
        return [
            'titre' => 'required|string|max:255',
            'type' => 'required|in:video,tutoriel,document,image,audio,quiz,exercice',
            'chapitre_id' => 'required|exists:chapitres,id',
            'ordre' => 'nullable|integer|min:0',
            'contenu' => 'nullable|string',
            'telechargeable' => 'nullable|boolean',
            'is_visible' => 'nullable|boolean',
            'storage_type' => 'nullable|in:local,google_drive',
            'video_url' => 'nullable|url',
            'duree_video' => 'nullable|integer|min:0',
            'fichier' => 'nullable|file|max:1024000' // 1000 Mo en KB (1000 * 1024)
        ];
    }

    public function messages(): array
    {
        return [
            'titre.required' => 'Le titre du contenu est requis.',
            'type.required' => 'Le type de contenu est requis.',
            'chapitre_id.required' => 'Le chapitre est requis.',
            'fichier.max' => 'Le fichier ne doit pas dépasser 1000 Mo (1 Go).',
        ];
    }
}
