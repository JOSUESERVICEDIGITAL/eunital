<?php

namespace App\Http\Controllers\Back\RH\Actions;

use App\Http\Controllers\Controller;
use App\Models\RH\Recrutement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OuvrirRecrutementController extends Controller
{
    public function __invoke(Request $request, Recrutement $recrutement): RedirectResponse
    {
        if ($recrutement->statut === 'ouvert') {
            return redirect()
                ->back()
                ->with('info', 'Ce recrutement est déjà ouvert.');
        }

        $recrutement->update([
            'statut' => 'ouvert',
            'date_ouverture' => $recrutement->date_ouverture ?? now()->toDateString(),
        ]);

        return redirect()
            ->back()
            ->with('success', 'Le recrutement a été ouvert avec succès.');
    }
}