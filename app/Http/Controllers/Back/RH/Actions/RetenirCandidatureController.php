<?php

namespace App\Http\Controllers\Back\RH\Actions;

use App\Http\Controllers\Controller;
use App\Models\RH\Candidature;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RetenirCandidatureController extends Controller
{
    public function __invoke(Request $request, Candidature $candidature): RedirectResponse
    {
        if ($candidature->statut === 'retenu') {
            return redirect()
                ->back()
                ->with('info', 'Cette candidature est déjà retenue.');
        }

        $candidature->update([
            'statut' => 'retenu',
        ]);

        return redirect()
            ->back()
            ->with('success', 'La candidature a été retenue avec succès.');
    }
}