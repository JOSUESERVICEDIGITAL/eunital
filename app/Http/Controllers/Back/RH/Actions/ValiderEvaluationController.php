<?php

namespace App\Http\Controllers\Back\RH\Actions;

use App\Http\Controllers\Controller;
use App\Models\RH\EvaluationRh;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ValiderEvaluationController extends Controller
{
    public function __invoke(Request $request, EvaluationRh $evaluationRh): RedirectResponse
    {
        if ($evaluationRh->statut === 'validee') {
            return redirect()
                ->back()
                ->with('info', 'Cette évaluation est déjà validée.');
        }

        $evaluationRh->update([
            'statut' => 'validee',
        ]);

        return redirect()
            ->back()
            ->with('success', 'L’évaluation a été validée avec succès.');
    }
}