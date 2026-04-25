<?php

namespace App\Http\Requests\Innovation;

use Illuminate\Foundation\Http\FormRequest;

class ExperimentationSiteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'experimentation_id' => ['required', 'exists:experimentations,id'],
            'nom_site' => ['required', 'string', 'max:255'],
            'region_id' => ['nullable', 'integer'],
            'province_id' => ['nullable', 'integer'],
            'commune_id' => ['nullable', 'integer'],
            'responsable_local' => ['nullable', 'string', 'max:255'],
            'contact_local' => ['nullable', 'string', 'max:255'],
        ];
    }
}
