<?php

namespace App\Http\Controllers\Back\ChambreGraphisme;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUiuxDesignRequest;
use App\Http\Requests\UpdateUiuxDesignRequest;
use App\Models\ProjetStudio;
use App\Models\UiuxDesign;

class UiuxDesignController extends Controller
{
    public function listeToutes()
    {
        $designs = UiuxDesign::with('projet')->latest()->paginate(12);
        return view('back.chambre-graphisme.uiux-designs.liste', compact('designs'));
    }

    public function listeWireframes()
    {
        $designs = UiuxDesign::with('projet')
            ->where('type', 'wireframe')
            ->latest()
            ->paginate(12);

        return view('back.chambre-graphisme.uiux-designs.wireframes', compact('designs'));
    }

    public function listeMaquettes()
    {
        $designs = UiuxDesign::with('projet')
            ->where('type', 'maquette')
            ->latest()
            ->paginate(12);

        return view('back.chambre-graphisme.uiux-designs.maquettes', compact('designs'));
    }

    public function listePrototypes()
    {
        $designs = UiuxDesign::with('projet')
            ->where('type', 'prototype')
            ->latest()
            ->paginate(12);

        return view('back.chambre-graphisme.uiux-designs.prototypes', compact('designs'));
    }

    public function formulaireCreation()
    {
        $projets = ProjetStudio::orderBy('titre')->get();
        return view('back.chambre-graphisme.uiux-designs.creer', compact('projets'));
    }

    public function enregistrer(StoreUiuxDesignRequest $request)
    {
        $design = UiuxDesign::create($request->validated());

        return redirect()
            ->route('back.chambre-graphisme.uiux.details', $design)
            ->with('success', 'Design UI/UX créé avec succès.');
    }

    public function details(UiuxDesign $uiuxDesign)
    {
        $uiuxDesign->load('projet');

        return view('back.chambre-graphisme.uiux-designs.details', [
            'design' => $uiuxDesign
        ]);
    }

    public function formulaireEdition(UiuxDesign $uiuxDesign)
    {
        $projets = ProjetStudio::orderBy('titre')->get();

        return view('back.chambre-graphisme.uiux-designs.modifier', [
            'design' => $uiuxDesign,
            'projets' => $projets,
        ]);
    }

    public function mettreAJour(UpdateUiuxDesignRequest $request, UiuxDesign $uiuxDesign)
    {
        $uiuxDesign->update($request->validated());

        return redirect()
            ->route('back.chambre-graphisme.uiux.details', $uiuxDesign)
            ->with('success', 'Design UI/UX mis à jour.');
    }

    public function valider(UiuxDesign $uiuxDesign)
    {
        $uiuxDesign->update(['statut' => 'valide']);

        return back()->with('success', 'Design UI/UX validé.');
    }

    public function supprimer(UiuxDesign $uiuxDesign)
    {
        $uiuxDesign->delete();

        return redirect()
            ->route('back.chambre-graphisme.uiux.toutes')
            ->with('success', 'Design UI/UX supprimé.');
    }
}
