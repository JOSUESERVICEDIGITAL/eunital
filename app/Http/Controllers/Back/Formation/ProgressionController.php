<?php

namespace App\Http\Controllers\Back\Formation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Formation\ProgressionRequest;
use App\Models\Formation\Progression;
use App\Models\Formation\Cour;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgressionController extends Controller
{
    public function index()
    {
        $progressions = Progression::with(['user', 'cour'])
            ->orderBy('dernier_acces', 'desc')
            ->paginate(20);
        
        return view('back.formation.progressions.index', compact('progressions'));
    }

    public function parModule(Request $request)
    {
        $request->validate([
            'module_id' => 'nullable|exists:modules,id'
        ]);
        
        $query = Progression::with(['user', 'cour.module']);
        
        if ($request->module_id) {
            $query->whereHas('cour.module', function($q) use ($request) {
                $q->where('id', $request->module_id);
            });
        }
        
        $progressions = $query->orderBy('progression', 'desc')->paginate(20);
        $modules = \App\Models\Formation\Module::all();
        
        return view('back.formation.progressions.par-module', compact('progressions', 'modules', 'request'));
    }

    public function parEleve(Request $request)
    {
        $request->validate([
            'user_id' => 'nullable|exists:users,id'
        ]);
        
        $query = Progression::with(['cour.module', 'user']);
        
        if ($request->user_id) {
            $query->where('user_id', $request->user_id);
        }
        
        $progressions = $query->orderBy('progression', 'desc')->paginate(20);
        $utilisateurs = User::orderBy('name')->get();
        
        return view('back.formation.progressions.par-eleve', compact('progressions', 'utilisateurs', 'request'));
    }

    public function show(Progression $progression)
    {
        $progression->load(['user', 'cour.module', 'cour.chapitres.contenus', 'chapitre']);
        
        return view('back.formation.progressions.show', compact('progression'));
    }

    public function edit(Progression $progression)
    {
        $cours = Cour::where('is_published', true)->get();
        $utilisateurs = User::orderBy('name')->get();
        
        return view('back.formation.progressions.edit', compact('progression', 'cours', 'utilisateurs'));
    }

    public function update(ProgressionRequest $request, Progression $progression)
    {
        $progression->update($request->validated());
        
        // Mettre à jour la progression dans l'inscription correspondante
        $inscription = \App\Models\Formation\Inscription::where('user_id', $progression->user_id)
            ->whereHas('module.cours', function($q) use ($progression) {
                $q->where('id', $progression->cour_id);
            })
            ->first();
        
        if ($inscription) {
            $progressionMoyenne = Progression::where('user_id', $progression->user_id)
                ->whereHas('cour.module', function($q) use ($inscription) {
                    $q->where('id', $inscription->module_id);
                })
                ->avg('progression');
            
            $inscription->update([
                'progression' => $progressionMoyenne,
                'derniere_activite' => now()
            ]);
        }
        
        return redirect()
            ->route('back.formation.progressions.show', $progression)
            ->with('success', 'Progression mise à jour avec succès.');
    }

    public function avancer(Request $request, Progression $progression)
    {
        $request->validate([
            'pourcentage' => 'required|integer|min:1|max:100'
        ]);
        
        $progression->avancer($request->pourcentage);
        
        return response()->json([
            'success' => true,
            'progression' => $progression->progression,
            'termine' => $progression->termine
        ]);
    }

    public function barres()
    {
        $stats = [
            'global' => Progression::avg('progression') ?? 0,
            'par_cours' => Cour::withAvg('progressions', 'progression')
                ->orderBy('progressions_avg_progression', 'desc')
                ->limit(10)
                ->get()
                ->map(function($cour) {
                    return [
                        'cour' => $cour->titre,
                        'progression' => round($cour->progressions_avg_progression, 2)
                    ];
                }),
            'par_utilisateur' => User::withAvg('progressionsFormation', 'progression')
                ->orderBy('progressions_formation_avg_progression', 'desc')
                ->limit(10)
                ->get()
                ->map(function($user) {
                    return [
                        'user' => $user->name,
                        'progression' => round($user->progressions_formation_avg_progression, 2)
                    ];
                })
        ];
        
        return view('back.formation.progressions.barres', compact('stats'));
    }

    public function reset(Progression $progression)
    {
        $progression->update([
            'progression' => 0,
            'termine' => false,
            'dernier_acces' => now()
        ]);
        
        return redirect()
            ->back()
            ->with('success', 'Progression réinitialisée avec succès.');
    }
}