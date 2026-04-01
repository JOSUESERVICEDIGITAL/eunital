<?php

namespace App\Http\Controllers\Back\ChambreDeveloppement;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\DepotVersion;
use App\Http\Controllers\Controller;
use App\Http\Requests\EnregistrerDepotVersionRequest;
use App\Http\Requests\ModifierDepotVersionRequest;

class DepotVersionController extends Controller
{
    public function listeTous()
    {
        $depots = DepotVersion::with('auteur')
            ->latest()
            ->paginate(12);

        return view('back.chambre-developpement.depots-versions.liste', compact('depots'));
    }

    public function listeActifs()
    {
        $depots = DepotVersion::with('auteur')
            ->where('statut', 'actif')
            ->latest()
            ->paginate(12);

        return view('back.chambre-developpement.depots-versions.actifs', compact('depots'));
    }

    public function listeDeployes()
    {
        $depots = DepotVersion::with('auteur')
            ->where('statut', 'deploie')
            ->latest()
            ->paginate(12);

        return view('back.chambre-developpement.depots-versions.deployes', compact('depots'));
    }

    public function listeHotfix()
    {
        $depots = DepotVersion::with('auteur')
            ->where('type_version', 'hotfix')
            ->latest()
            ->paginate(12);

        return view('back.chambre-developpement.depots-versions.hotfix', compact('depots'));
    }

    public function formulaireCreation()
    {
        $utilisateurs = User::orderBy('name')->get();

        return view('back.chambre-developpement.depots-versions.creer', compact('utilisateurs'));
    }

    public function enregistrer(EnregistrerDepotVersionRequest $request)
    {
        $donnees = $request->validated();

        $slugBase = Str::slug($donnees['titre']);
        $slug = $slugBase;
        $compteur = 1;

        while (DepotVersion::where('slug', $slug)->exists()) {
            $slug = $slugBase . '-' . $compteur++;
        }

        $depot = DepotVersion::create([
            'auteur_id' => $donnees['auteur_id'] ?? auth()->id(),
            'titre' => $donnees['titre'],
            'slug' => $slug,
            'description' => $donnees['description'] ?? null,
            'url_depot' => $donnees['url_depot'] ?? null,
            'branche_principale' => $donnees['branche_principale'] ?? null,
            'version_actuelle' => $donnees['version_actuelle'] ?? '1.0.0',
            'type_version' => $donnees['type_version'],
            'statut' => $donnees['statut'],
        ]);

        return redirect()
            ->route('back.chambre-developpement.depots-versions.details', $depot)
            ->with('success', 'Dépôt / version enregistré avec succès.');
    }

    public function details(DepotVersion $depotVersion)
    {
        $depotVersion->load('auteur');

        return view('back.chambre-developpement.depots-versions.details', compact('depotVersion'));
    }

    public function formulaireEdition(DepotVersion $depotVersion)
    {
        $utilisateurs = User::orderBy('name')->get();

        return view('back.chambre-developpement.depots-versions.modifier', compact('depotVersion', 'utilisateurs'));
    }

    public function mettreAJour(ModifierDepotVersionRequest $request, DepotVersion $depotVersion)
    {
        $donnees = $request->validated();

        $slug = $depotVersion->slug;
        if ($depotVersion->titre !== $donnees['titre']) {
            $slugBase = Str::slug($donnees['titre']);
            $slug = $slugBase;
            $compteur = 1;

            while (
                DepotVersion::where('slug', $slug)
                    ->where('id', '!=', $depotVersion->id)
                    ->exists()
            ) {
                $slug = $slugBase . '-' . $compteur++;
            }
        }

        $depotVersion->update([
            'auteur_id' => $donnees['auteur_id'] ?? $depotVersion->auteur_id,
            'titre' => $donnees['titre'],
            'slug' => $slug,
            'description' => $donnees['description'] ?? null,
            'url_depot' => $donnees['url_depot'] ?? null,
            'branche_principale' => $donnees['branche_principale'] ?? null,
            'version_actuelle' => $donnees['version_actuelle'] ?? $depotVersion->version_actuelle,
            'type_version' => $donnees['type_version'],
            'statut' => $donnees['statut'],
        ]);

        return back()->with('success', 'Dépôt / version mis à jour avec succès.');
    }

    public function marquerCommeDeploie(DepotVersion $depotVersion)
    {
        $depotVersion->update(['statut' => 'deploie']);

        return back()->with('success', 'Version marquée comme déployée.');
    }

    public function geler(DepotVersion $depotVersion)
    {
        $depotVersion->update(['statut' => 'gele']);

        return back()->with('success', 'Dépôt / version gelé.');
    }

    public function reactiver(DepotVersion $depotVersion)
    {
        $depotVersion->update(['statut' => 'actif']);

        return back()->with('success', 'Dépôt / version réactivé.');
    }

    public function archiver(DepotVersion $depotVersion)
    {
        $depotVersion->update(['statut' => 'archive']);

        return back()->with('success', 'Dépôt / version archivé.');
    }

    public function supprimer(DepotVersion $depotVersion)
    {
        $depotVersion->delete();

        return redirect()
            ->route('back.chambre-developpement.depots-versions.tous')
            ->with('success', 'Dépôt / version supprimé avec succès.');
    }
}
