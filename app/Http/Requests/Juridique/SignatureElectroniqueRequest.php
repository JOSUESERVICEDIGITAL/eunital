<?php

namespace App\Http\Requests\Juridique;

use Illuminate\Foundation\Http\FormRequest;

class SignatureElectroniqueRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'signature_id' => 'required|exists:signatures,id',
            'signature_base64' => 'required|string',
            'certificat_digital' => 'nullable|string',
            'ip' => 'nullable|ip',
            'commentaire' => 'nullable|string'
        ];
    }

    public function messages(): array
    {
        return [
            'signature_id.required' => 'La signature est requise.',
            'signature_id.exists' => 'La signature sélectionnée n\'existe pas.',
            'signature_base64.required' => 'La signature est requise.',
            'ip.ip' => 'L\'adresse IP n\'est pas valide.'
        ];
    }

    protected function prepareForValidation(): void
    {
        if (!$this->has('ip')) {
            $this->merge(['ip' => $this->ip()]);
        }
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Vérifier que la signature n'a pas déjà été signée
            $signature = \App\Models\Juridique\Signature::find($this->signature_id);
            if ($signature && $signature->statut === 'signe') {
                $validator->errors()->add(
                    'signature_id',
                    'Cette signature a déjà été apposée.'
                );
            }

            // Vérifier que le document est toujours valide
            if ($signature && $signature->document && $signature->document->statut !== 'signature_attendue') {
                $validator->errors()->add(
                    'signature_id',
                    'Ce document n\'est pas en attente de signature.'
                );
            }
        });
    }
}
