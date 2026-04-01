<?php

namespace App\Http\Controllers\Back\ChambreJuridique;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDossierJuridiqueRequest;
use App\Http\Requests\UpdateDossierJuridiqueRequest;
use App\Models\ClientStudio;
use App\Models\DossierJuridique;
use App\Models\User;

class DossierJuridiqueController extends Controller
{
    public function listeToutes()
    {
        $dossiers = DossierJuridique::with(['responsable', 'client', 'piecesJointes'])
            ->latest()
            ->paginate(12);

        return view('back.chambre-juridique.dossiers.liste', compact('dossiers'));
    }

    public function listeOuverts()
    {
        $dossiers = DossierJuridique::with(['responsable', 'client'])
            ->where('statut', 'ouvert')
            ->latest()
            ->paginate(12);

        return view('back.chambre-juridique.dossiers.ouverts', compact('dossiers'));
    }

    public function listeEnCours()
    {
        $dossiers = DossierJuridique::with(['responsable', 'client'])
            ->where('statut', 'en_cours')
            ->latest()
            ->paginate(12);

        return view('back.chambre-juridique.dossiers.en-cours', compact('dossiers'));
    }

    public function listeFermes()
    {
        $dossiers = DossierJuridique::with(['responsable', 'client'])
            ->where('statut', 'ferme')
            ->latest()
            ->paginate(12);

        return view('back.chambre-juridique.dossiers.fermes', compact('dossiers'));
    }

    public function formulaireCreation()
    {
        $clients = ClientStudio::orderBy('nom')->get();
        $users = User::orderBy('name')->get();

        return view('back.chambre-juridique.dossiers.creer', compact('clients', 'users'));
    }

    public function enregistrer(StoreDossierJuridiqueRequest $request)
    {
        $dossier = DossierJuridique::create($request->validated());

        return redirect()
            ->route('back.chambre-juridique.dossiers.details', $dossier)
            ->with('success', 'Dossier juridique créé avec succès.');
    }

    public function details(DossierJuridique $dossierJuridique)
    {
        $dossierJuridique->load(['responsable', 'client', 'piecesJointes']);

        return view('back.chambre-juridique.dossiers.details', [
            'dossier' => $dossierJuridique
        ]);
    }

    public function formulaireEdition(DossierJuridique $dossierJuridique)
    {
        $clients = ClientStudio::orderBy('nom')->get();
        $users = User::orderBy('name')->get();

        return view('back.chambre-juridique.dossiers.modifier', [
            'dossier' => $dossierJuridique,
            'clients' => $clients,
            'users' => $users,
        ]);
    }

    public function mettreAJour(UpdateDossierJuridiqueRequest $request, DossierJuridique $dossierJuridique)
    {
        $dossierJuridique->update($request->validated());

        return redirect()
            ->route('back.chambre-juridique.dossiers.details', $dossierJuridique)
            ->with('success', 'Dossier mis à jour avec succès.');
    }

    public function ouvrir(DossierJuridique $dossierJuridique)
    {
        $dossierJuridique->update(['statut' => 'ouvert']);

        return back()->with('success', 'Dossier ré-ouvert.');
    }

    public function lancer(DossierJuridique $dossierJuridique)
    {
        $dossierJuridique->update(['statut' => 'en_cours']);

        return back()->with('success', 'Dossier passé en cours.');
    }

    public function fermer(DossierJuridique $dossierJuridique)
    {
        $dossierJuridique->update(['statut' => 'ferme']);

        return back()->with('success', 'Dossier fermé.');
    }

    public function archiver(DossierJuridique $dossierJuridique)
    {
        $dossierJuridique->update(['statut' => 'archive']);

        return back()->with('success', 'Dossier archivé.');
    }

    public function supprimer(DossierJuridique $dossierJuridique)
    {
        $dossierJuridique->delete();

        return redirect()
            ->route('back.chambre-juridique.dossiers.toutes')
            ->with('success', 'Dossier supprimé avec succès.');
    }
}
