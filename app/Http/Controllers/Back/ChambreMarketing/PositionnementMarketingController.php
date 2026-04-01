<?php

namespace App\Http\Controllers\Back\ChambreMarketing;

use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\PositionnementMarketing;
use App\Http\Requests\EnregistrerPositionnementMarketingRequest;
use App\Http\Requests\ModifierPositionnementMarketingRequest;

class PositionnementMarketingController extends Controller
{
    public function listeTous()
    {
        $positionnements = PositionnementMarketing::with('auteur')
            ->latest()
            ->paginate(12);

        return view('back.chambre-marketing.positionnements.liste', compact('positionnements'));
    }

    public function listeActifs()
    {
        $positionnements = PositionnementMarketing::with('auteur')
            ->where('statut', 'actif')
            ->latest()
            ->paginate(12);

        return view('back.chambre-marketing.positionnements.actifs', compact('positionnements'));
    }

    public function listeARevoir()
    {
        $positionnements = PositionnementMarketing::with('auteur')
            ->where('statut', 'a_revoir')
            ->latest()
            ->paginate(12);

        return view('back.chambre-marketing.positionnements.a-revoir', compact('positionnements'));
    }

    public function formulaireCreation()
    {
        $utilisateurs = User::orderBy('name')->get();

        return view('back.chambre-marketing.positionnements.creer', compact('utilisateurs'));
    }

    public function enregistrer(EnregistrerPositionnementMarketingRequest $request)
    {
        $donnees = $request->validated();

        $slugBase = Str::slug($donnees['titre']);
        $slug = $slugBase;
        $compteur = 1;

        while (PositionnementMarketing::where('slug', $slug)->exists()) {
            $slug = $slugBase . '-' . $compteur++;
        }

        $positionnement = PositionnementMarketing::create([
            'auteur_id' => $donnees['auteur_id'] ?? auth()->id(),
            'titre' => $donnees['titre'],
            'slug' => $slug,
            'segment_cible' => $donnees['segment_cible'] ?? null,
            'probleme_adresse' => $donnees['probleme_adresse'] ?? null,
            'promesse' => $donnees['promesse'] ?? null,
            'differenciation' => $donnees['differenciation'] ?? null,
            'message_central' => $donnees['message_central'] ?? null,
            'canal_principal' => $donnees['canal_principal'] ?? null,
            'statut' => $donnees['statut'],
        ]);

        return redirect()
            ->route('back.chambre-marketing.positionnements.details', $positionnement)
            ->with('success', 'Positionnement marketing enregistré avec succès.');
    }

    public function details(PositionnementMarketing $positionnementMarketing)
    {
        $positionnementMarketing->load('auteur');

        return view('back.chambre-marketing.positionnements.details', compact('positionnementMarketing'));
    }

    public function formulaireEdition(PositionnementMarketing $positionnementMarketing)
    {
        $utilisateurs = User::orderBy('name')->get();

        return view('back.chambre-marketing.positionnements.modifier', compact('positionnementMarketing', 'utilisateurs'));
    }

    public function mettreAJour(ModifierPositionnementMarketingRequest $request, PositionnementMarketing $positionnementMarketing)
    {
        $donnees = $request->validated();

        $slug = $positionnementMarketing->slug;

        if ($positionnementMarketing->titre !== $donnees['titre']) {
            $slugBase = Str::slug($donnees['titre']);
            $slug = $slugBase;
            $compteur = 1;

            while (
                PositionnementMarketing::where('slug', $slug)
                    ->where('id', '!=', $positionnementMarketing->id)
                    ->exists()
            ) {
                $slug = $slugBase . '-' . $compteur++;
            }
        }

        $positionnementMarketing->update([
            'auteur_id' => $donnees['auteur_id'] ?? $positionnementMarketing->auteur_id,
            'titre' => $donnees['titre'],
            'slug' => $slug,
            'segment_cible' => $donnees['segment_cible'] ?? null,
            'probleme_adresse' => $donnees['probleme_adresse'] ?? null,
            'promesse' => $donnees['promesse'] ?? null,
            'differenciation' => $donnees['differenciation'] ?? null,
            'message_central' => $donnees['message_central'] ?? null,
            'canal_principal' => $donnees['canal_principal'] ?? null,
            'statut' => $donnees['statut'],
        ]);

        return back()->with('success', 'Positionnement marketing mis à jour avec succès.');
    }

    public function activer(PositionnementMarketing $positionnementMarketing)
    {
        $positionnementMarketing->update(['statut' => 'actif']);

        return back()->with('success', 'Positionnement activé.');
    }

    public function marquerARevoir(PositionnementMarketing $positionnementMarketing)
    {
        $positionnementMarketing->update(['statut' => 'a_revoir']);

        return back()->with('success', 'Positionnement marqué à revoir.');
    }

    public function archiver(PositionnementMarketing $positionnementMarketing)
    {
        $positionnementMarketing->update(['statut' => 'archive']);

        return back()->with('success', 'Positionnement archivé.');
    }

    public function supprimer(PositionnementMarketing $positionnementMarketing)
    {
        $positionnementMarketing->delete();

        return redirect()
            ->route('back.chambre-marketing.positionnements.tous')
            ->with('success', 'Positionnement supprimé avec succès.');
    }
}
