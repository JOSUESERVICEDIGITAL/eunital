<?php

namespace App\Http\Controllers\Back\RH\Actions;

use App\Http\Controllers\Controller;
use App\Models\RH\Candidature;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ChangerStatutCandidatureController extends Controller
{
    public function __invoke(Request $request, Candidature $candidature): RedirectResponse
    {
        $data = $request->validate([
            'statut' => ['required', Rule::in(['recu', 'en_etude', 'entretien', 'retenu', 'rejete'])],
        ]);

        if ($candidature->statut === $data['statut']) {
            return redirect()
                ->back()
                ->with('info', 'La candidature a déjà ce statut.');
        }

        $candidature->update([
            'statut' => $data['statut'],
        ]);

        return redirect()
            ->back()
            ->with('success', 'Le statut de la candidature a été mis à jour avec succès.');
    }
}