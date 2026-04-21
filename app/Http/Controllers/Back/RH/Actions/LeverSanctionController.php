<?php

namespace App\Http\Controllers\Back\RH\Actions;

use App\Http\Controllers\Controller;
use App\Models\RH\SanctionDisciplinaire;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LeverSanctionController extends Controller
{
    public function __invoke(Request $request, SanctionDisciplinaire $sanctionDisciplinaire): RedirectResponse
    {
        if ($sanctionDisciplinaire->statut === 'levee') {
            return redirect()
                ->back()
                ->with('info', 'Cette sanction est déjà levée.');
        }

        $sanctionDisciplinaire->update([
            'statut' => 'levee',
        ]);

        return redirect()
            ->back()
            ->with('success', 'La sanction a été levée avec succès.');
    }
}