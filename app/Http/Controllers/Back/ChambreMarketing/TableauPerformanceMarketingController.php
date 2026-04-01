<?php

namespace App\Http\Controllers\Back\ChambreMarketing;

use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\CampagneMarketing;
use App\Models\TableauPerformanceMarketing;
use App\Http\Requests\EnregistrerTableauPerformanceMarketingRequest;
use App\Http\Requests\ModifierTableauPerformanceMarketingRequest;

class TableauPerformanceMarketingController extends Controller
{
    public function listeTous()
    {
        $tableaux = TableauPerformanceMarketing::with(['auteur', 'campagne'])
            ->latest()
            ->paginate(12);

        return view('back.chambre-marketing.tableaux-performance.liste', compact('tableaux'));
    }

    public function listePublies()
    {
        $tableaux = TableauPerformanceMarketing::with(['auteur', 'campagne'])
            ->where('statut', 'publie')
            ->latest()
            ->paginate(12);

        return view('back.chambre-marketing.tableaux-performance.publies', compact('tableaux'));
    }

    public function listeBrouillons()
    {
        $tableaux = TableauPerformanceMarketing::with(['auteur', 'campagne'])
            ->where('statut', 'brouillon')
            ->latest()
            ->paginate(12);

        return view('back.chambre-marketing.tableaux-performance.brouillons', compact('tableaux'));
    }

    public function formulaireCreation()
    {
        $utilisateurs = User::orderBy('name')->get();
        $campagnes = CampagneMarketing::orderBy('titre')->get();

        return view('back.chambre-marketing.tableaux-performance.creer', compact('utilisateurs', 'campagnes'));
    }

    public function enregistrer(EnregistrerTableauPerformanceMarketingRequest $request)
    {
        $donnees = $request->validated();

        $slugBase = Str::slug($donnees['titre']);
        $slug = $slugBase;
        $compteur = 1;

        while (TableauPerformanceMarketing::where('slug', $slug)->exists()) {
            $slug = $slugBase . '-' . $compteur++;
        }

        $tableau = TableauPerformanceMarketing::create([
            'auteur_id' => $donnees['auteur_id'] ?? auth()->id(),
            'campagne_marketing_id' => $donnees['campagne_marketing_id'] ?? null,
            'titre' => $donnees['titre'],
            'slug' => $slug,
            'impressions' => $donnees['impressions'] ?? 0,
            'clics' => $donnees['clics'] ?? 0,
            'conversions' => $donnees['conversions'] ?? 0,
            'leads' => $donnees['leads'] ?? 0,
            'ventes' => $donnees['ventes'] ?? 0,
            'ctr' => $donnees['ctr'] ?? null,
            'cpc' => $donnees['cpc'] ?? null,
            'cpm' => $donnees['cpm'] ?? null,
            'roas' => $donnees['roas'] ?? null,
            'cout_total' => $donnees['cout_total'] ?? 0,
            'revenu_genere' => $donnees['revenu_genere'] ?? 0,
            'periode_debut' => $donnees['periode_debut'] ?? null,
            'periode_fin' => $donnees['periode_fin'] ?? null,
            'statut' => $donnees['statut'],
        ]);

        return redirect()
            ->route('back.chambre-marketing.tableaux-performance.details', $tableau)
            ->with('success', 'Tableau de performance enregistré avec succès.');
    }

    public function details(TableauPerformanceMarketing $tableauPerformanceMarketing)
    {
        $tableauPerformanceMarketing->load(['auteur', 'campagne']);

        return view('back.chambre-marketing.tableaux-performance.details', compact('tableauPerformanceMarketing'));
    }

    public function formulaireEdition(TableauPerformanceMarketing $tableauPerformanceMarketing)
    {
        $utilisateurs = User::orderBy('name')->get();
        $campagnes = CampagneMarketing::orderBy('titre')->get();

        return view('back.chambre-marketing.tableaux-performance.modifier', compact('tableauPerformanceMarketing', 'utilisateurs', 'campagnes'));
    }

    public function mettreAJour(ModifierTableauPerformanceMarketingRequest $request, TableauPerformanceMarketing $tableauPerformanceMarketing)
    {
        $donnees = $request->validated();

        $slug = $tableauPerformanceMarketing->slug;

        if ($tableauPerformanceMarketing->titre !== $donnees['titre']) {
            $slugBase = Str::slug($donnees['titre']);
            $slug = $slugBase;
            $compteur = 1;

            while (
                TableauPerformanceMarketing::where('slug', $slug)
                    ->where('id', '!=', $tableauPerformanceMarketing->id)
                    ->exists()
            ) {
                $slug = $slugBase . '-' . $compteur++;
            }
        }

        $tableauPerformanceMarketing->update([
            'auteur_id' => $donnees['auteur_id'] ?? $tableauPerformanceMarketing->auteur_id,
            'campagne_marketing_id' => $donnees['campagne_marketing_id'] ?? null,
            'titre' => $donnees['titre'],
            'slug' => $slug,
            'impressions' => $donnees['impressions'] ?? 0,
            'clics' => $donnees['clics'] ?? 0,
            'conversions' => $donnees['conversions'] ?? 0,
            'leads' => $donnees['leads'] ?? 0,
            'ventes' => $donnees['ventes'] ?? 0,
            'ctr' => $donnees['ctr'] ?? null,
            'cpc' => $donnees['cpc'] ?? null,
            'cpm' => $donnees['cpm'] ?? null,
            'roas' => $donnees['roas'] ?? null,
            'cout_total' => $donnees['cout_total'] ?? 0,
            'revenu_genere' => $donnees['revenu_genere'] ?? 0,
            'periode_debut' => $donnees['periode_debut'] ?? null,
            'periode_fin' => $donnees['periode_fin'] ?? null,
            'statut' => $donnees['statut'],
        ]);

        return back()->with('success', 'Tableau de performance mis à jour avec succès.');
    }

    public function publier(TableauPerformanceMarketing $tableauPerformanceMarketing)
    {
        $tableauPerformanceMarketing->update(['statut' => 'publie']);

        return back()->with('success', 'Tableau de performance publié.');
    }

    public function remettreEnBrouillon(TableauPerformanceMarketing $tableauPerformanceMarketing)
    {
        $tableauPerformanceMarketing->update(['statut' => 'brouillon']);

        return back()->with('success', 'Tableau remis en brouillon.');
    }

    public function archiver(TableauPerformanceMarketing $tableauPerformanceMarketing)
    {
        $tableauPerformanceMarketing->update(['statut' => 'archive']);

        return back()->with('success', 'Tableau de performance archivé.');
    }

    public function supprimer(TableauPerformanceMarketing $tableauPerformanceMarketing)
    {
        $tableauPerformanceMarketing->delete();

        return redirect()
            ->route('back.chambre-marketing.tableaux-performance.tous')
            ->with('success', 'Tableau de performance supprimé avec succès.');
    }
}
