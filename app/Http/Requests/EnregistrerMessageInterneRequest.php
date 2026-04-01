<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnregistrerMessageInterneRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'expediteur_id' => ['required', 'exists:membres_equipe,id'],
            'destinataire_id' => ['nullable', 'exists:membres_equipe,id'],
            'departement_id' => ['nullable', 'exists:departements,id'],
            'sujet' => ['required', 'string', 'max:255'],
            'contenu' => ['required', 'string', 'max:10000'],
            'type_message' => ['required', 'in:direct,annonce,service'],
            'est_lu' => ['nullable', 'boolean'],
            'date_envoi' => ['nullable', 'date'],
        ];
    }

    public function messages(): array
    {
        return [
            'expediteur_id.required' => 'L’expéditeur est obligatoire.',
            'expediteur_id.exists' => 'L’expéditeur sélectionné est invalide.',
            'destinataire_id.exists' => 'Le destinataire sélectionné est invalide.',
            'departement_id.exists' => 'Le département sélectionné est invalide.',
            'sujet.required' => 'Le sujet du message est obligatoire.',
            'contenu.required' => 'Le contenu du message est obligatoire.',
            'type_message.required' => 'Le type de message est obligatoire.',
            'type_message.in' => 'Le type de message sélectionné est invalide.',
        ];
    }
}
