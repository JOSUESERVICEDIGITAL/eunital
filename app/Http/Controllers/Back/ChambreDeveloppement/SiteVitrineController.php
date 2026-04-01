<?php

namespace App\Http\Controllers\Back\ChambreDeveloppement;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\SiteVitrine;
use App\Http\Controllers\Controller;
use App\Http\Requests\EnregistrerSiteVitrineRequest;
use App\Http\Requests\ModifierSiteVitrineRequest;

class SiteVitrineController extends Controller
{
    public function listeTous()
    {
        $sites = SiteVitrine::with('auteur')
            ->latest()
            ->paginate(12);

        return view('back.chambre-developpement.sites-vitrines.liste', compact('sites'));
    }

    public function listeMaquettes()
    {
        $sites = SiteVitrine::with('auteur')
            ->where('statut', 'maquette')
            ->latest()
            ->paginate(12);

        return view('back.chambre-developpement.sites-vitrines.maquettes', compact('sites'));
    }

    public function listeEnDeveloppement()
    {
        $sites = SiteVitrine::with('auteur')
            ->where('statut', 'en_developpement')
            ->latest()
            ->paginate(12);

        return view('back.chambre-developpement.sites-vitrines.developpement', compact('sites'));
    }

    public function listeLivres()
    {
        $sites = SiteVitrine::with('auteur')
            ->where('statut', 'livre')
            ->latest()
            ->paginate(12);

        return view('back.chambre-developpement.sites-vitrines.livres', compact('sites'));
    }

    public function listeEnLigne()
    {
        $sites = SiteVitrine::with('auteur')
            ->where('statut', 'en_ligne')
            ->latest()
            ->paginate(12);

        return view('back.chambre-developpement.sites-vitrines.en-ligne', compact('sites'));
    }

    public function formulaireCreation()
    {
        $utilisateurs = User::orderBy('name')->get();

        return view('back.chambre-developpement.sites-vitrines.creer', compact('utilisateurs'));
    }

    public function enregistrer(EnregistrerSiteVitrineRequest $request)
    {
        $donnees = $request->validated();

        $slugBase = Str::slug($donnees['titre']);
        $slug = $slugBase;
        $compteur = 1;

        while (SiteVitrine::where('slug', $slug)->exists()) {
            $slug = $slugBase . '-' . $compteur++;
        }

        $site = SiteVitrine::create([
            'auteur_id' => $donnees['auteur_id'] ?? auth()->id(),
            'titre' => $donnees['titre'],
            'slug' => $slug,
            'description' => $donnees['description'] ?? null,
            'client' => $donnees['client'] ?? null,
            'url_site' => $donnees['url_site'] ?? null,
            'technologies' => $donnees['technologies'] ?? null,
            'statut' => $donnees['statut'],
            'date_livraison_prevue' => $donnees['date_livraison_prevue'] ?? null,
        ]);

        return redirect()
            ->route('back.chambre-developpement.sites-vitrines.details', $site)
            ->with('success', 'Site vitrine enregistré avec succès.');
    }

    public function details(SiteVitrine $siteVitrine)
    {
        $siteVitrine->load('auteur');

        return view('back.chambre-developpement.sites-vitrines.details', compact('siteVitrine'));
    }

    public function formulaireEdition(SiteVitrine $siteVitrine)
    {
        $utilisateurs = User::orderBy('name')->get();

        return view('back.chambre-developpement.sites-vitrines.modifier', compact('siteVitrine', 'utilisateurs'));
    }

    public function mettreAJour(ModifierSiteVitrineRequest $request, SiteVitrine $siteVitrine)
    {
        $donnees = $request->validated();

        $slug = $siteVitrine->slug;
        if ($siteVitrine->titre !== $donnees['titre']) {
            $slugBase = Str::slug($donnees['titre']);
            $slug = $slugBase;
            $compteur = 1;

            while (
                SiteVitrine::where('slug', $slug)
                    ->where('id', '!=', $siteVitrine->id)
                    ->exists()
            ) {
                $slug = $slugBase . '-' . $compteur++;
            }
        }

        $siteVitrine->update([
            'auteur_id' => $donnees['auteur_id'] ?? $siteVitrine->auteur_id,
            'titre' => $donnees['titre'],
            'slug' => $slug,
            'description' => $donnees['description'] ?? null,
            'client' => $donnees['client'] ?? null,
            'url_site' => $donnees['url_site'] ?? null,
            'technologies' => $donnees['technologies'] ?? null,
            'statut' => $donnees['statut'],
            'date_livraison_prevue' => $donnees['date_livraison_prevue'] ?? null,
        ]);

        return back()->with('success', 'Site vitrine mis à jour avec succès.');
    }

    public function marquerCommeLivre(SiteVitrine $siteVitrine)
    {
        $siteVitrine->update(['statut' => 'livre']);

        return back()->with('success', 'Site marqué comme livré.');
    }

    public function mettreEnLigne(SiteVitrine $siteVitrine)
    {
        $siteVitrine->update(['statut' => 'en_ligne']);

        return back()->with('success', 'Site mis en ligne.');
    }

    public function archiver(SiteVitrine $siteVitrine)
    {
        $siteVitrine->update(['statut' => 'archive']);

        return back()->with('success', 'Site archivé.');
    }

    public function supprimer(SiteVitrine $siteVitrine)
    {
        $siteVitrine->delete();

        return redirect()
            ->route('back.chambre-developpement.sites-vitrines.tous')
            ->with('success', 'Site vitrine supprimé avec succès.');
    }
}
