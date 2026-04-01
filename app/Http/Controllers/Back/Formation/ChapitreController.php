<?php

namespace App\Http\Controllers\Back\Formation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Formation\ChapitreRequest;
use App\Models\Formation\Chapitre;
use App\Models\Formation\Cour;
use Illuminate\Http\Request;

class ChapitreController extends Controller
{
    public function index()
    {
        $chapitres = Chapitre::with('cour')
            ->orderBy('cour_id')
            ->orderBy('ordre')
            ->paginate(20);
        
        return view('back.formation.chapitres.index', compact('chapitres'));
    }

    public function create()
    {
        $cours = Cour::where('is_published', true)->orderBy('titre')->get();
        return view('back.formation.chapitres.create', compact('cours'));
    }

    public function store(ChapitreRequest $request)
    {
        $data = $request->validated();
        
        // Définir l'ordre si non spécifié
        if (!isset($data['ordre'])) {
            $data['ordre'] = Chapitre::where('cour_id', $data['cour_id'])->max('ordre') + 1;
        }
        
        $chapitre = Chapitre::create($data);
        
        return redirect()
            ->route('back.formation.cours.show', $chapitre->cour_id)
            ->with('success', 'Chapitre créé avec succès.');
    }

    public function show(Chapitre $chapitre)
    {
        $chapitre->load(['cour', 'contenus' => function($query) {
            $query->orderBy('ordre');
        }]);
        
        return view('back.formation.chapitres.show', compact('chapitre'));
    }

    public function edit(Chapitre $chapitre)
    {
        $cours = Cour::where('is_published', true)->orderBy('titre')->get();
        return view('back.formation.chapitres.edit', compact('chapitre', 'cours'));
    }

    public function update(ChapitreRequest $request, Chapitre $chapitre)
    {
        $chapitre->update($request->validated());
        
        return redirect()
            ->route('back.formation.cours.show', $chapitre->cour_id)
            ->with('success', 'Chapitre mis à jour avec succès.');
    }

    public function destroy(Chapitre $chapitre)
    {
        // Vérifier si le chapitre a des contenus
        if ($chapitre->contenus()->count() > 0) {
            return redirect()
                ->back()
                ->with('error', 'Impossible de supprimer ce chapitre car il contient des contenus.');
        }
        
        $courId = $chapitre->cour_id;
        $chapitre->delete();
        
        // Réordonner les chapitres restants
        $chapitres = Chapitre::where('cour_id', $courId)->orderBy('ordre')->get();
        foreach ($chapitres as $index => $chap) {
            $chap->update(['ordre' => $index]);
        }
        
        return redirect()
            ->route('back.formation.cours.show', $courId)
            ->with('success', 'Chapitre supprimé avec succès.');
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'chapitres' => 'required|array',
            'chapitres.*.id' => 'exists:chapitres,id',
            'chapitres.*.ordre' => 'integer|min:0'
        ]);
        
        foreach ($request->chapitres as $chapitreData) {
            Chapitre::where('id', $chapitreData['id'])->update(['ordre' => $chapitreData['ordre']]);
        }
        
        return response()->json(['success' => true]);
    }
}