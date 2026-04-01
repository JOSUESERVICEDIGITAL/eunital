<?php

namespace App\Http\Controllers\Back\ChambreStudio;

use App\Models\HabillageSonore;
use App\Http\Controllers\Controller;
use App\Http\Requests\EnregistrerHabillageSonoreRequest;
use App\Http\Requests\ModifierHabillageSonoreRequest;

class HabillageSonoreController extends Controller
{
    public function listeTous()
    {
        $habillages = HabillageSonore::latest()->paginate(12);

        return view('back.chambre-studio.habillages-sonores.liste', compact('habillages'));
    }

    public function listeCreation()
    {
        $habillages = HabillageSonore::where('statut', 'creation')->latest()->paginate(12);

        return view('back.chambre-studio.habillages-sonores.creation', compact('habillages'));
    }

    public function listeValidation()
    {
        $habillages = HabillageSonore::where('statut', 'validation')->latest()->paginate(12);

        return view('back.chambre-studio.habillages-sonores.validation', compact('habillages'));
    }

    public function listeLivres()
    {
        $habillages = HabillageSonore::where('statut', 'livre')->latest()->paginate(12);

        return view('back.chambre-studio.habillages-sonores.livres', compact('habillages'));
    }

    public function formulaireCreation()
    {
        return view('back.chambre-studio.habillages-sonores.creer');
    }

    public function enregistrer(EnregistrerHabillageSonoreRequest $request)
    {
        $habillageSonore = HabillageSonore::create($request->validated());

        return redirect()
            ->route('back.chambre-studio.habillages-sonores.details', $habillageSonore)
            ->with('success', 'Habillage sonore créé avec succès.');
    }

    public function details(HabillageSonore $habillageSonore)
    {
        return view('back.chambre-studio.habillages-sonores.details', compact('habillageSonore'));
    }

    public function formulaireEdition(HabillageSonore $habillageSonore)
    {
        return view('back.chambre-studio.habillages-sonores.modifier', compact('habillageSonore'));
    }

    public function mettreAJour(ModifierHabillageSonoreRequest $request, HabillageSonore $habillageSonore)
    {
        $habillageSonore->update($request->validated());

        return redirect()
            ->route('back.chambre-studio.habillages-sonores.details', $habillageSonore)
            ->with('success', 'Habillage sonore mis à jour avec succès.');
    }

    public function envoyerEnValidation(HabillageSonore $habillageSonore)
    {
        $habillageSonore->update(['statut' => 'validation']);

        return back()->with('success', 'Habillage sonore envoyé en validation.');
    }

    public function marquerCommeLivre(HabillageSonore $habillageSonore)
    {
        $habillageSonore->update(['statut' => 'livre']);

        return back()->with('success', 'Habillage sonore marqué comme livré.');
    }

    public function supprimer(HabillageSonore $habillageSonore)
    {
        $habillageSonore->delete();

        return redirect()
            ->route('back.chambre-studio.habillages-sonores.tous')
            ->with('success', 'Habillage sonore supprimé avec succès.');
    }
}