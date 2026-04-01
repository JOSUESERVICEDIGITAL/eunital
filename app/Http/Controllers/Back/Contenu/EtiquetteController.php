<?php

namespace App\Http\Controllers\Back\Contenu;

use App\Models\Etiquette;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\EnregistrerEtiquetteRequest;
use App\Http\Requests\ModifierEtiquetteRequest;

class EtiquetteController extends Controller
{
    public function listeToutes()
    {
        $etiquettes = Etiquette::withCount('articles')
            ->orderBy('nom')
            ->paginate(15);

        return view('back.contenus.etiquettes.liste', compact('etiquettes'));
    }

    public function formulaireCreation()
    {
        return view('back.contenus.etiquettes.creer');
    }

    public function enregistrer(EnregistrerEtiquetteRequest $request)
    {
        $donnees = $request->validated();

        $slugDeBase = Str::slug($donnees['nom']);
        $slugFinal = $slugDeBase;
        $compteur = 1;

        while (Etiquette::where('slug', $slugFinal)->exists()) {
            $slugFinal = $slugDeBase . '-' . $compteur;
            $compteur++;
        }

        Etiquette::create([
            'nom' => $donnees['nom'],
            'slug' => $slugFinal,
        ]);

        return redirect()
            ->route('back.etiquettes.toutes')
            ->with('succes', 'Étiquette enregistrée avec succès.');
    }

    public function details(Etiquette $etiquette)
    {
        $etiquette->load(['articles.categorie', 'articles.auteur']);

        return view('back.contenus.etiquettes.details', compact('etiquette'));
    }

    public function formulaireEdition(Etiquette $etiquette)
    {
        return view('back.contenus.etiquettes.modifier', compact('etiquette'));
    }

    public function mettreAJour(ModifierEtiquetteRequest $request, Etiquette $etiquette)
    {
        $donnees = $request->validated();

        $slugFinal = $etiquette->slug;

        if ($etiquette->nom !== $donnees['nom']) {
            $slugDeBase = Str::slug($donnees['nom']);
            $slugFinal = $slugDeBase;
            $compteur = 1;

            while (
                Etiquette::where('slug', $slugFinal)
                    ->where('id', '!=', $etiquette->id)
                    ->exists()
            ) {
                $slugFinal = $slugDeBase . '-' . $compteur;
                $compteur++;
            }
        }

        $etiquette->update([
            'nom' => $donnees['nom'],
            'slug' => $slugFinal,
        ]);

        return redirect()
            ->route('back.etiquettes.toutes')
            ->with('succes', 'Étiquette modifiée avec succès.');
    }

    public function supprimer(Etiquette $etiquette)
    {
        if ($etiquette->articles()->count() > 0) {
            $etiquette->articles()->detach();
        }

        $etiquette->delete();

        return back()->with('succes', 'Étiquette supprimée avec succès.');
    }
}