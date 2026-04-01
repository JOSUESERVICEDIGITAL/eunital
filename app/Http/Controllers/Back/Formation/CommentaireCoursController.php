<?php

namespace App\Http\Controllers\Back\Formation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Formation\CommentaireCoursRequest;
use App\Models\Formation\CommentaireCours;
use App\Models\Formation\Cour;
use Illuminate\Http\Request;

class CommentaireCoursController extends Controller
{
    public function index()
    {
        $commentaires = CommentaireCours::with('user', 'cour')
            ->whereNull('parent_id')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        return view('back.formation.commentaires.index', compact('commentaires'));
    }

    public function enAttente()
    {
        $commentaires = CommentaireCours::with('user', 'cour')
            ->where('is_approved', false)
            ->orderBy('created_at', 'asc')
            ->paginate(20);
        
        return view('back.formation.commentaires.en-attente', compact('commentaires'));
    }

    public function store(CommentaireCoursRequest $request)
    {
        $data = $request->validated();
        $commentaire = CommentaireCours::create($data);
        
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'commentaire' => $commentaire->load('user')
            ]);
        }
        
        return redirect()
            ->back()
            ->with('success', 'Commentaire ajouté avec succès.');
    }

    public function show(CommentaireCours $commentaireCours)
    {
        $commentaireCours->load(['user', 'cour', 'reponses.user']);
        return view('back.formation.commentaires.show', compact('commentaireCours'));
    }

    public function edit(CommentaireCours $commentaireCours)
    {
        return view('back.formation.commentaires.edit', compact('commentaireCours'));
    }

    public function update(CommentaireCoursRequest $request, CommentaireCours $commentaireCours)
    {
        $commentaireCours->update($request->validated());
        
        return redirect()
            ->route('back.formation.commentaires.show', $commentaireCours)
            ->with('success', 'Commentaire mis à jour avec succès.');
    }

    public function destroy(CommentaireCours $commentaireCours)
    {
        $commentaireCours->delete();
        
        return redirect()
            ->route('back.formation.commentaires.index')
            ->with('success', 'Commentaire supprimé avec succès.');
    }

    public function approuver(CommentaireCours $commentaireCours)
    {
        $commentaireCours->update(['is_approved' => true]);
        
        return redirect()
            ->back()
            ->with('success', 'Commentaire approuvé avec succès.');
    }

    public function rejeter(CommentaireCours $commentaireCours)
    {
        $commentaireCours->delete();
        
        return redirect()
            ->back()
            ->with('success', 'Commentaire rejeté et supprimé.');
    }

    public function liker(CommentaireCours $commentaireCours)
    {
        $commentaireCours->increment('likes');
        
        return response()->json([
            'success' => true,
            'likes' => $commentaireCours->likes
        ]);
    }

    public function repondre(Request $request, CommentaireCours $commentaireCours)
    {
        $request->validate([
            'contenu' => 'required|string|min:2|max:5000'
        ]);
        
        $reponse = CommentaireCours::create([
            'user_id' => auth()->id(),
            'cour_id' => $commentaireCours->cour_id,
            'parent_id' => $commentaireCours->id,
            'contenu' => $request->contenu,
            'is_approved' => true
        ]);
        
        return redirect()
            ->route('back.formation.commentaires.show', $commentaireCours)
            ->with('success', 'Réponse ajoutée avec succès.');
    }
}