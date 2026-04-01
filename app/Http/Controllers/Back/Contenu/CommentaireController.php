<?php

namespace App\Http\Controllers\Back\Contenu;

use App\Models\Commentaire;
use App\Http\Controllers\Controller;

class CommentaireController extends Controller
{
    public function listeTous()
    {
        $commentaires = Commentaire::with([
                'article:id,titre,slug',
                'auteur:id,name',
                'parent:id,contenu'
            ])
            ->latest()
            ->paginate(20);

        return view('back.contenus.commentaires.liste', compact('commentaires'));
    }

    public function listeEnAttente()
    {
        $commentaires = Commentaire::with([
                'article:id,titre,slug',
                'auteur:id,name',
                'parent:id,contenu'
            ])
            ->where('statut', 'en_attente')
            ->latest()
            ->paginate(20);

        return view('back.contenus.commentaires.en-attente', compact('commentaires'));
    }

    public function listeValides()
    {
        $commentaires = Commentaire::with([
                'article:id,titre,slug',
                'auteur:id,name',
                'parent:id,contenu'
            ])
            ->where('statut', 'valide')
            ->latest()
            ->paginate(20);

        return view('back.contenus.commentaires.valides', compact('commentaires'));
    }

    public function listeRejetes()
    {
        $commentaires = Commentaire::with([
                'article:id,titre,slug',
                'auteur:id,name',
                'parent:id,contenu'
            ])
            ->where('statut', 'rejete')
            ->latest()
            ->paginate(20);

        return view('back.contenus.commentaires.rejetes', compact('commentaires'));
    }

    public function details(Commentaire $commentaire)
    {
        $commentaire->load([
            'article:id,titre,slug',
            'auteur:id,name,email',
            'parent:id,contenu',
            'reponses.article:id,titre,slug',
            'reponses.auteur:id,name'
        ]);

        return view('back.contenus.commentaires.details', compact('commentaire'));
    }

    public function valider(Commentaire $commentaire)
    {
        $commentaire->update([
            'statut' => 'valide',
        ]);

        return back()->with('succes', 'Commentaire validé avec succès.');
    }

    public function rejeter(Commentaire $commentaire)
    {
        $commentaire->update([
            'statut' => 'rejete',
        ]);

        return back()->with('succes', 'Commentaire rejeté avec succès.');
    }

    public function remettreEnAttente(Commentaire $commentaire)
    {
        $commentaire->update([
            'statut' => 'en_attente',
        ]);

        return back()->with('succes', 'Commentaire remis en attente.');
    }

    public function supprimer(Commentaire $commentaire)
    {
        if ($commentaire->reponses()->count() > 0) {
            $commentaire->reponses()->delete();
        }

        $commentaire->delete();

        return back()->with('succes', 'Commentaire supprimé avec succès.');
    }
}