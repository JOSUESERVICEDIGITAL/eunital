<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnregistrerMontageStudioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titre' => ['required', 'string', 'max:255'],
            'production_video_id' => ['nullable', 'exists:production_videos,id'],
            'statut' => ['required', 'in:brouillon,en_cours,valide,livre'],
            'notes' => ['nullable', 'string'],
            'fichier_final' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'titre.required' => 'Le titre du montage est obligatoire.',
            'titre.max' => 'Le titre ne doit pas dépasser 255 caractères.',
            'production_video_id.exists' => 'La production vidéo sélectionnée est invalide.',
            'statut.required' => 'Le statut du montage est obligatoire.',
            'statut.in' => 'Le statut du montage est invalide.',
            'fichier_final.max' => 'Le nom du fichier final est trop long.',
        ];
    }
}