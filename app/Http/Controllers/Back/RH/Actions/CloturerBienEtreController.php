<?php

namespace App\Http\Controllers\Back\RH\Actions;

use App\Http\Controllers\Controller;
use App\Models\RH\BienEtreTravail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CloturerBienEtreController extends Controller
{
    public function __invoke(Request $request, BienEtreTravail $bienEtreTravail): RedirectResponse
    {
        $data = $request->validate([
            'statut' => ['nullable', Rule::in(['traite', 'archive'])],
        ]);

        $nouveauStatut = $data['statut'] ?? 'traite';

        if ($bienEtreTravail->statut === $nouveauStatut) {
            return redirect()
                ->back()
                ->with('info', 'Ce dossier bien-être a déjà ce statut.');
        }

        $bienEtreTravail->update([
            'statut' => $nouveauStatut,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Le dossier bien-être a été clôturé avec succès.');
    }
}