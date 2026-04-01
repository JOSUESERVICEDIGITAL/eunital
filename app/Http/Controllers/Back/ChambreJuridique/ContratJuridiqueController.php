<?php

namespace App\Http\Controllers\Back\ChambreJuridique;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContratJuridiqueRequest;
use App\Http\Requests\UpdateContratJuridiqueRequest;
use App\Models\ClientStudio;
use App\Models\ContratJuridique;
use App\Models\ProjetStudio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContratJuridiqueController extends Controller
{
    public function listeToutes()
    {
        $contrats = ContratJuridique::with(['client', 'user', 'projet', 'auteur', 'validateur'])
            ->latest()
            ->paginate(12);

        return view('back.chambre-juridique.contrats.liste', compact('contrats'));
    }

    public function listeBrouillons()
    {
        $contrats = ContratJuridique::with(['client', 'user', 'projet', 'auteur', 'validateur'])
            ->where('statut', 'brouillon')
            ->latest()
            ->paginate(12);

        return view('back.chambre-juridique.contrats.brouillons', compact('contrats'));
    }

    public function listeValides()
    {
        $contrats = ContratJuridique::with(['client', 'user', 'projet', 'auteur', 'validateur'])
            ->where('statut', 'valide')
            ->latest()
            ->paginate(12);

        return view('back.chambre-juridique.contrats.valides', compact('contrats'));
    }

    public function listeSignes()
    {
        $contrats = ContratJuridique::with(['client', 'user', 'projet', 'auteur', 'validateur'])
            ->where('statut', 'signe')
            ->latest()
            ->paginate(12);

        return view('back.chambre-juridique.contrats.signes', compact('contrats'));
    }

    public function listeArchives()
    {
        $contrats = ContratJuridique::with(['client', 'user', 'projet', 'auteur', 'validateur'])
            ->where('statut', 'archive')
            ->latest()
            ->paginate(12);

        return view('back.chambre-juridique.contrats.archives', compact('contrats'));
    }

    public function formulaireCreation()
    {
        $clients = ClientStudio::orderBy('nom')->get();
        $projets = ProjetStudio::orderBy('titre')->get();
        $users = User::orderBy('name')->get();

        return view('back.chambre-juridique.contrats.creer', compact('clients', 'projets', 'users'));
    }

    public function enregistrer(StoreContratJuridiqueRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('fichier_pdf')) {
            $data['fichier_pdf'] = $request->file('fichier_pdf')->store('juridique/contrats', 'public');
        }

        $data['auteur_id'] = auth()->id();

        $contrat = ContratJuridique::create($data);

        return redirect()
            ->route('back.chambre-juridique.contrats.details', $contrat)
            ->with('success', 'Contrat juridique créé avec succès.');
    }

    public function details(ContratJuridique $contratJuridique)
    {
        $contratJuridique->load(['client', 'user', 'projet', 'auteur', 'validateur', 'piecesJointes']);

        return view('back.chambre-juridique.contrats.details', [
            'contrat' => $contratJuridique
        ]);
    }

    public function formulaireEdition(ContratJuridique $contratJuridique)
    {
        $clients = ClientStudio::orderBy('nom')->get();
        $projets = ProjetStudio::orderBy('titre')->get();
        $users = User::orderBy('name')->get();

        return view('back.chambre-juridique.contrats.modifier', [
            'contrat' => $contratJuridique,
            'clients' => $clients,
            'projets' => $projets,
            'users' => $users,
        ]);
    }

    public function mettreAJour(UpdateContratJuridiqueRequest $request, ContratJuridique $contratJuridique)
    {
        $data = $request->validated();

        if ($request->hasFile('fichier_pdf')) {
            if ($contratJuridique->fichier_pdf && Storage::disk('public')->exists($contratJuridique->fichier_pdf)) {
                Storage::disk('public')->delete($contratJuridique->fichier_pdf);
            }

            $data['fichier_pdf'] = $request->file('fichier_pdf')->store('juridique/contrats', 'public');
        }

        $contratJuridique->update($data);

        return redirect()
            ->route('back.chambre-juridique.contrats.details', $contratJuridique)
            ->with('success', 'Contrat juridique mis à jour avec succès.');
    }

    public function valider(ContratJuridique $contratJuridique)
    {
        $contratJuridique->update([
            'statut' => 'valide',
            'validateur_id' => auth()->id(),
            'date_validation' => now(),
        ]);

        return back()->with('success', 'Contrat validé avec succès.');
    }

    public function signer(ContratJuridique $contratJuridique)
    {
        $contratJuridique->update([
            'statut' => 'signe',
        ]);

        return back()->with('success', 'Contrat marqué comme signé.');
    }

    public function archiver(ContratJuridique $contratJuridique)
    {
        $contratJuridique->update([
            'statut' => 'archive',
        ]);

        return back()->with('success', 'Contrat archivé avec succès.');
    }

    public function supprimer(ContratJuridique $contratJuridique)
    {
        if ($contratJuridique->fichier_pdf && Storage::disk('public')->exists($contratJuridique->fichier_pdf)) {
            Storage::disk('public')->delete($contratJuridique->fichier_pdf);
        }

        $contratJuridique->delete();

        return redirect()
            ->route('back.chambre-juridique.contrats.toutes')
            ->with('success', 'Contrat supprimé avec succès.');
    }
}
