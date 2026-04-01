<?php

namespace App\Http\Controllers\Back\ChambreStudio;

use App\Models\ClientStudio;
use App\Models\EvenementStudio;
use App\Http\Controllers\Controller;
use App\Http\Requests\EnregistrerEvenementStudioRequest;
use App\Http\Requests\ModifierEvenementStudioRequest;

class EvenementStudioController extends Controller
{
    public function listeTous()
    {
        $evenements = EvenementStudio::with(['client', 'captations', 'diffusions'])
            ->latest('date')
            ->paginate(12);

        return view('back.chambre-studio.evenements.liste', compact('evenements'));
    }

    public function listePlanifies()
    {
        $evenements = EvenementStudio::with(['client', 'captations', 'diffusions'])
            ->where('statut', 'planifie')
            ->latest('date')
            ->paginate(12);

        return view('back.chambre-studio.evenements.planifies', compact('evenements'));
    }

    public function listeRealises()
    {
        $evenements = EvenementStudio::with(['client', 'captations', 'diffusions'])
            ->where('statut', 'realise')
            ->latest('date')
            ->paginate(12);

        return view('back.chambre-studio.evenements.realises', compact('evenements'));
    }

    public function listeAnnules()
    {
        $evenements = EvenementStudio::with(['client', 'captations', 'diffusions'])
            ->where('statut', 'annule')
            ->latest('date')
            ->paginate(12);

        return view('back.chambre-studio.evenements.annules', compact('evenements'));
    }

    public function listeMariages()
    {
        $evenements = EvenementStudio::with(['client', 'captations', 'diffusions'])
            ->where('type', 'mariage')
            ->latest('date')
            ->paginate(12);

        return view('back.chambre-studio.evenements.mariages', compact('evenements'));
    }

    public function formulaireCreation()
    {
        $clients = ClientStudio::orderBy('nom')->get();

        return view('back.chambre-studio.evenements.creer', compact('clients'));
    }

    public function enregistrer(EnregistrerEvenementStudioRequest $request)
    {
        $evenementStudio = EvenementStudio::create($request->validated());

        return redirect()
            ->route('back.chambre-studio.evenements.details', $evenementStudio)
            ->with('success', 'Événement créé avec succès.');
    }

    public function details(EvenementStudio $evenementStudio)
    {
        $evenementStudio->load(['client', 'captations', 'diffusions']);

        return view('back.chambre-studio.evenements.details', compact('evenementStudio'));
    }

    public function formulaireEdition(EvenementStudio $evenementStudio)
    {
        $clients = ClientStudio::orderBy('nom')->get();

        return view('back.chambre-studio.evenements.modifier', compact('evenementStudio', 'clients'));
    }

    public function mettreAJour(ModifierEvenementStudioRequest $request, EvenementStudio $evenementStudio)
    {
        $evenementStudio->update($request->validated());

        return redirect()
            ->route('back.chambre-studio.evenements.details', $evenementStudio)
            ->with('success', 'Événement mis à jour avec succès.');
    }

    public function marquerCommeRealise(EvenementStudio $evenementStudio)
    {
        $evenementStudio->update(['statut' => 'realise']);

        return back()->with('success', 'Événement marqué comme réalisé.');
    }

    public function annuler(EvenementStudio $evenementStudio)
    {
        $evenementStudio->update(['statut' => 'annule']);

        return back()->with('success', 'Événement annulé.');
    }

    public function supprimer(EvenementStudio $evenementStudio)
    {
        $evenementStudio->delete();

        return redirect()
            ->route('back.chambre-studio.evenements.tous')
            ->with('success', 'Événement supprimé avec succès.');
    }
}