<?php

namespace App\Http\Requests\RH;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PresenceRhRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'observation' => $this->filled('observation') ? trim((string) $this->input('observation')) : null,
        ]);
    }

    public function rules(): array
    {
        return [
            'membre_equipe_id' => ['required', 'exists:membres_equipe,id'],
            'date_presence' => ['required', 'date'],
            'heure_arrivee' => ['nullable', 'date_format:H:i'],
            'heure_depart' => ['nullable', 'date_format:H:i', 'after:heure_arrivee'],
            'statut' => ['required', Rule::in(['present', 'absent', 'retard', 'mission', 'teletravail', 'conge'])],
            'observation' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'membre_equipe_id.required' => 'Le membre de l’équipe est obligatoire.',
            'membre_equipe_id.exists' => 'Le membre sélectionné est invalide.',
            'date_presence.required' => 'La date de présence est obligatoire.',
            'heure_arrivee.date_format' => 'L’heure d’arrivée doit être au format HH:MM.',
            'heure_depart.date_format' => 'L’heure de départ doit être au format HH:MM.',
            'heure_depart.after' => 'L’heure de départ doit être après l’heure d’arrivée.',
            'statut.required' => 'Le statut de présence est obligatoire.',
            'statut.in' => 'Le statut de présence est invalide.',
        ];
    }
}