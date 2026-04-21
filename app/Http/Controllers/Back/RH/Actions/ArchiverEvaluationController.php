<?php

namespace App\Http\Controllers\Back\RH\Actions;

use App\Http\Controllers\Controller;
use App\Models\RH\EvaluationRh;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ArchiverEvaluationController extends Controller
{
    public function __invoke(Request $request, EvaluationRh $evaluationRh): RedirectResponse
    {
        if ($evaluationRh->statut === 'archivee') {
            return redirect()
                ->back()
                ->with('info', 'Cette évaluation est déjà archivée.');
        }

        $evaluationRh->update([
            'statut' => 'archivee',
        ]);

        return redirect()
            ->back()
            ->with('success', 'L’évaluation a été archivée avec succès.');
    }
}