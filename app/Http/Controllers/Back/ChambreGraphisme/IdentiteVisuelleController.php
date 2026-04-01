<?php

namespace App\Http\Controllers\Back\ChambreGraphisme;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreIdentiteVisuelleRequest;
use App\Http\Requests\UpdateIdentiteVisuelleRequest;
use App\Models\ClientStudio;
use App\Models\IdentiteVisuelle;

class IdentiteVisuelleController extends Controller
{
    public function listeToutes()
    {
        $identites = IdentiteVisuelle::with('client')->latest()->paginate(12);
        return view('back.chambre-graphisme.identites-visuelles.liste', compact('identites'));
    }

    public function listeCreations()
    {
        $identites = IdentiteVisuelle::with('client')
            ->where('statut', 'creation')
            ->latest()
            ->paginate(12);

        return view('back.chambre-graphisme.identites-visuelles.creations', compact('identites'));
    }

    public function listeValidations()
    {
        $identites = IdentiteVisuelle::with('client')
            ->where('statut', 'validation')
            ->latest()
            ->paginate(12);

        return view('back.chambre-graphisme.identites-visuelles.validations', compact('identites'));
    }

    public function listeTerminees()
    {
        $identites = IdentiteVisuelle::with('client')
            ->where('statut', 'termine')
            ->latest()
            ->paginate(12);

        return view('back.chambre-graphisme.identites-visuelles.terminees', compact('identites'));
    }

    public function formulaireCreation()
    {
        $clients = ClientStudio::orderBy('nom')->get();
        return view('back.chambre-graphisme.identites-visuelles.creer', compact('clients'));
    }

    public function enregistrer(StoreIdentiteVisuelleRequest $request)
    {
        $identite = IdentiteVisuelle::create($request->validated());

        return redirect()
            ->route('back.chambre-graphisme.identites.details', $identite)
            ->with('success', 'Identité visuelle créée avec succès.');
    }

    public function details(IdentiteVisuelle $identiteVisuelle)
    {
        $identiteVisuelle->load('client');

        return view('back.chambre-graphisme.identites-visuelles.details', [
            'identite' => $identiteVisuelle
        ]);
    }

    public function formulaireEdition(IdentiteVisuelle $identiteVisuelle)
    {
        $clients = ClientStudio::orderBy('nom')->get();

        return view('back.chambre-graphisme.identites-visuelles.modifier', [
            'identite' => $identiteVisuelle,
            'clients' => $clients,
        ]);
    }

    public function mettreAJour(UpdateIdentiteVisuelleRequest $request, IdentiteVisuelle $identiteVisuelle)
    {
        $identiteVisuelle->update($request->validated());

        return redirect()
            ->route('back.chambre-graphisme.identites.details', $identiteVisuelle)
            ->with('success', 'Identité visuelle mise à jour.');
    }

    public function valider(IdentiteVisuelle $identiteVisuelle)
    {
        $identiteVisuelle->update(['statut' => 'validation']);

        return back()->with('success', 'Identité visuelle envoyée en validation.');
    }

    public function terminer(IdentiteVisuelle $identiteVisuelle)
    {
        $identiteVisuelle->update(['statut' => 'termine']);

        return back()->with('success', 'Identité visuelle marquée terminée.');
    }

    public function supprimer(IdentiteVisuelle $identiteVisuelle)
    {
        $identiteVisuelle->delete();

        return redirect()
            ->route('back.chambre-graphisme.identites.toutes')
            ->with('success', 'Identité visuelle supprimée.');
    }
}
