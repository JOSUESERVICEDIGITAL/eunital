<?php

namespace App\Http\Controllers\Back\ChambreStudio;

use App\Models\CaptationStudio;
use App\Models\EvenementStudio;
use App\Http\Controllers\Controller;
use App\Http\Requests\EnregistrerCaptationStudioRequest;
use App\Http\Requests\ModifierCaptationStudioRequest;

class CaptationStudioController extends Controller
{
    public function listeToutes()
    {
        $captations = CaptationStudio::with('evenement')
            ->latest('date')
            ->paginate(12);

        return view('back.chambre-studio.captations.liste', compact('captations'));
    }

    public function listePlanifiees()
    {
        $captations = CaptationStudio::with('evenement')
            ->where('statut', 'planifie')
            ->latest('date')
            ->paginate(12);

        return view('back.chambre-studio.captations.planifiees', compact('captations'));
    }

    public function listeEnCours()
    {
        $captations = CaptationStudio::with('evenement')
            ->where('statut', 'en_cours')
            ->latest('date')
            ->paginate(12);

        return view('back.chambre-studio.captations.en_cours', compact('captations'));
    }

    public function listeTerminees()
    {
        $captations = CaptationStudio::with('evenement')
            ->where('statut', 'termine')
            ->latest('date')
            ->paginate(12);

        return view('back.chambre-studio.captations.terminees', compact('captations'));
    }

    public function listeMariages()
    {
        $captations = CaptationStudio::with('evenement')
            ->where('type', 'mariage')
            ->latest('date')
            ->paginate(12);

        return view('back.chambre-studio.captations.mariages', compact('captations'));
    }

    public function listeEvenements()
    {
        $captations = CaptationStudio::with('evenement')
            ->where('type', 'evenement')
            ->latest('date')
            ->paginate(12);

        return view('back.chambre-studio.captations.evenements', compact('captations'));
    }

    public function formulaireCreation()
    {
        $evenements = EvenementStudio::orderBy('titre')->get();

        return view('back.chambre-studio.captations.creer', compact('evenements'));
    }

    public function enregistrer(EnregistrerCaptationStudioRequest $request)
    {
        $captationStudio = CaptationStudio::create($request->validated());

        return redirect()
            ->route('back.chambre-studio.captations.details', $captationStudio)
            ->with('success', 'Captation créée avec succès.');
    }

    public function details(CaptationStudio $captationStudio)
    {
        $captationStudio->load('evenement');

        return view('back.chambre-studio.captations.details', compact('captationStudio'));
    }

    public function formulaireEdition(CaptationStudio $captationStudio)
    {
        $evenements = EvenementStudio::orderBy('titre')->get();

        return view('back.chambre-studio.captations.modifier', compact('captationStudio', 'evenements'));
    }

    public function mettreAJour(ModifierCaptationStudioRequest $request, CaptationStudio $captationStudio)
    {
        $captationStudio->update($request->validated());

        return redirect()
            ->route('back.chambre-studio.captations.details', $captationStudio)
            ->with('success', 'Captation mise à jour avec succès.');
    }

    public function demarrer(CaptationStudio $captationStudio)
    {
        $captationStudio->update(['statut' => 'en_cours']);

        return back()->with('success', 'Captation démarrée.');
    }

    public function terminer(CaptationStudio $captationStudio)
    {
        $captationStudio->update(['statut' => 'termine']);

        return back()->with('success', 'Captation terminée.');
    }

    public function supprimer(CaptationStudio $captationStudio)
    {
        $captationStudio->delete();

        return redirect()
            ->route('back.chambre-studio.captations.toutes')
            ->with('success', 'Captation supprimée avec succès.');
    }
}