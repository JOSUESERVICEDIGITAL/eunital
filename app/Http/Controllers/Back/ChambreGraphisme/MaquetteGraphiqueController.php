<?php

namespace App\Http\Controllers\Back\ChambreGraphisme;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMaquetteGraphiqueRequest;
use App\Http\Requests\UpdateMaquetteGraphiqueRequest;
use App\Models\MaquetteGraphique;

class MaquetteGraphiqueController extends Controller
{
    public function listeToutes()
    {
        $maquettes = MaquetteGraphique::latest()->paginate(12);
        return view('back.chambre-graphisme.maquettes-graphiques.liste', compact('maquettes'));
    }

    public function listeCreations()
    {
        $maquettes = MaquetteGraphique::where('statut', 'creation')->latest()->paginate(12);
        return view('back.chambre-graphisme.maquettes-graphiques.creations', compact('maquettes'));
    }

    public function listeValidations()
    {
        $maquettes = MaquetteGraphique::where('statut', 'validation')->latest()->paginate(12);
        return view('back.chambre-graphisme.maquettes-graphiques.validations', compact('maquettes'));
    }

    public function listeLivrees()
    {
        $maquettes = MaquetteGraphique::where('statut', 'livre')->latest()->paginate(12);
        return view('back.chambre-graphisme.maquettes-graphiques.livrees', compact('maquettes'));
    }

    public function formulaireCreation()
    {
        return view('back.chambre-graphisme.maquettes-graphiques.creer');
    }

    public function enregistrer(StoreMaquetteGraphiqueRequest $request)
    {
        $maquette = MaquetteGraphique::create($request->validated());

        return redirect()
            ->route('back.chambre-graphisme.maquettes.details', $maquette)
            ->with('success', 'Maquette graphique créée.');
    }

    public function details(MaquetteGraphique $maquetteGraphique)
    {
        return view('back.chambre-graphisme.maquettes-graphiques.details', [
            'maquette' => $maquetteGraphique
        ]);
    }

    public function formulaireEdition(MaquetteGraphique $maquetteGraphique)
    {
        return view('back.chambre-graphisme.maquettes-graphiques.modifier', [
            'maquette' => $maquetteGraphique
        ]);
    }

    public function mettreAJour(UpdateMaquetteGraphiqueRequest $request, MaquetteGraphique $maquetteGraphique)
    {
        $maquetteGraphique->update($request->validated());

        return redirect()
            ->route('back.chambre-graphisme.maquettes.details', $maquetteGraphique)
            ->with('success', 'Maquette graphique mise à jour.');
    }

    public function valider(MaquetteGraphique $maquetteGraphique)
    {
        $maquetteGraphique->update(['statut' => 'validation']);

        return back()->with('success', 'Maquette envoyée en validation.');
    }

    public function livrer(MaquetteGraphique $maquetteGraphique)
    {
        $maquetteGraphique->update(['statut' => 'livre']);

        return back()->with('success', 'Maquette marquée livrée.');
    }

    public function supprimer(MaquetteGraphique $maquetteGraphique)
    {
        $maquetteGraphique->delete();

        return redirect()
            ->route('back.chambre-graphisme.maquettes.toutes')
            ->with('success', 'Maquette supprimée.');
    }
}
