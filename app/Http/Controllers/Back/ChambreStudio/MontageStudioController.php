<?php

namespace App\Http\Controllers\Back\ChambreStudio;

use App\Models\MontageStudio;
use App\Models\ProductionVideo;
use App\Http\Controllers\Controller;
use App\Http\Requests\EnregistrerMontageStudioRequest;
use App\Http\Requests\ModifierMontageStudioRequest;

class MontageStudioController extends Controller
{
    public function listeTous()
    {
        $montages = MontageStudio::with('video')
            ->latest()
            ->paginate(12);

        return view('back.chambre-studio.montages.liste', compact('montages'));
    }

    public function listeBrouillons()
    {
        $montages = MontageStudio::with('video')
            ->where('statut', 'brouillon')
            ->latest()
            ->paginate(12);

        return view('back.chambre-studio.montages.brouillons', compact('montages'));
    }

    public function listeEnCours()
    {
        $montages = MontageStudio::with('video')
            ->where('statut', 'en_cours')
            ->latest()
            ->paginate(12);

        return view('back.chambre-studio.montages.en_cours', compact('montages'));
    }

    public function listeValides()
    {
        $montages = MontageStudio::with('video')
            ->where('statut', 'valide')
            ->latest()
            ->paginate(12);

        return view('back.chambre-studio.montages.valides', compact('montages'));
    }

    public function listeLivres()
    {
        $montages = MontageStudio::with('video')
            ->where('statut', 'livre')
            ->latest()
            ->paginate(12);

        return view('back.chambre-studio.montages.livres', compact('montages'));
    }

    public function formulaireCreation()
    {
        $videos = ProductionVideo::orderBy('titre')->get();

        return view('back.chambre-studio.montages.creer', compact('videos'));
    }

    public function enregistrer(EnregistrerMontageStudioRequest $request)
    {
        $montageStudio = MontageStudio::create($request->validated());

        return redirect()
            ->route('back.chambre-studio.montages.details', $montageStudio)
            ->with('success', 'Montage créé avec succès.');
    }

    public function details(MontageStudio $montageStudio)
    {
        $montageStudio->load('video');

        return view('back.chambre-studio.montages.details', compact('montageStudio'));
    }

    public function formulaireEdition(MontageStudio $montageStudio)
    {
        $videos = ProductionVideo::orderBy('titre')->get();

        return view('back.chambre-studio.montages.modifier', compact('montageStudio', 'videos'));
    }

    public function mettreAJour(ModifierMontageStudioRequest $request, MontageStudio $montageStudio)
    {
        $montageStudio->update($request->validated());

        return redirect()
            ->route('back.chambre-studio.montages.details', $montageStudio)
            ->with('success', 'Montage mis à jour avec succès.');
    }

    public function demarrer(MontageStudio $montageStudio)
    {
        $montageStudio->update(['statut' => 'en_cours']);

        return back()->with('success', 'Montage démarré.');
    }

    public function valider(MontageStudio $montageStudio)
    {
        $montageStudio->update(['statut' => 'valide']);

        return back()->with('success', 'Montage validé.');
    }

    public function marquerCommeLivre(MontageStudio $montageStudio)
    {
        $montageStudio->update(['statut' => 'livre']);

        return back()->with('success', 'Montage marqué comme livré.');
    }

    public function supprimer(MontageStudio $montageStudio)
    {
        $montageStudio->delete();

        return redirect()
            ->route('back.chambre-studio.montages.tous')
            ->with('success', 'Montage supprimé avec succès.');
    }
}