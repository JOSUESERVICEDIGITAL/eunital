<?php

namespace App\Http\Controllers\Back\Contenu;

use App\Models\Article;
use App\Models\Categorie;
use App\Models\Etiquette;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\EnregistrerArticleRequest;
use App\Http\Requests\ModifierArticleRequest;

class ArticleController extends Controller
{
    public function tableauDeBord()
    {
        $totalArticles = Article::count();
        $articlesPublies = Article::where('statut', 'publie')->count();
        $articlesBrouillons = Article::where('statut', 'brouillon')->count();
        $articlesArchives = Article::where('statut', 'archive')->count();

        return view('back.contenus.articles.tableau-de-bord', compact(
            'totalArticles',
            'articlesPublies',
            'articlesBrouillons',
            'articlesArchives'
        ));
    }

    public function listeTous()
    {
        $articles = Article::with(['categorie', 'auteur'])->latest()->paginate(10);

        return view('back.contenus.articles.liste', compact('articles'));
    }

    public function listePublies()
    {
        $articles = Article::with(['categorie', 'auteur'])
            ->where('statut', 'publie')
            ->latest()
            ->paginate(10);

        return view('back.contenus.articles.publies', compact('articles'));
    }

    public function listeBrouillons()
    {
        $articles = Article::with(['categorie', 'auteur'])
            ->where('statut', 'brouillon')
            ->latest()
            ->paginate(10);

        return view('back.contenus.articles.brouillons', compact('articles'));
    }

    public function listeArchives()
    {
        $articles = Article::with(['categorie', 'auteur'])
            ->where('statut', 'archive')
            ->latest()
            ->paginate(10);

        return view('back.contenus.articles.archives', compact('articles'));
    }

    public function formulaireCreation()
    {
        $categories = Categorie::orderBy('nom')->get();
        $etiquettes = Etiquette::orderBy('nom')->get();

        return view('back.contenus.articles.creer', compact('categories', 'etiquettes'));
    }

    public function enregistrer(EnregistrerArticleRequest $request)
    {
        $donnees = $request->validated();

        if ($request->hasFile('image_principale')) {
            $donnees['image_principale'] = $request->file('image_principale')->store('articles', 'public');
        }

        $donnees['user_id'] = auth()->id();
        $donnees['slug'] = Str::slug($donnees['titre']) . '-' . uniqid();

        if (($donnees['statut'] ?? null) === 'publie' && empty($donnees['date_publication'])) {
            $donnees['date_publication'] = now();
        }

        $article = Article::create($donnees);
        $article->etiquettes()->sync($request->input('etiquettes', []));

        return redirect()->route('back.articles.tous')->with('succes', 'Article enregistré avec succès.');
    }

    public function details(Article $article)
    {
        $article->load(['categorie', 'auteur', 'etiquettes', 'commentaires']);

        return view('back.contenus.articles.details', compact('article'));
    }

    public function formulaireEdition(Article $article)
    {
        $categories = Categorie::orderBy('nom')->get();
        $etiquettes = Etiquette::orderBy('nom')->get();

        return view('back.contenus.articles.modifier', compact('article', 'categories', 'etiquettes'));
    }

    public function mettreAJour(ModifierArticleRequest $request, Article $article)
    {
        $donnees = $request->validated();

        if ($request->hasFile('image_principale')) {
            if ($article->image_principale && Storage::disk('public')->exists($article->image_principale)) {
                Storage::disk('public')->delete($article->image_principale);
            }

            $donnees['image_principale'] = $request->file('image_principale')->store('articles', 'public');
        }

        if (($donnees['statut'] ?? null) === 'publie' && empty($article->date_publication)) {
            $donnees['date_publication'] = now();
        }

        $article->update($donnees);
        $article->etiquettes()->sync($request->input('etiquettes', []));

        return redirect()->route('back.articles.tous')->with('succes', 'Article mis à jour avec succès.');
    }

    public function publier(Article $article)
    {
        $article->update([
            'statut' => 'publie',
            'date_publication' => now(),
        ]);

        return back()->with('succes', 'Article publié avec succès.');
    }

    public function mettreEnBrouillon(Article $article)
    {
        $article->update([
            'statut' => 'brouillon',
        ]);

        return back()->with('succes', 'Article remis en brouillon.');
    }

    public function archiver(Article $article)
    {
        $article->update([
            'statut' => 'archive',
        ]);

        return back()->with('succes', 'Article archivé avec succès.');
    }

    public function mettreEnAvant(Article $article)
    {
        $article->update([
            'est_mis_en_avant' => true,
        ]);

        return back()->with('succes', 'Article mis en avant.');
    }

    public function retirerDeLaMiseEnAvant(Article $article)
    {
        $article->update([
            'est_mis_en_avant' => false,
        ]);

        return back()->with('succes', 'Article retiré de la mise en avant.');
    }

    public function activerCommentaires(Article $article)
    {
        $article->update([
            'commentaires_actives' => true,
        ]);

        return back()->with('succes', 'Commentaires activés.');
    }

    public function desactiverCommentaires(Article $article)
    {
        $article->update([
            'commentaires_actives' => false,
        ]);

        return back()->with('succes', 'Commentaires désactivés.');
    }

    public function supprimerImagePrincipale(Article $article)
    {
        if ($article->image_principale && Storage::disk('public')->exists($article->image_principale)) {
            Storage::disk('public')->delete($article->image_principale);
        }

        $article->update([
            'image_principale' => null,
        ]);

        return back()->with('succes', 'Image principale supprimée.');
    }

    public function supprimer(Article $article)
    {
        if ($article->image_principale && Storage::disk('public')->exists($article->image_principale)) {
            Storage::disk('public')->delete($article->image_principale);
        }

        $article->delete();

        return back()->with('succes', 'Article supprimé avec succès.');
    }
}