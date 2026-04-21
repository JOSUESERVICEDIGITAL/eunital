<?php

namespace App\Http\Controllers\Back\RH\Actions;

use App\Http\Controllers\Controller;
use App\Models\RH\Recrutement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ArchiverRecrutementController extends Controller
{
    public function __invoke(Request $request, Recrutement $recrutement): RedirectResponse
    {
        if ($recrutement->statut === 'archive') {
            return redirect()
                ->back()
                ->with('info', 'Ce recrutement est déjà archivé.');
        }

        $recrutement->update([
            'statut' => 'archive',
        ]);

        return redirect()
            ->back()
            ->with('success', 'Le recrutement a été archivé avec succès.');
    }
}