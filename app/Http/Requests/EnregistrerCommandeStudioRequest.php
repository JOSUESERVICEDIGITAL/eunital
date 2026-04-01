<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnregistrerCommandeStudioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'reference' => ['required', 'string', 'max:255'],
            'client_studio_id' => ['required', 'exists:client_studios,id'],
            'montant_total' => ['required', 'numeric', 'min:0'],
            'acompte' => ['nullable', 'numeric', 'min:0'],
            'statut' => ['required', 'in:en_attente,confirmee,en_cours,livree'],
            'date_livraison' => ['nullable', 'date'],
        ];
    }

    public function messages(): array
    {
        return [
            'reference.required' => 'La référence de la commande est obligatoire.',
            'reference.max' => 'La référence ne doit pas dépasser 255 caractères.',

            'client_studio_id.required' => 'Le client est obligatoire.',
            'client_studio_id.exists' => 'Le client sélectionné est invalide.',

            'montant_total.required' => 'Le montant total est obligatoire.',
            'montant_total.numeric' => 'Le montant total doit être un nombre.',
            'montant_total.min' => 'Le montant total ne peut pas être négatif.',

            'acompte.numeric' => 'L’acompte doit être un nombre.',
            'acompte.min' => 'L’acompte ne peut pas être négatif.',

            'statut.required' => 'Le statut est obligatoire.',
            'statut.in' => 'Le statut est invalide.',

            'date_livraison.date' => 'La date de livraison est invalide.',
        ];
    }
}