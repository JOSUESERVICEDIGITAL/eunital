<?php

namespace App\Http\Controllers\Back\ChambreGraphisme;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCreationGraphiqueRequest;
use App\Http\Requests\UpdateCreationGraphiqueRequest;
use App\Models\ClientStudio;
use App\Models\CreationGraphique;
use App\Models\ProjetStudio;
use App\Models\User;

class CreationGraphiqueController extends Controller
{
    public function listeToutes()
    {
        $creations = CreationGraphique::with(['client', 'projet', 'auteur'])
            ->latest()
            ->paginate(12);

        return view('back.chambre-graphisme.creations-graphiques.liste', compact('creations'));
    }

    public function listeBrouillons()
    {
        $creations = CreationGraphique::with(['client', 'projet', 'auteur'])
            ->where('statut', 'brouillon')
            ->latest()
            ->paginate(12);

        return view('back.chambre-graphisme.creations-graphiques.brouillons', compact('creations'));
    }

    public function listeEnCours()
    {
        $creations = CreationGraphique::with(['client', 'projet', 'auteur'])
            ->where('statut', 'en_cours')
            ->latest()
            ->paginate(12);

        return view('back.chambre-graphisme.creations-graphiques.en-cours', compact('creations'));
    }

    public function listeValidations()
    {
        $creations = CreationGraphique::with(['client', 'projet', 'auteur'])
            ->where('statut', 'validation')
            ->latest()
            ->paginate(12);

        return view('back.chambre-graphisme.creations-graphiques.validations', compact('creations'));
    }

    public function listeLivrees()
    {
        $creations = CreationGraphique::with(['client', 'projet', 'auteur'])
            ->where('statut', 'livre')
            ->latest()
            ->paginate(12);

        return view('back.chambre-graphisme.creations-graphiques.livrees', compact('creations'));
    }

    public function formulaireCreation()
    {
        $clients = ClientStudio::orderBy('nom')->get();
        $projets = ProjetStudio::orderBy('titre')->get();
        $auteurs = User::orderBy('name')->get();

        return view('back.chambre-graphisme.creations-graphiques.creer', compact('clients', 'projets', 'auteurs'));
    }

    public function enregistrer(StoreCreationGraphiqueRequest $request)
    {
        $creation = CreationGraphique::create($request->validated());

        return redirect()
            ->route('back.chambre-graphisme.creations.details', $creation)
            ->with('success', 'Création graphique enregistrée avec succès.');
    }

    public function details(CreationGraphique $creationGraphique)
    {
        $creationGraphique->load(['client', 'projet', 'auteur']);

        return view('back.chambre-graphisme.creations-graphiques.details', [
            'creation' => $creationGraphique
        ]);
    }

    public function formulaireEdition(CreationGraphique $creationGraphique)
    {
        $clients = ClientStudio::orderBy('nom')->get();
        $projets = ProjetStudio::orderBy('titre')->get();
        $auteurs = User::orderBy('name')->get();

        return view('back.chambre-graphisme.creations-graphiques.modifier', [
            'creation' => $creationGraphique,
            'clients' => $clients,
            'projets' => $projets,
            'auteurs' => $auteurs,
        ]);
    }

    public function mettreAJour(UpdateCreationGraphiqueRequest $request, CreationGraphique $creationGraphique)
    {
        $creationGraphique->update($request->validated());

        return redirect()
            ->route('back.chambre-graphisme.creations.details', $creationGraphique)
            ->with('success', 'Création graphique mise à jour avec succès.');
    }

    public function envoyerEnValidation(CreationGraphique $creationGraphique)
    {
        $creationGraphique->update(['statut' => 'validation']);

        return back()->with('success', 'Création envoyée en validation.');
    }

    public function livrer(CreationGraphique $creationGraphique)
    {
        $creationGraphique->update(['statut' => 'livre']);

        return back()->with('success', 'Création marquée comme livrée.');
    }

    public function archiver(CreationGraphique $creationGraphique)
    {
        $creationGraphique->update(['statut' => 'archive']);

        return back()->with('success', 'Création archivée.');
    }

    public function supprimer(CreationGraphique $creationGraphique)
    {
        $creationGraphique->delete();

        return redirect()
            ->route('back.chambre-graphisme.creations.toutes')
            ->with('success', 'Création graphique supprimée avec succès.');
    }
}
