<?php

namespace App\Http\Controllers\Back\ChambreIngenieur;

use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\ReflexionStrategique;
use App\Http\Requests\EnregistrerReflexionStrategiqueRequest;
use App\Http\Requests\ModifierReflexionStrategiqueRequest;

class ReflexionStrategiqueController extends Controller
{
    public function listeToutes()
    {
        $reflexions = ReflexionStrategique::with('auteur')
            ->latest()
            ->paginate(12);

        return view('back.chambre-ingenieur.reflexions.liste', compact('reflexions'));
    }

    public function listeOuvertes()
    {
        $reflexions = ReflexionStrategique::with('auteur')
            ->where('statut', 'ouverte')
            ->latest()
            ->paginate(12);

        return view('back.chambre-ingenieur.reflexions.ouvertes', compact('reflexions'));
    }

    public function listeValidees()
    {
        $reflexions = ReflexionStrategique::with('auteur')
            ->where('statut', 'validee')
            ->latest()
            ->paginate(12);

        return view('back.chambre-ingenieur.reflexions.validees', compact('reflexions'));
    }

    public function listeArchivees()
    {
        $reflexions = ReflexionStrategique::with('auteur')
            ->where('statut', 'archivee')
            ->latest()
            ->paginate(12);

        return view('back.chambre-ingenieur.reflexions.archivees', compact('reflexions'));
    }

    public function formulaireCreation()
    {
        $utilisateurs = User::orderBy('name')->get();

        return view('back.chambre-ingenieur.reflexions.creer', compact('utilisateurs'));
    }

    public function enregistrer(EnregistrerReflexionStrategiqueRequest $request)
    {
        $donnees = $request->validated();

        $slugDeBase = Str::slug($donnees['titre']);
        $slugFinal = $slugDeBase;
        $compteur = 1;

        while (ReflexionStrategique::where('slug', $slugFinal)->exists()) {
            $slugFinal = $slugDeBase . '-' . $compteur;
            $compteur++;
        }

        $reflexion = ReflexionStrategique::create([
            'auteur_id' => $donnees['auteur_id'] ?? auth()->id(),
            'titre' => $donnees['titre'],
            'slug' => $slugFinal,
            'contexte' => $donnees['contexte'] ?? null,
            'analyse' => $donnees['analyse'] ?? null,
            'orientation_recommandee' => $donnees['orientation_recommandee'] ?? null,
            'impact_attendu' => $donnees['impact_attendu'] ?? null,
            'statut' => $donnees['statut'],
        ]);

        return redirect()
            ->route('back.chambre-ingenieur.reflexions.details', $reflexion)
            ->with('success', 'Réflexion stratégique enregistrée avec succès.');
    }

    public function details(ReflexionStrategique $reflexionStrategique)
    {
        $reflexionStrategique->load('auteur');

        return view('back.chambre-ingenieur.reflexions.details', compact('reflexionStrategique'));
    }

    public function formulaireEdition(ReflexionStrategique $reflexionStrategique)
    {
        $utilisateurs = User::orderBy('name')->get();

        return view('back.chambre-ingenieur.reflexions.modifier', compact('reflexionStrategique', 'utilisateurs'));
    }

    public function mettreAJour(ModifierReflexionStrategiqueRequest $request, ReflexionStrategique $reflexionStrategique)
    {
        $donnees = $request->validated();

        $slugFinal = $reflexionStrategique->slug;

        if ($reflexionStrategique->titre !== $donnees['titre']) {
            $slugDeBase = Str::slug($donnees['titre']);
            $slugFinal = $slugDeBase;
            $compteur = 1;

            while (
                ReflexionStrategique::where('slug', $slugFinal)
                    ->where('id', '!=', $reflexionStrategique->id)
                    ->exists()
            ) {
                $slugFinal = $slugDeBase . '-' . $compteur;
                $compteur++;
            }
        }

        $reflexionStrategique->update([
            'auteur_id' => $donnees['auteur_id'] ?? $reflexionStrategique->auteur_id,
            'titre' => $donnees['titre'],
            'slug' => $slugFinal,
            'contexte' => $donnees['contexte'] ?? null,
            'analyse' => $donnees['analyse'] ?? null,
            'orientation_recommandee' => $donnees['orientation_recommandee'] ?? null,
            'impact_attendu' => $donnees['impact_attendu'] ?? null,
            'statut' => $donnees['statut'],
        ]);

        return back()->with('success', 'Réflexion stratégique mise à jour avec succès.');
    }

    public function valider(ReflexionStrategique $reflexionStrategique)
    {
        $reflexionStrategique->update(['statut' => 'validee']);

        return back()->with('success', 'La réflexion a été validée.');
    }

    public function archiver(ReflexionStrategique $reflexionStrategique)
    {
        $reflexionStrategique->update(['statut' => 'archivee']);

        return back()->with('success', 'La réflexion a été archivée.');
    }

    public function rouvrir(ReflexionStrategique $reflexionStrategique)
    {
        $reflexionStrategique->update(['statut' => 'ouverte']);

        return back()->with('success', 'La réflexion a été rouverte.');
    }

    public function supprimer(ReflexionStrategique $reflexionStrategique)
    {
        $reflexionStrategique->delete();

        return redirect()
            ->route('back.chambre-ingenieur.reflexions.toutes')
            ->with('success', 'Réflexion stratégique supprimée avec succès.');
    }
}