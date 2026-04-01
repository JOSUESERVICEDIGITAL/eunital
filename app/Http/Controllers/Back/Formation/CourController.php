<?php

namespace App\Http\Controllers\Back\Formation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Formation\CourRequest;
use App\Models\Formation\Cour;
use App\Models\Formation\Module;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourController extends Controller
{
    public function index()
    {
        $cours = Cour::with('module', 'createur')
            ->withCount('chapitres', 'utilisateurs', 'commentaires')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('back.formation.cours.index', compact('cours'));
    }

    public function publies()
    {
        $cours = Cour::with('module', 'createur')
            ->where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->paginate(15);
        
        return view('back.formation.cours.publies', compact('cours'));
    }

    public function brouillons()
    {
        $cours = Cour::with('module', 'createur')
            ->where('is_published', false)
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('back.formation.cours.brouillons', compact('cours'));
    }

    public function create()
    {
        $modules = Module::where('is_active', true)->orderBy('titre')->get();
        $enseignants = User::role('enseignant')->get();
        
        return view('back.formation.cours.create', compact('modules', 'enseignants'));
    }

    public function store(CourRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = auth()->id();
        
        // Gestion de l'image
        if ($request->hasFile('image_couverture')) {
            $path = $request->file('image_couverture')->store('cours', 'public');
            $data['image_couverture'] = $path;
        }
        
        $cour = Cour::create($data);
        
        // Attacher les enseignants
        if ($request->has('enseignants')) {
            $enseignants = [];
            foreach ($request->enseignants as $enseignantId) {
                $enseignants[$enseignantId] = ['role' => 'principal'];
            }
            $cour->enseignants()->sync($enseignants);
        }
        
        return redirect()
            ->route('back.formation.cours.show', $cour)
            ->with('success', 'Cours créé avec succès.');
    }

    public function show(Cour $cour)
    {
        $cour->load([
            'module',
            'chapitres' => function($query) {
                $query->with('contenus')->orderBy('ordre');
            },
            'enseignants',
            'utilisateurs' => function($query) {
                $query->limit(10);
            },
            'commentaires' => function($query) {
                $query->with('user')->whereNull('parent_id')->limit(10);
            },
            'devoirs'
        ]);
        
        $stats = [
            'nb_chapitres' => $cour->chapitres->count(),
            'nb_contenus' => $cour->chapitres->sum(function($chapitre) {
                return $chapitre->contenus->count();
            }),
            'nb_etudiants' => $cour->utilisateurs()->count(),
            'progression_moyenne' => $cour->progressions()->avg('progression') ?? 0,
            'taux_completion' => $cour->progressions()->where('termine', true)->count(),
            'note_moyenne' => $cour->devoirs()->with('soumissions')->get()->avg(function($devoir) {
                return $devoir->soumissions->avg('note');
            }) ?? 0
        ];
        
        return view('back.formation.cours.show', compact('cour', 'stats'));
    }

    public function edit(Cour $cour)
    {
        $modules = Module::where('is_active', true)->orderBy('titre')->get();
        $enseignants = User::role('enseignant')->get();
        $enseignantsActuels = $cour->enseignants->pluck('id')->toArray();
        
        return view('back.formation.cours.edit', compact('cour', 'modules', 'enseignants', 'enseignantsActuels'));
    }

    public function update(CourRequest $request, Cour $cour)
    {
        $data = $request->validated();
        
        // Gestion de l'image
        if ($request->hasFile('image_couverture')) {
            if ($cour->image_couverture) {
                \Storage::disk('public')->delete($cour->image_couverture);
            }
            $path = $request->file('image_couverture')->store('cours', 'public');
            $data['image_couverture'] = $path;
        }
        
        $cour->update($data);
        
        // Mettre à jour les enseignants
        if ($request->has('enseignants')) {
            $enseignants = [];
            foreach ($request->enseignants as $enseignantId) {
                $enseignants[$enseignantId] = ['role' => 'principal'];
            }
            $cour->enseignants()->sync($enseignants);
        } else {
            $cour->enseignants()->sync([]);
        }
        
        return redirect()
            ->route('back.formation.cours.show', $cour)
            ->with('success', 'Cours mis à jour avec succès.');
    }

    public function destroy(Cour $cour)
    {
        // Vérifier si le cours a des inscriptions
        if ($cour->utilisateurs()->count() > 0) {
            return redirect()
                ->back()
                ->with('error', 'Impossible de supprimer ce cours car des étudiants y sont inscrits.');
        }
        
        // Supprimer l'image
        if ($cour->image_couverture) {
            \Storage::disk('public')->delete($cour->image_couverture);
        }
        
        $cour->delete();
        
        return redirect()
            ->route('back.formation.cours.index')
            ->with('success', 'Cours supprimé avec succès.');
    }

    public function publier(Cour $cour)
    {
        $cour->update([
            'is_published' => true,
            'published_at' => now()
        ]);
        
        return redirect()
            ->back()
            ->with('success', 'Cours publié avec succès.');
    }

    public function depublier(Cour $cour)
    {
        $cour->update([
            'is_published' => false,
            'published_at' => null
        ]);
        
        return redirect()
            ->back()
            ->with('success', 'Cours dépublié avec succès.');
    }
}