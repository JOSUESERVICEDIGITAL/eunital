<?php

namespace App\Http\Controllers\Back\Formation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Formation\ContenuRequest;
use App\Models\Formation\Contenu;
use App\Models\Formation\Chapitre;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ContenuController extends Controller
{
    public function index()
    {
        $contenus = Contenu::with('chapitre.cour')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        return view('back.formation.contenus.index', compact('contenus'));
    }

    public function videos()
    {
        $contenus = Contenu::with('chapitre.cour')
            ->where('type', 'video')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        return view('back.formation.contenus.videos', compact('contenus'));
    }

    public function documents()
    {
        $contenus = Contenu::with('chapitre.cour')
            ->where('type', 'document')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        return view('back.formation.contenus.documents', compact('contenus'));
    }

    public function tutoriels()
    {
        $contenus = Contenu::with('chapitre.cour')
            ->where('type', 'tutoriel')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        return view('back.formation.contenus.tutoriels', compact('contenus'));
    }

    public function create()
    {
        $chapitres = Chapitre::with('cour')->orderBy('cour_id')->orderBy('ordre')->get();
        return view('back.formation.contenus.create', compact('chapitres'));
    }

    public function store(ContenuRequest $request)
    {
        $data = $request->validated();
        
        // Gestion du fichier
        if ($request->hasFile('fichier')) {
            $file = $request->file('fichier');
            $path = $file->store('contenus/' . $data['type'], 'public');
            $data['fichier'] = $path;
            $data['type_fichier'] = $file->getClientOriginalExtension();
            $data['taille_fichier'] = $file->getSize();
        }
        
        // Définir l'ordre si non spécifié
        if (!isset($data['ordre'])) {
            $data['ordre'] = Contenu::where('chapitre_id', $data['chapitre_id'])->max('ordre') + 1;
        }
        
        $contenu = Contenu::create($data);
        
        return redirect()
            ->route('back.formation.chapitres.show', $contenu->chapitre_id)
            ->with('success', 'Contenu créé avec succès.');
    }

    public function show(Contenu $contenu)
    {
        $contenu->load('chapitre.cour');
        return view('back.formation.contenus.show', compact('contenu'));
    }

    public function edit(Contenu $contenu)
    {
        $chapitres = Chapitre::with('cour')->orderBy('cour_id')->orderBy('ordre')->get();
        return view('back.formation.contenus.edit', compact('contenu', 'chapitres'));
    }

    public function update(ContenuRequest $request, Contenu $contenu)
    {
        $data = $request->validated();
        
        // Gestion du fichier
        if ($request->hasFile('fichier')) {
            // Supprimer l'ancien fichier
            if ($contenu->fichier) {
                \Storage::disk('public')->delete($contenu->fichier);
            }
            
            $file = $request->file('fichier');
            $path = $file->store('contenus/' . $data['type'], 'public');
            $data['fichier'] = $path;
            $data['type_fichier'] = $file->getClientOriginalExtension();
            $data['taille_fichier'] = $file->getSize();
        }
        
        $contenu->update($data);
        
        return redirect()
            ->route('back.formation.chapitres.show', $contenu->chapitre_id)
            ->with('success', 'Contenu mis à jour avec succès.');
    }

    public function destroy(Contenu $contenu)
    {
        // Supprimer le fichier
        if ($contenu->fichier) {
            \Storage::disk('public')->delete($contenu->fichier);
        }
        
        $chapitreId = $contenu->chapitre_id;
        $contenu->delete();
        
        // Réordonner les contenus restants
        $contenus = Contenu::where('chapitre_id', $chapitreId)->orderBy('ordre')->get();
        foreach ($contenus as $index => $cont) {
            $cont->update(['ordre' => $index]);
        }
        
        return redirect()
            ->route('back.formation.chapitres.show', $chapitreId)
            ->with('success', 'Contenu supprimé avec succès.');
    }

    public function download(Contenu $contenu)
    {
        if (!$contenu->telechargeable || !$contenu->fichier) {
            abort(403, 'Ce contenu n\'est pas téléchargeable.');
        }
        
        return response()->download(storage_path('app/public/' . $contenu->fichier));
    }

    public function toggleVisibility(Contenu $contenu)
    {
        $contenu->update(['is_visible' => !$contenu->is_visible]);
        
        return response()->json([
            'success' => true,
            'is_visible' => $contenu->is_visible
        ]);
    }
}