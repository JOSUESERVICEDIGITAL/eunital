<?php

namespace App\Http\Controllers\Back\RH\Actions;

use App\Http\Controllers\Controller;
use App\Models\RH\CongeRh;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RefuserCongeController extends Controller
{
    public function __invoke(Request $request, CongeRh $congeRh): RedirectResponse
    {
        if ($congeRh->statut === 'refuse') {
            return redirect()
                ->back()
                ->with('info', 'Ce congé est déjà refusé.');
        }

        $congeRh->update([
            'statut' => 'refuse',
            'valide_par' => auth()->id(),
        ]);

        return redirect()
            ->back()
            ->with('success', 'Le congé a été refusé avec succès.');
    }
}