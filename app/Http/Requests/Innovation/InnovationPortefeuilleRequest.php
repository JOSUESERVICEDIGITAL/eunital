<?php

namespace App\Http\Requests\Innovation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InnovationPortefeuilleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('id');

        return [
            'code' => ['nullable', 'string', Rule::unique('innovation_portefeuilles', 'code')->ignore($id)],
            'nom' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],

            'type_portefeuille' => ['required', Rule::in(['national', 'ministeriel', 'regional', 'sectoriel'])],
            'statut' => ['required', Rule::in(['actif', 'suspendu', 'archive'])],

            'responsable_id' => ['nullable', 'exists:users,id'],

            'date_lancement' => ['nullable', 'date'],
            'date_fin_previsionnelle' => ['nullable', 'date', 'after_or_equal:date_lancement'],

            'budget_previsionnel' => ['nullable', 'numeric', 'min:0'],
            'budget_consomme' => ['nullable', 'numeric', 'min:0'],

            'niveau_priorite' => ['required', Rule::in(['faible', 'moyenne', 'haute', 'critique'])],
        ];
    }
}