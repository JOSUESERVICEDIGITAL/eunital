<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnregistrerDiffusionStudioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titre' => ['required', 'string', 'max:255'],
            'evenement_studio_id' => ['nullable', 'exists:evenement_studios,id'],
            'plateforme' => ['required', 'in:youtube,facebook,instagram,tiktok,autre'],
            'type' => ['required', 'in:live,differe,premiere'],
            'url_diffusion' => ['nullable', 'string', 'max:255'],
            'date_diffusion' => ['nullable', 'date'],
            'statut' => ['required', 'in:planifie,en_cours,termine,annule'],
            'vues' => ['nullable', 'integer', 'min:0'],
            'responsable_id' => ['nullable', 'exists:users,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'titre.required' => 'Le titre de la diffusion est obligatoire.',
            'titre.max' => 'Le titre ne doit pas dépasser 255 caractères.',
            'evenement_studio_id.exists' => 'L’événement sélectionné est invalide.',
            'plateforme.required' => 'La plateforme est obligatoire.',
            'plateforme.in' => 'La plateforme sélectionnée est invalide.',
            'type.required' => 'Le type de diffusion est obligatoire.',
            'type.in' => 'Le type de diffusion est invalide.',
            'url_diffusion.max' => 'L’URL de diffusion est trop longue.',
            'date_diffusion.date' => 'La date de diffusion est invalide.',
            'statut.required' => 'Le statut est obligatoire.',
            'statut.in' => 'Le statut est invalide.',
            'vues.integer' => 'Le nombre de vues doit être un entier.',
            'vues.min' => 'Le nombre de vues ne peut pas être négatif.',
            'responsable_id.exists' => 'Le responsable sélectionné est invalide.',
        ];
    }
}