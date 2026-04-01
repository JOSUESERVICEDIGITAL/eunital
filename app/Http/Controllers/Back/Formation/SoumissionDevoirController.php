<?php

namespace App\Http\Controllers\Back\Formation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Formation\SoumissionDevoirRequest;
use App\Models\Formation\SoumissionDevoir;
use App\Models\Formation\Devoir;
use Illuminate\Http\Request;

class SoumissionDevoirController extends Controller
{
    public function index()
    {
        $soumissions = SoumissionDevoir::with('devoir.cour', 'user')
            ->orderBy('soumis_le', 'desc')
            ->paginate(20);
        
        return view('back.formation.soumissions.index', compact('soumissions'));
    }

    public function aCorriger()
    {
        $soumissions = SoumissionDevoir::with('devoir.cour', 'user')
            ->whereNull('note')
            ->orderBy('soumis_le', 'asc')
            ->paginate(20);
        
        return view('back.formation.soumissions.a-corriger', compact('soumissions'));
    }

    public function corrigees()
    {
        $soumissions = SoumissionDevoir::with('devoir.cour', 'user')
            ->whereNotNull('note')
            ->orderBy('note_le', 'desc')
            ->paginate(20);
        
        return view('back.formation.soumissions.corrigees', compact('soumissions'));
    }

    public function create()
    {
        $devoirs = Devoir::where('is_published', true)->get();
        return view('back.formation.soumissions.create', compact('devoirs'));
    }

    public function store(SoumissionDevoirRequest $request)
    {
        $data = $request->validated();
        
        // Vérifier si l'utilisateur a déjà soumis pour ce devoir
        $existing = SoumissionDevoir::where('devoir_id', $data['devoir_id'])
            ->where('user_id', $data['user_id'])
            ->first();
        
        if ($existing) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Vous avez déjà soumis ce devoir.');
        }
        
        // Vérifier si la date limite est dépassée
        $devoir = Devoir::find($data['devoir_id']);
        if ($devoir->date_limite && $devoir->date_limite < now()) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'La date limite de soumission est dépassée.');
        }
        
        // Gestion des fichiers
        if ($request->hasFile('fichiers')) {
            $fichiers = [];
            foreach ($request->file('fichiers') as $file) {
                $path = $file->store('soumissions/' . $data['devoir_id'] . '/' . $data['user_id'], 'public');
                $fichiers[] = [
                    'name' => $file->getClientOriginalName(),
                    'path' => $path,
                    'size' => $file->getSize(),
                    'type' => $file->getMimeType()
                ];
            }
            $data['fichiers'] = $fichiers;
        }
        
        $soumission = SoumissionDevoir::create($data);
        
        // Notifier l'enseignant
        $enseignants = $devoir->cour->enseignants;
        foreach ($enseignants as $enseignant) {
            \App\Models\Formation\NotificationFormation::create([
                'user_id' => $enseignant->id,
                'type' => 'soumission_recue',
                'message' => "Une nouvelle soumission a été reçue pour le devoir '{$devoir->titre}'.",
                'data' => [
                    'soumission_id' => $soumission->id,
                    'devoir_id' => $devoir->id,
                    'user_id' => $data['user_id']
                ]
            ]);
        }
        
        return redirect()
            ->route('back.formation.soumissions.show', $soumission)
            ->with('success', 'Devoir soumis avec succès.');
    }

    public function show(SoumissionDevoir $soumissionDevoir)
    {
        $soumissionDevoir->load(['devoir.cour', 'user']);
        return view('back.formation.soumissions.show', compact('soumissionDevoir'));
    }

    public function edit(SoumissionDevoir $soumissionDevoir)
    {
        return view('back.formation.soumissions.edit', compact('soumissionDevoir'));
    }

    public function update(SoumissionDevoirRequest $request, SoumissionDevoir $soumissionDevoir)
    {
        $data = $request->validated();
        
        // Gestion des nouveaux fichiers
        if ($request->hasFile('fichiers')) {
            // Supprimer les anciens fichiers
            if ($soumissionDevoir->fichiers) {
                foreach ($soumissionDevoir->fichiers as $fichier) {
                    \Storage::disk('public')->delete($fichier['path']);
                }
            }
            
            $fichiers = [];
            foreach ($request->file('fichiers') as $file) {
                $path = $file->store('soumissions/' . $soumissionDevoir->devoir_id . '/' . $soumissionDevoir->user_id, 'public');
                $fichiers[] = [
                    'name' => $file->getClientOriginalName(),
                    'path' => $path,
                    'size' => $file->getSize(),
                    'type' => $file->getMimeType()
                ];
            }
            $data['fichiers'] = $fichiers;
        }
        
        $soumissionDevoir->update($data);
        
        return redirect()
            ->route('back.formation.soumissions.show', $soumissionDevoir)
            ->with('success', 'Soumission mise à jour avec succès.');
    }

    public function destroy(SoumissionDevoir $soumissionDevoir)
    {
        // Supprimer les fichiers
        if ($soumissionDevoir->fichiers) {
            foreach ($soumissionDevoir->fichiers as $fichier) {
                \Storage::disk('public')->delete($fichier['path']);
            }
        }
        
        $soumissionDevoir->delete();
        
        return redirect()
            ->route('back.formation.soumissions.index')
            ->with('success', 'Soumission supprimée avec succès.');
    }

    public function noter(Request $request, SoumissionDevoir $soumissionDevoir)
    {
        $request->validate([
            'note' => 'required|numeric|min:0|max:' . $soumissionDevoir->devoir->note_maximale,
            'commentaire_enseignant' => 'nullable|string'
        ]);
        
        $soumissionDevoir->update([
            'note' => $request->note,
            'commentaire_enseignant' => $request->commentaire_enseignant,
            'note_le' => now()
        ]);
        
        // Notifier l'étudiant
        \App\Models\Formation\NotificationFormation::create([
            'user_id' => $soumissionDevoir->user_id,
            'type' => 'devoir_corrige',
            'message' => "Votre devoir '{$soumissionDevoir->devoir->titre}' a été corrigé.",
            'data' => [
                'soumission_id' => $soumissionDevoir->id,
                'devoir_id' => $soumissionDevoir->devoir_id,
                'note' => $request->note
            ]
        ]);
        
        return redirect()
            ->route('back.formation.soumissions.show', $soumissionDevoir)
            ->with('success', 'Note attribuée avec succès.');
    }

    public function telechargerFichier(SoumissionDevoir $soumissionDevoir, $index)
    {
        if (!isset($soumissionDevoir->fichiers[$index])) {
            abort(404);
        }
        
        $fichier = $soumissionDevoir->fichiers[$index];
        
        return response()->download(storage_path('app/public/' . $fichier['path']), $fichier['name']);
    }
}