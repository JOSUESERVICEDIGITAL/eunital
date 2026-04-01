<?php

namespace App\Http\Controllers\Back\ChambreStudio;

use App\Models\User;
use App\Models\DiffusionStudio;
use App\Models\EvenementStudio;
use App\Http\Controllers\Controller;
use App\Http\Requests\EnregistrerDiffusionStudioRequest;
use App\Http\Requests\ModifierDiffusionStudioRequest;

class DiffusionStudioController extends Controller
{
    public function listeToutes()
    {
        $diffusions = DiffusionStudio::with(['evenement', 'responsable'])
            ->latest()
            ->paginate(12);

        return view('back.chambre-studio.diffusions.liste', compact('diffusions'));
    }

    public function listeProgrammees()
    {
        $diffusions = DiffusionStudio::with(['evenement', 'responsable'])
            ->where('statut', 'planifie')
            ->latest()
            ->paginate(12);

        return view('back.chambre-studio.diffusions.programmees', compact('diffusions'));
    }

    public function listeDiffusees()
    {
        $diffusions = DiffusionStudio::with(['evenement', 'responsable'])
            ->where('statut', 'termine')
            ->latest()
            ->paginate(12);

        return view('back.chambre-studio.diffusions.diffusees', compact('diffusions'));
    }

    public function listeArchivees()
    {
        $diffusions = DiffusionStudio::with(['evenement', 'responsable'])
            ->where('statut', 'annule')
            ->latest()
            ->paginate(12);

        return view('back.chambre-studio.diffusions.archivees', compact('diffusions'));
    }

    public function formulaireCreation()
    {
        $evenements = EvenementStudio::orderBy('titre')->get();
        $responsables = User::orderBy('name')->get();

        return view('back.chambre-studio.diffusions.creer', compact('evenements', 'responsables'));
    }

    public function enregistrer(EnregistrerDiffusionStudioRequest $request)
    {
        $diffusionStudio = DiffusionStudio::create($request->validated());

        return redirect()
            ->route('back.chambre-studio.diffusions.details', $diffusionStudio)
            ->with('success', 'Diffusion créée avec succès.');
    }

    public function details(DiffusionStudio $diffusionStudio)
    {
        $diffusionStudio->load(['evenement', 'responsable']);

        return view('back.chambre-studio.diffusions.details', compact('diffusionStudio'));
    }

    public function formulaireEdition(DiffusionStudio $diffusionStudio)
    {
        $evenements = EvenementStudio::orderBy('titre')->get();
        $responsables = User::orderBy('name')->get();

        return view('back.chambre-studio.diffusions.modifier', compact('diffusionStudio', 'evenements', 'responsables'));
    }

    public function mettreAJour(ModifierDiffusionStudioRequest $request, DiffusionStudio $diffusionStudio)
    {
        $diffusionStudio->update($request->validated());

        return redirect()
            ->route('back.chambre-studio.diffusions.details', $diffusionStudio)
            ->with('success', 'Diffusion mise à jour avec succès.');
    }

    public function programmer(DiffusionStudio $diffusionStudio)
    {
        $diffusionStudio->update(['statut' => 'planifie']);

        return back()->with('success', 'Diffusion programmée.');
    }

    public function marquerCommeDiffusee(DiffusionStudio $diffusionStudio)
    {
        $diffusionStudio->update(['statut' => 'termine']);

        return back()->with('success', 'Diffusion marquée comme terminée.');
    }

    public function archiver(DiffusionStudio $diffusionStudio)
    {
        $diffusionStudio->update(['statut' => 'annule']);

        return back()->with('success', 'Diffusion archivée.');
    }

    public function supprimer(DiffusionStudio $diffusionStudio)
    {
        $diffusionStudio->delete();

        return redirect()
            ->route('back.chambre-studio.diffusions.toutes')
            ->with('success', 'Diffusion supprimée avec succès.');
    }
}