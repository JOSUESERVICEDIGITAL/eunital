<?php

namespace App\Http\Controllers\Back\RH\Actions;

use App\Http\Controllers\Controller;
use App\Models\RH\CongeRh;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AnnulerCongeController extends Controller
{
    public function __invoke(Request $request, CongeRh $congeRh): RedirectResponse
    {
        if ($congeRh->statut === 'annule') {
            return redirect()
                ->back()
                ->with('info', 'Ce congé est déjà annulé.');
        }

        $congeRh->update([
            'statut' => 'annule',
        ]);

        return redirect()
            ->back()
            ->with('success', 'Le congé a été annulé avec succès.');
    }
}