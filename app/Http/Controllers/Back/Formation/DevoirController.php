<?php

namespace App\Http\Controllers\Back\Formation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Formation\DevoirRequest;
use App\Models\Formation\Devoir;
use App\Models\Formation\Cour;
use Illuminate\Http\Request;

class DevoirController extends Controller
{
    public function index()
    {
        $devoirs = Devoir::with('cour')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('back.formation.devoirs.index', compact('devoirs'));
    }

    public function create()
    {
        $cours = Cour::where('is_published', true)->get();
        return view('back.formation.devoirs.create', compact('cours'));
    }

    public function store(DevoirRequest $request)
    {
        $data = $request->validated();
        
        // Gestion des ressources
        if ($request->hasFile('resources')) {
            $resources = [];
            foreach ($request->file('resources') as $file) {
                $path = $file->store('devoirs/' . $data['cour_id'], 'public');
                $resources[] = [
                    'name' => $file->getClientOriginalName(),
                    'path' => $path,
                    'size' => $file->getSize(),
                    'type' => $file->getMimeType()
                ];
            }
            $data['resources'] = $resources;
        }
        
        $devoir = Devoir::create($data);
        
        return redirect()
            ->route('back.formation.devoirs.show', $devoir)
            ->with('success', 'Devoir créé avec succès.');
    }

    public function show(Devoir $devoir)
    {
        $devoir->load(['cour', 'soumissions' => function($query) {
            $query->with('user')->orderBy('soumis_le', 'desc');
        }]);
        
        $stats = [
            'total_soumissions' => $devoir->soumissions()->count(),
            'soumissions_non_corrigees' => $devoir->soumissions()->whereNull('note')->count(),
            'soumissions_corrigees' => $devoir->soumissions()->whereNotNull('note')->count(),
            'moyenne' => $devoir->soumissions()->whereNotNull('note')->avg('note') ?? 0,
            'taux_soumission' => $devoir->cour->utilisateurs()->count() > 0 ? 
                round(($devoir->soumissions()->count() / $devoir->cour->utilisateurs()->count()) * 100, 2) : 0
        ];
        
        return view('back.formation.devoirs.show', compact('devoir', 'stats'));
    }

    public function edit(Devoir $devoir)
    {
        $cours = Cour::where('is_published', true)->get();
        return view('back.formation.devoirs.edit', compact('devoir', 'cours'));
    }

    public function update(DevoirRequest $request, Devoir $devoir)
    {
        $data = $request->validated();
        
        // Gestion des nouvelles ressources
        if ($request->hasFile('resources')) {
            // Supprimer les anciennes ressources
            if ($devoir->resources) {
                foreach ($devoir->resources as $resource) {
                    \Storage::disk('public')->delete($resource['path']);
                }
            }
            
            $resources = [];
            foreach ($request->file('resources') as $file) {
                $path = $file->store('devoirs/' . $devoir->cour_id, 'public');
                $resources[] = [
                    'name' => $file->getClientOriginalName(),
                    'path' => $path,
                    'size' => $file->getSize(),
                    'type' => $file->getMimeType()
                ];
            }
            $data['resources'] = $resources;
        }
        
        $devoir->update($data);
        
        return redirect()
            ->route('back.formation.devoirs.show', $devoir)
            ->with('success', 'Devoir mis à jour avec succès.');
    }

    public function destroy(Devoir $devoir)
    {
        // Supprimer les ressources
        if ($devoir->resources) {
            foreach ($devoir->resources as $resource) {
                \Storage::disk('public')->delete($resource['path']);
            }
        }
        
        $devoir->delete();
        
        return redirect()
            ->route('back.formation.devoirs.index')
            ->with('success', 'Devoir supprimé avec succès.');
    }

    public function publier(Devoir $devoir)
    {
        $devoir->update(['is_published' => true]);
        
        // Envoyer des notifications aux étudiants
        $etudiants = $devoir->cour->utilisateurs;
        foreach ($etudiants as $etudiant) {
            \App\Models\Formation\NotificationFormation::create([
                'user_id' => $etudiant->id,
                'type' => 'devoir_publie',
                'message' => "Un nouveau devoir '{$devoir->titre}' a été publié pour le cours '{$devoir->cour->titre}'.",
                'data' => [
                    'devoir_id' => $devoir->id,
                    'cour_id' => $devoir->cour_id,
                    'date_limite' => $devoir->date_limite
                ]
            ]);
        }
        
        return redirect()
            ->back()
            ->with('success', 'Devoir publié et notifications envoyées.');
    }

    public function depublier(Devoir $devoir)
    {
        $devoir->update(['is_published' => false]);
        
        return redirect()
            ->back()
            ->with('success', 'Devoir dépublié avec succès.');
    }
}