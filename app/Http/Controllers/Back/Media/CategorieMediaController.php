<?php

namespace App\Http\Controllers\Back\Media;

use App\Models\CategorieMedia;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\EnregistrerCategorieMediaRequest;
use App\Http\Requests\ModifierCategorieMediaRequest;

class CategorieMediaController extends Controller
{
    public function listeToutes()
    {
        $categoriesMedias = CategorieMedia::withCount('medias')
            ->latest()
            ->paginate(12);

        return view('back.medias.categories.liste', compact('categoriesMedias'));
    }

    public function listeActives()
    {
        $categoriesMedias = CategorieMedia::withCount('medias')
            ->where('est_actif', true)
            ->latest()
            ->paginate(12);

        return view('back.medias.categories.actives', compact('categoriesMedias'));
    }

    public function listeInactives()
    {
        $categoriesMedias = CategorieMedia::withCount('medias')
            ->where('est_actif', false)
            ->latest()
            ->paginate(12);

        return view('back.medias.categories.inactives', compact('categoriesMedias'));
    }

    public function formulaireCreation()
    {
        return view('back.medias.categories.creer');
    }

    public function enregistrer(EnregistrerCategorieMediaRequest $request)
    {
        $donnees = $request->validated();

        $slugDeBase = Str::slug($donnees['nom']);
        $slugFinal = $slugDeBase;
        $compteur = 1;

        while (CategorieMedia::where('slug', $slugFinal)->exists()) {
            $slugFinal = $slugDeBase . '-' . $compteur;
            $compteur++;
        }

        $categorieMedia = CategorieMedia::create([
            'nom' => $donnees['nom'],
            'slug' => $slugFinal,
            'description' => $donnees['description'] ?? null,
            'est_actif' => $request->boolean('est_actif', true),
        ]);

        return redirect()
            ->route('back.medias.categories.details', $categorieMedia)
            ->with('success', 'Catégorie média créée avec succès.');
    }

    public function details(CategorieMedia $categorieMedia)
    {
        $categorieMedia->load('medias');

        return view('back.medias.categories.details', compact('categorieMedia'));
    }

    public function formulaireEdition(CategorieMedia $categorieMedia)
    {
        return view('back.medias.categories.modifier', compact('categorieMedia'));
    }

    public function mettreAJour(ModifierCategorieMediaRequest $request, CategorieMedia $categorieMedia)
    {
        $donnees = $request->validated();

        $slugFinal = $categorieMedia->slug;

        if ($categorieMedia->nom !== $donnees['nom']) {
            $slugDeBase = Str::slug($donnees['nom']);
            $slugFinal = $slugDeBase;
            $compteur = 1;

            while (
                CategorieMedia::where('slug', $slugFinal)
                    ->where('id', '!=', $categorieMedia->id)
                    ->exists()
            ) {
                $slugFinal = $slugDeBase . '-' . $compteur;
                $compteur++;
            }
        }

        $categorieMedia->update([
            'nom' => $donnees['nom'],
            'slug' => $slugFinal,
            'description' => $donnees['description'] ?? null,
            'est_actif' => $request->boolean('est_actif', false),
        ]);

        return back()->with('success', 'Catégorie média mise à jour avec succès.');
    }

    public function activer(CategorieMedia $categorieMedia)
    {
        $categorieMedia->update([
            'est_actif' => true,
        ]);

        return back()->with('success', 'Catégorie média activée.');
    }

    public function desactiver(CategorieMedia $categorieMedia)
    {
        $categorieMedia->update([
            'est_actif' => false,
        ]);

        return back()->with('success', 'Catégorie média désactivée.');
    }

    public function supprimer(CategorieMedia $categorieMedia)
    {
        if ($categorieMedia->medias()->count() > 0) {
            return back()->with('error', 'Impossible de supprimer cette catégorie car elle contient encore des médias.');
        }

        $categorieMedia->delete();

        return redirect()
            ->route('back.medias.categories.toutes')
            ->with('success', 'Catégorie média supprimée avec succès.');
    }
}