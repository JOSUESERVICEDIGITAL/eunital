<?php

namespace App\Http\Controllers\Back\RH\Actions;

use App\Http\Controllers\Controller;
use App\Models\RH\Recrutement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FermerRecrutementController extends Controller
{
    public function __invoke(Request $request, Recrutement $recrutement): RedirectResponse
    {
        if ($recrutement->statut === 'ferme') {
            return redirect()
                ->back()
                ->with('info', 'Ce recrutement est déjà fermé.');
        }

        $recrutement->update([
            'statut' => 'ferme',
            'date_cloture' => now()->toDateString(),
        ]);

        return redirect()
            ->back()
            ->with('success', 'Le recrutement a été fermé avec succès.');
    }
}