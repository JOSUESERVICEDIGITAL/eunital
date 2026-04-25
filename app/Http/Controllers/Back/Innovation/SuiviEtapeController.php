<?php

namespace App\Http\Controllers\Back\Innovation;

use App\Http\Controllers\Controller;
use App\Models\Innovation\SuiviEtape;

class SuiviEtapeController extends Controller
{
    public function index()
    {
        $etapes = SuiviEtape::with('suivi')->paginate(15);

        return view('back.innovations.suivi-etapes.index', compact('etapes'));
    }

    public function terminer(SuiviEtape $etape)
    {
        $etape->update(['statut' => 'termine']);

        return back()->with('success', 'Étape terminée');
    }
}
