<?php

namespace App\Http\Requests\Juridique;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SignatureRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $signatureId = $this->route('signature') ? $this->route('signature')->id : null;

        return [
            'document_id' => 'required|exists:documents,id',
            'user_id' => 'required|exists:users,id',
            'type_signataire' => ['required', Rule::in(['signataire', 'temoin', 'representant', 'garant'])],
            'ordre' => 'nullable|integer|min:0',
            'statut' => ['nullable', Rule::in(['en_attente', 'signe', 'refuse', 'expire'])],
            'email' => 'nullable|email',
            'nom_complet' => 'nullable|string|max:255',
            'fonction' => 'nullable|string|max:255',
            'signature_base64' => 'nullable|string',
            'certificat_digital' => 'nullable|string',
            'date_signature' => 'nullable|date',
            'commentaire' => 'nullable|string',
            'metadatas' => 'nullable|array'
        ];
    }

    public function messages(): array
    {
        return [
            'document_id.required' => 'Le document est requis.',
            'document_id.exists' => 'Le document sélectionné n\'existe pas.',
            'user_id.required' => 'L\'utilisateur est requis.',
            'user_id.exists' => 'L\'utilisateur sélectionné n\'existe pas.',
            'type_signataire.required' => 'Le type de signataire est requis.',
            'type_signataire.in' => 'Le type de signataire doit être: signataire, temoin, representant ou garant.',
            'ordre.min' => 'L\'ordre doit être supérieur ou égal à 0.',
            'email.email' => 'L\'email n\'est pas valide.',
            'date_signature.date' => 'La date de signature n\'est pas valide.'
        ];
    }

    protected function prepareForValidation(): void
    {
        if (!$this->has('ordre')) {
            $maxOrdre = \App\Models\Juridique\Signature::where('document_id', $this->document_id)
                ->max('ordre') ?? -1;
            $this->merge(['ordre' => $maxOrdre + 1]);
        }

        if (!$this->has('statut')) {
            $this->merge(['statut' => 'en_attente']);
        }
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Vérifier qu'un utilisateur ne signe pas deux fois le même document
            if ($this->user_id && $this->document_id) {
                $existe = \App\Models\Juridique\Signature::where('document_id', $this->document_id)
                    ->where('user_id', $this->user_id)
                    ->where('id', '!=', $this->route('signature') ? $this->route('signature')->id : null)
                    ->exists();

                if ($existe) {
                    $validator->errors()->add(
                        'user_id',
                        'Cet utilisateur a déjà une signature pour ce document.'
                    );
                }
            }
        });
    }
}
