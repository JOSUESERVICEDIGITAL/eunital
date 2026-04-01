<?php

namespace App\Http\Controllers\Back\ChambreGraphisme;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAfficheFlyerRequest;
use App\Http\Requests\UpdateAfficheFlyerRequest;
use App\Models\AfficheFlyer;
use App\Models\ClientStudio;

class AfficheFlyerController extends Controller
{
    public function listeToutes()
    {
        $affiches = AfficheFlyer::with('client')->latest()->paginate(12);
        return view('back.chambre-graphisme.affiches-flyers.liste', compact('affiches'));
    }

    public function listeAffiches()
    {
        $affiches = AfficheFlyer::with('client')
            ->where('type', 'affiche')
            ->latest()
            ->paginate(12);

        return view('back.chambre-graphisme.affiches-flyers.affiches', compact('affiches'));
    }

    public function listeFlyers()
    {
        $affiches = AfficheFlyer::with('client')
            ->where('type', 'flyer')
            ->latest()
            ->paginate(12);

        return view('back.chambre-graphisme.affiches-flyers.flyers', compact('affiches'));
    }

    public function listeLivres()
    {
        $affiches = AfficheFlyer::with('client')
            ->where('statut', 'livre')
            ->latest()
            ->paginate(12);

        return view('back.chambre-graphisme.affiches-flyers.livres', compact('affiches'));
    }

    public function formulaireCreation()
    {
        $clients = ClientStudio::orderBy('nom')->get();
        return view('back.chambre-graphisme.affiches-flyers.creer', compact('clients'));
    }

    public function enregistrer(StoreAfficheFlyerRequest $request)
    {
        $affiche = AfficheFlyer::create($request->validated());

        return redirect()
            ->route('back.chambre-graphisme.affiches.details', $affiche)
            ->with('success', 'Affiche/Flyer créé avec succès.');
    }

    public function details(AfficheFlyer $afficheFlyer)
    {
        $afficheFlyer->load('client');

        return view('back.chambre-graphisme.affiches-flyers.details', [
            'affiche' => $afficheFlyer
        ]);
    }

    public function formulaireEdition(AfficheFlyer $afficheFlyer)
    {
        $clients = ClientStudio::orderBy('nom')->get();

        return view('back.chambre-graphisme.affiches-flyers.modifier', [
            'affiche' => $afficheFlyer,
            'clients' => $clients,
        ]);
    }

    public function mettreAJour(UpdateAfficheFlyerRequest $request, AfficheFlyer $afficheFlyer)
    {
        $afficheFlyer->update($request->validated());

        return redirect()
            ->route('back.chambre-graphisme.affiches.details', $afficheFlyer)
            ->with('success', 'Affiche/Flyer mis à jour.');
    }

    public function livrer(AfficheFlyer $afficheFlyer)
    {
        $afficheFlyer->update(['statut' => 'livre']);

        return back()->with('success', 'Affiche/Flyer marqué comme livré.');
    }

    public function supprimer(AfficheFlyer $afficheFlyer)
    {
        $afficheFlyer->delete();

        return redirect()
            ->route('back.chambre-graphisme.affiches.toutes')
            ->with('success', 'Affiche/Flyer supprimé.');
    }
}
