<?php

namespace App\Http\Controllers\Back\ChambreStudio;

use App\Models\ClientStudio;
use App\Models\CommandeStudio;
use App\Http\Controllers\Controller;
use App\Http\Requests\EnregistrerCommandeStudioRequest;
use App\Http\Requests\ModifierCommandeStudioRequest;

class CommandeStudioController extends Controller
{
    public function listeToutes()
    {
        $commandes = CommandeStudio::with('client')
            ->latest()
            ->paginate(12);

        return view('back.chambre-studio.commandes.liste', compact('commandes'));
    }

    public function listeEnAttente()
    {
        $commandes = CommandeStudio::with('client')
            ->where('statut', 'en_attente')
            ->latest()
            ->paginate(12);

        return view('back.chambre-studio.commandes.en_attente', compact('commandes'));
    }

    public function listeConfirmees()
    {
        $commandes = CommandeStudio::with('client')
            ->where('statut', 'confirmee')
            ->latest()
            ->paginate(12);

        return view('back.chambre-studio.commandes.confirmees', compact('commandes'));
    }

    public function listeEnCours()
    {
        $commandes = CommandeStudio::with('client')
            ->where('statut', 'en_cours')
            ->latest()
            ->paginate(12);

        return view('back.chambre-studio.commandes.en_cours', compact('commandes'));
    }

    public function listeLivrees()
    {
        $commandes = CommandeStudio::with('client')
            ->where('statut', 'livree')
            ->latest()
            ->paginate(12);

        return view('back.chambre-studio.commandes.livrees', compact('commandes'));
    }

    public function formulaireCreation()
    {
        $clients = ClientStudio::orderBy('nom')->get();

        return view('back.chambre-studio.commandes.creer', compact('clients'));
    }

    public function enregistrer(EnregistrerCommandeStudioRequest $request)
    {
        $commandeStudio = CommandeStudio::create($request->validated());

        return redirect()
            ->route('back.chambre-studio.commandes.details', $commandeStudio)
            ->with('success', 'Commande studio enregistrée avec succès.');
    }

    public function details(CommandeStudio $commandeStudio)
    {
        $commandeStudio->load('client');

        return view('back.chambre-studio.commandes.details', compact('commandeStudio'));
    }

    public function formulaireEdition(CommandeStudio $commandeStudio)
    {
        $clients = ClientStudio::orderBy('nom')->get();

        return view('back.chambre-studio.commandes.modifier', compact('commandeStudio', 'clients'));
    }

    public function mettreAJour(ModifierCommandeStudioRequest $request, CommandeStudio $commandeStudio)
    {
        $commandeStudio->update($request->validated());

        return redirect()
            ->route('back.chambre-studio.commandes.details', $commandeStudio)
            ->with('success', 'Commande mise à jour avec succès.');
    }

    public function confirmer(CommandeStudio $commandeStudio)
    {
        $commandeStudio->update(['statut' => 'confirmee']);

        return back()->with('success', 'Commande confirmée.');
    }

    public function demarrer(CommandeStudio $commandeStudio)
    {
        $commandeStudio->update(['statut' => 'en_cours']);

        return back()->with('success', 'Commande démarrée.');
    }

    public function marquerCommeLivree(CommandeStudio $commandeStudio)
    {
        $commandeStudio->update(['statut' => 'livree']);

        return back()->with('success', 'Commande marquée comme livrée.');
    }

    public function supprimer(CommandeStudio $commandeStudio)
    {
        $commandeStudio->delete();

        return redirect()
            ->route('back.chambre-studio.commandes.toutes')
            ->with('success', 'Commande supprimée avec succès.');
    }
}