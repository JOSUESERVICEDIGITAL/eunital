<?php

namespace App\Http\Controllers\Back\ChambreMarketing;

use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\CroissanceMarketing;
use App\Http\Requests\EnregistrerCroissanceMarketingRequest;
use App\Http\Requests\ModifierCroissanceMarketingRequest;

class CroissanceMarketingController extends Controller
{
    public function listeToutes()
    {
        $croissances = CroissanceMarketing::with(['auteur', 'responsable'])
            ->latest()
            ->paginate(12);

        return view('back.chambre-marketing.croissances.liste', compact('croissances'));
    }

    public function listePlanifiees()
    {
        $croissances = CroissanceMarketing::with(['auteur', 'responsable'])
            ->where('statut', 'planifiee')
            ->latest()
            ->paginate(12);

        return view('back.chambre-marketing.croissances.planifiees', compact('croissances'));
    }

    public function listeEnCours()
    {
        $croissances = CroissanceMarketing::with(['auteur', 'responsable'])
            ->where('statut', 'en_cours')
            ->latest()
            ->paginate(12);

        return view('back.chambre-marketing.croissances.en-cours', compact('croissances'));
    }

    public function listeCritiques()
    {
        $croissances = CroissanceMarketing::with(['auteur', 'responsable'])
            ->where('priorite', 'critique')
            ->latest()
            ->paginate(12);

        return view('back.chambre-marketing.croissances.critiques', compact('croissances'));
    }

    public function formulaireCreation()
    {
        $utilisateurs = User::orderBy('name')->get();

        return view('back.chambre-marketing.croissances.creer', compact('utilisateurs'));
    }

    public function enregistrer(EnregistrerCroissanceMarketingRequest $request)
    {
        $donnees = $request->validated();

        $slugBase = Str::slug($donnees['titre']);
        $slug = $slugBase;
        $compteur = 1;

        while (CroissanceMarketing::where('slug', $slug)->exists()) {
            $slug = $slugBase . '-' . $compteur++;
        }

        $croissance = CroissanceMarketing::create([
            'auteur_id' => $donnees['auteur_id'] ?? auth()->id(),
            'responsable_id' => $donnees['responsable_id'] ?? null,
            'titre' => $donnees['titre'],
            'slug' => $slug,
            'objectif' => $donnees['objectif'] ?? null,
            'levier' => $donnees['levier'] ?? null,
            'action_prevue' => $donnees['action_prevue'] ?? null,
            'metrique_cible' => $donnees['metrique_cible'] ?? null,
            'priorite' => $donnees['priorite'],
            'statut' => $donnees['statut'],
            'date_debut' => $donnees['date_debut'] ?? null,
            'date_fin' => $donnees['date_fin'] ?? null,
        ]);

        return redirect()
            ->route('back.chambre-marketing.croissances.details', $croissance)
            ->with('success', 'Action de croissance enregistrée avec succès.');
    }

    public function details(CroissanceMarketing $croissanceMarketing)
    {
        $croissanceMarketing->load(['auteur', 'responsable']);

        return view('back.chambre-marketing.croissances.details', compact('croissanceMarketing'));
    }

    public function formulaireEdition(CroissanceMarketing $croissanceMarketing)
    {
        $utilisateurs = User::orderBy('name')->get();

        return view('back.chambre-marketing.croissances.modifier', compact('croissanceMarketing', 'utilisateurs'));
    }

    public function mettreAJour(ModifierCroissanceMarketingRequest $request, CroissanceMarketing $croissanceMarketing)
    {
        $donnees = $request->validated();

        $slug = $croissanceMarketing->slug;

        if ($croissanceMarketing->titre !== $donnees['titre']) {
            $slugBase = Str::slug($donnees['titre']);
            $slug = $slugBase;
            $compteur = 1;

            while (
                CroissanceMarketing::where('slug', $slug)
                    ->where('id', '!=', $croissanceMarketing->id)
                    ->exists()
            ) {
                $slug = $slugBase . '-' . $compteur++;
            }
        }

        $croissanceMarketing->update([
            'auteur_id' => $donnees['auteur_id'] ?? $croissanceMarketing->auteur_id,
            'responsable_id' => $donnees['responsable_id'] ?? null,
            'titre' => $donnees['titre'],
            'slug' => $slug,
            'objectif' => $donnees['objectif'] ?? null,
            'levier' => $donnees['levier'] ?? null,
            'action_prevue' => $donnees['action_prevue'] ?? null,
            'metrique_cible' => $donnees['metrique_cible'] ?? null,
            'priorite' => $donnees['priorite'],
            'statut' => $donnees['statut'],
            'date_debut' => $donnees['date_debut'] ?? null,
            'date_fin' => $donnees['date_fin'] ?? null,
        ]);

        return back()->with('success', 'Action de croissance mise à jour avec succès.');
    }

    public function lancer(CroissanceMarketing $croissanceMarketing)
    {
        $croissanceMarketing->update(['statut' => 'en_cours']);

        return back()->with('success', 'Action de croissance lancée.');
    }

    public function passerEnTest(CroissanceMarketing $croissanceMarketing)
    {
        $croissanceMarketing->update(['statut' => 'test']);

        return back()->with('success', 'Action de croissance passée en test.');
    }

    public function valider(CroissanceMarketing $croissanceMarketing)
    {
        $croissanceMarketing->update(['statut' => 'validee']);

        return back()->with('success', 'Action de croissance validée.');
    }

    public function abandonner(CroissanceMarketing $croissanceMarketing)
    {
        $croissanceMarketing->update(['statut' => 'abandonnee']);

        return back()->with('success', 'Action de croissance abandonnée.');
    }

    public function archiver(CroissanceMarketing $croissanceMarketing)
    {
        $croissanceMarketing->update(['statut' => 'archivee']);

        return back()->with('success', 'Action de croissance archivée.');
    }

    public function definirPrioriteCritique(CroissanceMarketing $croissanceMarketing)
    {
        $croissanceMarketing->update(['priorite' => 'critique']);

        return back()->with('success', 'Priorité critique appliquée.');
    }

    public function supprimer(CroissanceMarketing $croissanceMarketing)
    {
        $croissanceMarketing->delete();

        return redirect()
            ->route('back.chambre-marketing.croissances.toutes')
            ->with('success', 'Action de croissance supprimée avec succès.');
    }
}
