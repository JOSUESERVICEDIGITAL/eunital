<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnregistrerHabillageSonoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titre' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:jingle,intro,outro,voice_over'],
            'fichier_audio' => ['nullable', 'string', 'max:255'],
            'statut' => ['required', 'in:creation,validation,livre'],
        ];
    }

    public function messages(): array
    {
        return [
            'titre.required' => 'Le titre de l’habillage sonore est obligatoire.',
            'titre.max' => 'Le titre ne doit pas dépasser 255 caractères.',
            'type.required' => 'Le type d’habillage sonore est obligatoire.',
            'type.in' => 'Le type d’habillage sonore est invalide.',
            'fichier_audio.max' => 'Le nom du fichier audio est trop long.',
            'statut.required' => 'Le statut est obligatoire.',
            'statut.in' => 'Le statut est invalide.',
        ];
    }
}