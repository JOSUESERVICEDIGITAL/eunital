<?php

namespace App\Http\Controllers\Back\ChambreDeveloppement;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\ApiIntegration;
use App\Http\Controllers\Controller;
use App\Http\Requests\EnregistrerApiIntegrationRequest;
use App\Http\Requests\ModifierApiIntegrationRequest;

class ApiIntegrationController extends Controller
{
    public function listeToutes()
    {
        $apis = ApiIntegration::with('auteur')
            ->latest()
            ->paginate(12);

        return view('back.chambre-developpement.apis-integrations.liste', compact('apis'));
    }

    public function listeRest()
    {
        $apis = ApiIntegration::with('auteur')
            ->where('type_api', 'rest')
            ->latest()
            ->paginate(12);

        return view('back.chambre-developpement.apis-integrations.rest', compact('apis'));
    }

    public function listeGraphql()
    {
        $apis = ApiIntegration::with('auteur')
            ->where('type_api', 'graphql')
            ->latest()
            ->paginate(12);

        return view('back.chambre-developpement.apis-integrations.graphql', compact('apis'));
    }

    public function listeActives()
    {
        $apis = ApiIntegration::with('auteur')
            ->where('statut', 'active')
            ->latest()
            ->paginate(12);

        return view('back.chambre-developpement.apis-integrations.actives', compact('apis'));
    }

    public function formulaireCreation()
    {
        $utilisateurs = User::orderBy('name')->get();

        return view('back.chambre-developpement.apis-integrations.creer', compact('utilisateurs'));
    }

    public function enregistrer(EnregistrerApiIntegrationRequest $request)
    {
        $donnees = $request->validated();

        $slugBase = Str::slug($donnees['titre']);
        $slug = $slugBase;
        $compteur = 1;

        while (ApiIntegration::where('slug', $slug)->exists()) {
            $slug = $slugBase . '-' . $compteur++;
        }

        $api = ApiIntegration::create([
            'auteur_id' => $donnees['auteur_id'] ?? auth()->id(),
            'titre' => $donnees['titre'],
            'slug' => $slug,
            'description' => $donnees['description'] ?? null,
            'type_api' => $donnees['type_api'],
            'methode_authentification' => $donnees['methode_authentification'] ?? null,
            'url_base' => $donnees['url_base'] ?? null,
            'documentation_url' => $donnees['documentation_url'] ?? null,
            'statut' => $donnees['statut'],
        ]);

        return redirect()
            ->route('back.chambre-developpement.apis-integrations.details', $api)
            ->with('success', 'API / intégration enregistrée avec succès.');
    }

    public function details(ApiIntegration $apiIntegration)
    {
        $apiIntegration->load('auteur');

        return view('back.chambre-developpement.apis-integrations.details', compact('apiIntegration'));
    }

    public function formulaireEdition(ApiIntegration $apiIntegration)
    {
        $utilisateurs = User::orderBy('name')->get();

        return view('back.chambre-developpement.apis-integrations.modifier', compact('apiIntegration', 'utilisateurs'));
    }

    public function mettreAJour(ModifierApiIntegrationRequest $request, ApiIntegration $apiIntegration)
    {
        $donnees = $request->validated();

        $slug = $apiIntegration->slug;
        if ($apiIntegration->titre !== $donnees['titre']) {
            $slugBase = Str::slug($donnees['titre']);
            $slug = $slugBase;
            $compteur = 1;

            while (
                ApiIntegration::where('slug', $slug)
                    ->where('id', '!=', $apiIntegration->id)
                    ->exists()
            ) {
                $slug = $slugBase . '-' . $compteur++;
            }
        }

        $apiIntegration->update([
            'auteur_id' => $donnees['auteur_id'] ?? $apiIntegration->auteur_id,
            'titre' => $donnees['titre'],
            'slug' => $slug,
            'description' => $donnees['description'] ?? null,
            'type_api' => $donnees['type_api'],
            'methode_authentification' => $donnees['methode_authentification'] ?? null,
            'url_base' => $donnees['url_base'] ?? null,
            'documentation_url' => $donnees['documentation_url'] ?? null,
            'statut' => $donnees['statut'],
        ]);

        return back()->with('success', 'API / intégration mise à jour avec succès.');
    }

    public function activer(ApiIntegration $apiIntegration)
    {
        $apiIntegration->update(['statut' => 'active']);

        return back()->with('success', 'API / intégration activée.');
    }

    public function desactiver(ApiIntegration $apiIntegration)
    {
        $apiIntegration->update(['statut' => 'inactive']);

        return back()->with('success', 'API / intégration désactivée.');
    }

    public function archiver(ApiIntegration $apiIntegration)
    {
        $apiIntegration->update(['statut' => 'archivee']);

        return back()->with('success', 'API / intégration archivée.');
    }

    public function supprimer(ApiIntegration $apiIntegration)
    {
        $apiIntegration->delete();

        return redirect()
            ->route('back.chambre-developpement.apis-integrations.toutes')
            ->with('success', 'API / intégration supprimée avec succès.');
    }
}
