<?php

namespace App\Http\Controllers\Back\ChambreStudio;

use App\Models\ClientStudio;
use App\Models\ProjetStudio;
use App\Http\Controllers\Controller;
use App\Http\Requests\EnregistrerProjetStudioRequest;
use App\Http\Requests\ModifierProjetStudioRequest;

class ProjetStudioController extends Controller
{
    public function listeTous()
    {
        $projets = ProjetStudio::with(['client', 'videos', 'audios'])
            ->latest()
            ->paginate(12);

        return view('back.chambre-studio.projets.liste', compact('projets'));
    }

    public function listeEnCours()
    {
        $projets = ProjetStudio::with('client')
            ->where('statut', 'en_cours')
            ->latest()
            ->paginate(12);

        return view('back.chambre-studio.projets.en_cours', compact('projets'));
    }

    public function listeTermines()
    {
        $projets = ProjetStudio::with('client')
            ->where('statut', 'termine')
            ->latest()
            ->paginate(12);

        return view('back.chambre-studio.projets.termines', compact('projets'));
    }

    public function listeAlbums()
    {
        $projets = ProjetStudio::with('client')
            ->where('type', 'album')
            ->latest()
            ->paginate(12);

        return view('back.chambre-studio.projets.albums', compact('projets'));
    }

    public function listeVideos()
    {
        $projets = ProjetStudio::with('client')
            ->where('type', 'video')
            ->latest()
            ->paginate(12);

        return view('back.chambre-studio.projets.videos', compact('projets'));
    }

    public function listeEvenements()
    {
        $projets = ProjetStudio::with('client')
            ->where('type', 'evenement')
            ->latest()
            ->paginate(12);

        return view('back.chambre-studio.projets.evenements', compact('projets'));
    }

    public function formulaireCreation()
    {
        $clients = ClientStudio::orderBy('nom')->get();

        return view('back.chambre-studio.projets.creer', compact('clients'));
    }

    public function enregistrer(EnregistrerProjetStudioRequest $request)
    {
        $projetStudio = ProjetStudio::create($request->validated());

        return redirect()
            ->route('back.chambre-studio.projets.details', $projetStudio)
            ->with('success', 'Projet créé avec succès.');
    }

    public function details(ProjetStudio $projetStudio)
    {
        $projetStudio->load(['client', 'videos', 'audios']);

        return view('back.chambre-studio.projets.details', compact('projetStudio'));
    }

    public function formulaireEdition(ProjetStudio $projetStudio)
    {
        $clients = ClientStudio::orderBy('nom')->get();

        return view('back.chambre-studio.projets.modifier', compact('projetStudio', 'clients'));
    }

    public function mettreAJour(ModifierProjetStudioRequest $request, ProjetStudio $projetStudio)
    {
        $projetStudio->update($request->validated());

        return redirect()
            ->route('back.chambre-studio.projets.details', $projetStudio)
            ->with('success', 'Projet mis à jour avec succès.');
    }

    public function marquerCommeTermine(ProjetStudio $projetStudio)
    {
        $projetStudio->update(['statut' => 'termine']);

        return back()->with('success', 'Projet marqué comme terminé.');
    }

    public function archiver(ProjetStudio $projetStudio)
    {
        $projetStudio->update(['statut' => 'archive']);

        return back()->with('success', 'Projet archivé.');
    }

    public function supprimer(ProjetStudio $projetStudio)
    {
        $projetStudio->delete();

        return redirect()
            ->route('back.chambre-studio.projets.tous')
            ->with('success', 'Projet supprimé avec succès.');
    }
}