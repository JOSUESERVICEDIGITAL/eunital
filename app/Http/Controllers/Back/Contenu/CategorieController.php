<?php

namespace App\Http\Controllers\Back\Contenu;

use App\Models\Categorie;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\EnregistrerCategorieRequest;
use App\Http\Requests\ModifierCategorieRequest;

class CategorieController extends Controller
{
    public function listeToutes()
    {
        $categories = Categorie::with(['categorieParente', 'sousCategories', 'articles'])
            ->latest()
            ->paginate(12);

        return view('back.contenus.categories.liste', compact('categories'));
    }

    public function listeActives()
    {
        $categories = Categorie::with(['categorieParente', 'sousCategories', 'articles'])
            ->where('est_active', true)
            ->latest()
            ->paginate(12);

        return view('back.contenus.categories.actives', compact('categories'));
    }

    public function listeInactives()
    {
        $categories = Categorie::with(['categorieParente', 'sousCategories', 'articles'])
            ->where('est_active', false)
            ->latest()
            ->paginate(12);

        return view('back.contenus.categories.inactives', compact('categories'));
    }

    public function formulaireCreation()
    {
        $categoriesParentes = Categorie::where('est_active', true)
            ->orderBy('nom')
            ->get();

        return view('back.contenus.categories.creer', compact('categoriesParentes'));
    }

    public function enregistrer(EnregistrerCategorieRequest $request)
    {
        $donnees = $request->validated();

        $donnees['slug'] = Str::slug($donnees['nom']) . '-' . uniqid();
        $donnees['est_active'] = $request->boolean('est_active', true);

        Categorie::create($donnees);

        return redirect()
            ->route('back.categories.toutes')
            ->with('succes', 'Catégorie enregistrée avec succès.');
    }

    public function details(Categorie $categorie)
    {
        $categorie->load([
            'categorieParente',
            'sousCategories',
            'articles',
        ]);

        return view('back.contenus.categories.details', compact('categorie'));
    }

    public function formulaireEdition(Categorie $categorie)
    {
        $categoriesParentes = Categorie::where('id', '!=', $categorie->id)
            ->orderBy('nom')
            ->get();

        return view('back.contenus.categories.modifier', compact('categorie', 'categoriesParentes'));
    }

    public function mettreAJour(ModifierCategorieRequest $request, Categorie $categorie)
    {
        $donnees = $request->validated();

        if ($categorie->nom !== $donnees['nom']) {
            $donnees['slug'] = Str::slug($donnees['nom']) . '-' . uniqid();
        }

        $donnees['est_active'] = $request->boolean('est_active', false);

        if (
            isset($donnees['categorie_parente_id']) &&
            (int) $donnees['categorie_parente_id'] === (int) $categorie->id
        ) {
            return back()
                ->withErrors([
                    'categorie_parente_id' => 'Une catégorie ne peut pas être sa propre catégorie parente.',
                ])
                ->withInput();
        }

        $categorie->update($donnees);

        return redirect()
            ->route('back.categories.toutes')
            ->with('succes', 'Catégorie modifiée avec succès.');
    }

    public function activer(Categorie $categorie)
    {
        $categorie->update([
            'est_active' => true,
        ]);

        return back()->with('succes', 'Catégorie activée avec succès.');
    }

    public function desactiver(Categorie $categorie)
    {
        $categorie->update([
            'est_active' => false,
        ]);

        return back()->with('succes', 'Catégorie désactivée avec succès.');
    }

    public function supprimer(Categorie $categorie)
    {
        if ($categorie->articles()->count() > 0) {
            return back()->withErrors([
                'suppression' => 'Impossible de supprimer cette catégorie car elle contient déjà des articles.',
            ]);
        }

        if ($categorie->sousCategories()->count() > 0) {
            return back()->withErrors([
                'suppression' => 'Impossible de supprimer cette catégorie car elle possède des sous-catégories.',
            ]);
        }

        $categorie->delete();

        return back()->with('succes', 'Catégorie supprimée avec succès.');
    }
}