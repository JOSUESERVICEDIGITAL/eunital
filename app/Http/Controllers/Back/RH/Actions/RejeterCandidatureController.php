<?php

namespace App\Http\Controllers\Back\RH\Actions;

use App\Http\Controllers\Controller;
use App\Models\RH\Candidature;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RejeterCandidatureController extends Controller
{
    public function __invoke(Request $request, Candidature $candidature): RedirectResponse
    {
        if ($candidature->statut === 'rejete') {
            return redirect()
                ->back()
                ->with('info', 'Cette candidature est déjà rejetée.');
        }

        $candidature->update([
            'statut' => 'rejete',
        ]);

        return redirect()
            ->back()
            ->with('success', 'La candidature a été rejetée avec succès.');
    }
}