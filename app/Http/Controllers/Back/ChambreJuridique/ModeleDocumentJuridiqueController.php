<?php

namespace App\Http\Controllers\Back\ChambreJuridique;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreModeleDocumentJuridiqueRequest;
use App\Http\Requests\UpdateModeleDocumentJuridiqueRequest;
use App\Models\ModeleDocumentJuridique;

class ModeleDocumentJuridiqueController extends Controller
{
    public function listeToutes()
    {
        $modeles = ModeleDocumentJuridique::with('auteur')
            ->latest()
            ->paginate(12);

        return view('back.chambre-juridique.modeles-documents.liste', compact('modeles'));
    }

    public function listeActifs()
    {
        $modeles = ModeleDocumentJuridique::with('auteur')
            ->where('actif', true)
            ->latest()
            ->paginate(12);

        return view('back.chambre-juridique.modeles-documents.actifs', compact('modeles'));
    }

    public function listeInactifs()
    {
        $modeles = ModeleDocumentJuridique::with('auteur')
            ->where('actif', false)
            ->latest()
            ->paginate(12);

        return view('back.chambre-juridique.modeles-documents.inactifs', compact('modeles'));
    }

    public function formulaireCreation()
    {
        return view('back.chambre-juridique.modeles-documents.creer');
    }

    public function enregistrer(StoreModeleDocumentJuridiqueRequest $request)
    {
        $data = $request->validated();
        $data['auteur_id'] = auth()->id();

        $modele = ModeleDocumentJuridique::create($data);

        return redirect()
            ->route('back.chambre-juridique.modeles-documents.details', $modele)
            ->with('success', 'Modèle de document créé avec succès.');
    }

    public function details(ModeleDocumentJuridique $modeleDocumentJuridique)
    {
        $modeleDocumentJuridique->load('auteur');

        return view('back.chambre-juridique.modeles-documents.details', [
            'modele' => $modeleDocumentJuridique
        ]);
    }

    public function formulaireEdition(ModeleDocumentJuridique $modeleDocumentJuridique)
    {
        return view('back.chambre-juridique.modeles-documents.modifier', [
            'modele' => $modeleDocumentJuridique
        ]);
    }

    public function mettreAJour(UpdateModeleDocumentJuridiqueRequest $request, ModeleDocumentJuridique $modeleDocumentJuridique)
    {
        $modeleDocumentJuridique->update($request->validated());

        return redirect()
            ->route('back.chambre-juridique.modeles-documents.details', $modeleDocumentJuridique)
            ->with('success', 'Modèle mis à jour avec succès.');
    }

    public function activer(ModeleDocumentJuridique $modeleDocumentJuridique)
    {
        $modeleDocumentJuridique->update(['actif' => true]);

        return back()->with('success', 'Modèle activé.');
    }

    public function desactiver(ModeleDocumentJuridique $modeleDocumentJuridique)
    {
        $modeleDocumentJuridique->update(['actif' => false]);

        return back()->with('success', 'Modèle désactivé.');
    }

    public function supprimer(ModeleDocumentJuridique $modeleDocumentJuridique)
    {
        $modeleDocumentJuridique->delete();

        return redirect()
            ->route('back.chambre-juridique.modeles-documents.toutes')
            ->with('success', 'Modèle supprimé avec succès.');
    }
}
