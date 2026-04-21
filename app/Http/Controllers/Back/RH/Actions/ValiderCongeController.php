<?php

namespace App\Http\Controllers\Back\RH\Actions;

use App\Http\Controllers\Controller;
use App\Models\RH\CongeRh;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ValiderCongeController extends Controller
{
    public function __invoke(CongeRh $congeRh, Request $request): RedirectResponse
    {
        if ($congeRh->statut === 'valide') {
            return redirect()
                ->back()
                ->with('info', 'Ce congé est déjà validé.');
        }

        $congeRh->update([
            'statut' => 'valide',
            'valide_par' => auth()->id(),
        ]);

        return redirect()
            ->back()
            ->with('success', 'Le congé a été validé avec succès.');
    }
}