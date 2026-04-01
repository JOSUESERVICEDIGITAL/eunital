<?php

namespace App\Http\Controllers\Back\ChambreMarketing;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\CampagneMarketing;
use App\Http\Controllers\Controller;
use App\Http\Requests\EnregistrerCampagneMarketingRequest;
use App\Http\Requests\ModifierCampagneMarketingRequest;

class CampagneMarketingController extends Controller
{
    public function listeToutes()
    {
        $campagnes = CampagneMarketing::with(['auteur', 'responsable'])
            ->latest()
            ->paginate(12);

        return view('back.chambre-marketing.campagnes.liste', compact('campagnes'));
    }

    public function listeActives()
    {
        $campagnes = CampagneMarketing::with(['auteur', 'responsable'])
            ->where('statut', 'active')
            ->latest()
            ->paginate(12);

        return view('back.chambre-marketing.campagnes.actives', compact('campagnes'));
    }

    public function listeEnPause()
    {
        $campagnes = CampagneMarketing::with(['auteur', 'responsable'])
            ->where('statut', 'en_pause')
            ->latest()
            ->paginate(12);

        return view('back.chambre-marketing.campagnes.en-pause', compact('campagnes'));
    }

    public function listeTerminees()
    {
        $campagnes = CampagneMarketing::with(['auteur', 'responsable'])
            ->where('statut', 'terminee')
            ->latest()
            ->paginate(12);

        return view('back.chambre-marketing.campagnes.terminees', compact('campagnes'));
    }

    public function listeMultiReseaux()
    {
        $campagnes = CampagneMarketing::with(['auteur', 'responsable'])
            ->where('reseau', 'multi_reseaux')
            ->latest()
            ->paginate(12);

        return view('back.chambre-marketing.campagnes.multi-reseaux', compact('campagnes'));
    }

    public function formulaireCreation()
    {
        $utilisateurs = User::orderBy('name')->get();

        return view('back.chambre-marketing.campagnes.creer', compact('utilisateurs'));
    }

    public function enregistrer(EnregistrerCampagneMarketingRequest $request)
    {
        $donnees = $request->validated();

        $slugBase = Str::slug($donnees['titre']);
        $slug = $slugBase;
        $compteur = 1;

        while (CampagneMarketing::where('slug', $slug)->exists()) {
            $slug = $slugBase . '-' . $compteur++;
        }

        $campagne = CampagneMarketing::create([
            'auteur_id' => $donnees['auteur_id'] ?? auth()->id(),
            'responsable_id' => $donnees['responsable_id'] ?? null,
            'titre' => $donnees['titre'],
            'slug' => $slug,
            'description' => $donnees['description'] ?? null,
            'reseau' => $donnees['reseau'],
            'objectif' => $donnees['objectif'] ?? null,
            'audience' => $donnees['audience'] ?? null,
            'budget' => $donnees['budget'],
            'budget_consomme' => $donnees['budget_consomme'] ?? 0,
            'date_debut' => $donnees['date_debut'] ?? null,
            'date_fin' => $donnees['date_fin'] ?? null,
            'statut' => $donnees['statut'],
            'est_active' => $donnees['est_active'] ?? false,
            'taux_conversion' => $donnees['taux_conversion'] ?? null,
            'cout_par_resultat' => $donnees['cout_par_resultat'] ?? null,
            'lien_annonce' => $donnees['lien_annonce'] ?? null,
            'visuel' => $donnees['visuel'] ?? null,
        ]);

        return redirect()
            ->route('back.chambre-marketing.campagnes.details', $campagne)
            ->with('success', 'Campagne marketing enregistrée avec succès.');
    }

    public function details(CampagneMarketing $campagneMarketing)
    {
        $campagneMarketing->load(['auteur', 'responsable', 'acquisitions', 'tableauxPerformance']);

        return view('back.chambre-marketing.campagnes.details', compact('campagneMarketing'));
    }

    public function formulaireEdition(CampagneMarketing $campagneMarketing)
    {
        $utilisateurs = User::orderBy('name')->get();

        return view('back.chambre-marketing.campagnes.modifier', compact('campagneMarketing', 'utilisateurs'));
    }

    public function mettreAJour(ModifierCampagneMarketingRequest $request, CampagneMarketing $campagneMarketing)
    {
        $donnees = $request->validated();

        $slug = $campagneMarketing->slug;

        if ($campagneMarketing->titre !== $donnees['titre']) {
            $slugBase = Str::slug($donnees['titre']);
            $slug = $slugBase;
            $compteur = 1;

            while (
                CampagneMarketing::where('slug', $slug)
                    ->where('id', '!=', $campagneMarketing->id)
                    ->exists()
            ) {
                $slug = $slugBase . '-' . $compteur++;
            }
        }

        $campagneMarketing->update([
            'auteur_id' => $donnees['auteur_id'] ?? $campagneMarketing->auteur_id,
            'responsable_id' => $donnees['responsable_id'] ?? null,
            'titre' => $donnees['titre'],
            'slug' => $slug,
            'description' => $donnees['description'] ?? null,
            'reseau' => $donnees['reseau'],
            'objectif' => $donnees['objectif'] ?? null,
            'audience' => $donnees['audience'] ?? null,
            'budget' => $donnees['budget'],
            'budget_consomme' => $donnees['budget_consomme'] ?? 0,
            'date_debut' => $donnees['date_debut'] ?? null,
            'date_fin' => $donnees['date_fin'] ?? null,
            'statut' => $donnees['statut'],
            'est_active' => $donnees['est_active'] ?? false,
            'taux_conversion' => $donnees['taux_conversion'] ?? null,
            'cout_par_resultat' => $donnees['cout_par_resultat'] ?? null,
            'lien_annonce' => $donnees['lien_annonce'] ?? null,
            'visuel' => $donnees['visuel'] ?? null,
        ]);

        return back()->with('success', 'Campagne marketing mise à jour avec succès.');
    }

    public function activer(CampagneMarketing $campagneMarketing)
    {
        $campagneMarketing->update([
            'statut' => 'active',
            'est_active' => true,
        ]);

        return back()->with('success', 'Campagne activée.');
    }

    public function mettreEnPause(CampagneMarketing $campagneMarketing)
    {
        $campagneMarketing->update([
            'statut' => 'en_pause',
            'est_active' => false,
        ]);

        return back()->with('success', 'Campagne mise en pause.');
    }

    public function reprendre(CampagneMarketing $campagneMarketing)
    {
        $campagneMarketing->update([
            'statut' => 'active',
            'est_active' => true,
        ]);

        return back()->with('success', 'Campagne relancée.');
    }

    public function terminer(CampagneMarketing $campagneMarketing)
    {
        $campagneMarketing->update([
            'statut' => 'terminee',
            'est_active' => false,
        ]);

        return back()->with('success', 'Campagne terminée.');
    }

    public function archiver(CampagneMarketing $campagneMarketing)
    {
        $campagneMarketing->update([
            'statut' => 'archivee',
            'est_active' => false,
        ]);

        return back()->with('success', 'Campagne archivée.');
    }

    public function augmenterBudget(CampagneMarketing $campagneMarketing)
    {
        $campagneMarketing->update([
            'budget' => $campagneMarketing->budget + 100,
        ]);

        return back()->with('success', 'Budget de la campagne augmenté.');
    }

    public function diminuerBudget(CampagneMarketing $campagneMarketing)
    {
        $nouveauBudget = max(0, $campagneMarketing->budget - 100);

        $campagneMarketing->update([
            'budget' => $nouveauBudget,
        ]);

        return back()->with('success', 'Budget de la campagne diminué.');
    }

    public function dupliquer(CampagneMarketing $campagneMarketing)
    {
        $copie = $campagneMarketing->replicate();
        $copie->titre = $campagneMarketing->titre . ' - Copie';

        $slugBase = Str::slug($copie->titre);
        $slug = $slugBase;
        $compteur = 1;

        while (CampagneMarketing::where('slug', $slug)->exists()) {
            $slug = $slugBase . '-' . $compteur++;
        }

        $copie->slug = $slug;
        $copie->statut = 'brouillon';
        $copie->est_active = false;
        $copie->budget_consomme = 0;
        $copie->save();

        return redirect()
            ->route('back.chambre-marketing.campagnes.details', $copie)
            ->with('success', 'Campagne dupliquée avec succès.');
    }

    public function supprimer(CampagneMarketing $campagneMarketing)
    {
        $campagneMarketing->delete();

        return redirect()
            ->route('back.chambre-marketing.campagnes.toutes')
            ->with('success', 'Campagne supprimée avec succès.');
    }
}
