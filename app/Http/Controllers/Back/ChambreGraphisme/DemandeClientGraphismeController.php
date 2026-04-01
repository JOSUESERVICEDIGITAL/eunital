<?php

namespace App\Http\Controllers\Back\ChambreGraphisme;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDemandeClientGraphismeRequest;
use App\Http\Requests\UpdateDemandeClientGraphismeRequest;
use App\Models\ClientStudio;
use App\Models\DemandeClientGraphisme;

class DemandeClientGraphismeController extends Controller
{
    public function listeToutes()
    {
        $demandes = DemandeClientGraphisme::with('client')->latest()->paginate(12);
        return view('back.chambre-graphisme.demandes-clients.liste', compact('demandes'));
    }

    public function listeEnAttente()
    {
        $demandes = DemandeClientGraphisme::with('client')
            ->where('statut', 'en_attente')
            ->latest()
            ->paginate(12);

        return view('back.chambre-graphisme.demandes-clients.en-attente', compact('demandes'));
    }

    public function listeEnCours()
    {
        $demandes = DemandeClientGraphisme::with('client')
            ->where('statut', 'en_cours')
            ->latest()
            ->paginate(12);

        return view('back.chambre-graphisme.demandes-clients.en-cours', compact('demandes'));
    }

    public function listeTerminees()
    {
        $demandes = DemandeClientGraphisme::with('client')
            ->where('statut', 'termine')
            ->latest()
            ->paginate(12);

        return view('back.chambre-graphisme.demandes-clients.terminees', compact('demandes'));
    }

    public function formulaireCreation()
    {
        $clients = ClientStudio::orderBy('nom')->get();
        return view('back.chambre-graphisme.demandes-clients.creer', compact('clients'));
    }

    public function enregistrer(StoreDemandeClientGraphismeRequest $request)
    {
        $demande = DemandeClientGraphisme::create($request->validated());

        return redirect()
            ->route('back.chambre-graphisme.clients-demandes.details', $demande)
            ->with('success', 'Demande client créée.');
    }

    public function details(DemandeClientGraphisme $demandeClientGraphisme)
    {
        $demandeClientGraphisme->load('client');

        return view('back.chambre-graphisme.demandes-clients.details', [
            'demande' => $demandeClientGraphisme
        ]);
    }

    public function formulaireEdition(DemandeClientGraphisme $demandeClientGraphisme)
    {
        $clients = ClientStudio::orderBy('nom')->get();

        return view('back.chambre-graphisme.demandes-clients.modifier', [
            'demande' => $demandeClientGraphisme,
            'clients' => $clients,
        ]);
    }

    public function mettreAJour(UpdateDemandeClientGraphismeRequest $request, DemandeClientGraphisme $demandeClientGraphisme)
    {
        $demandeClientGraphisme->update($request->validated());

        return redirect()
            ->route('back.chambre-graphisme.clients-demandes.details', $demandeClientGraphisme)
            ->with('success', 'Demande client mise à jour.');
    }

    public function lancer(DemandeClientGraphisme $demandeClientGraphisme)
    {
        $demandeClientGraphisme->update(['statut' => 'en_cours']);

        return back()->with('success', 'Demande client lancée.');
    }

    public function terminer(DemandeClientGraphisme $demandeClientGraphisme)
    {
        $demandeClientGraphisme->update(['statut' => 'termine']);

        return back()->with('success', 'Demande client terminée.');
    }

    public function supprimer(DemandeClientGraphisme $demandeClientGraphisme)
    {
        $demandeClientGraphisme->delete();

        return redirect()
            ->route('back.chambre-graphisme.clients-demandes.toutes')
            ->with('success', 'Demande client supprimée.');
    }
}
