<?php

namespace App\Http\Controllers\Back\Formation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Formation\PresenceRequest;
use App\Models\Formation\Presence;
use App\Models\Formation\Inscription;
use App\Models\Formation\Cour;
use Illuminate\Http\Request;

class PresenceController extends Controller
{
    public function index()
    {
        $presences = Presence::with(['inscription.user', 'cour'])
            ->orderBy('date_debut', 'desc')
            ->paginate(20);
        
        return view('back.formation.presences.index', compact('presences'));
    }

    public function create()
    {
        $inscriptions = Inscription::with('user', 'module')
            ->where('statut', 'valide')
            ->get();
        $cours = Cour::where('is_published', true)->get();
        
        return view('back.formation.presences.create', compact('inscriptions', 'cours'));
    }

    public function store(PresenceRequest $request)
    {
        $data = $request->validated();
        
        // Vérifier si une présence existe déjà pour cette inscription et ce cours
        $existing = Presence::where('inscription_id', $data['inscription_id'])
            ->where('cour_id', $data['cour_id'])
            ->whereDate('date_debut', now()->toDateString())
            ->first();
        
        if ($existing) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Une présence a déjà été enregistrée pour ce cours aujourd\'hui.');
        }
        
        $presence = Presence::create($data);
        
        // Mettre à jour la progression de l'inscription
        $inscription = Inscription::find($data['inscription_id']);
        $totalCours = $inscription->module->cours()->count();
        $presencesCount = $inscription->presences()->where('present', true)->count();
        $progression = ($presencesCount / $totalCours) * 100;
        $inscription->update(['progression' => $progression]);
        
        return redirect()
            ->route('back.formation.presences.show', $presence)
            ->with('success', 'Présence enregistrée avec succès.');
    }

    public function show(Presence $presence)
    {
        $presence->load(['inscription.user', 'cour']);
        return view('back.formation.presences.show', compact('presence'));
    }

    public function edit(Presence $presence)
    {
        $inscriptions = Inscription::with('user', 'module')
            ->where('statut', 'valide')
            ->get();
        $cours = Cour::where('is_published', true)->get();
        
        return view('back.formation.presences.edit', compact('presence', 'inscriptions', 'cours'));
    }

    public function update(PresenceRequest $request, Presence $presence)
    {
        $presence->update($request->validated());
        
        return redirect()
            ->route('back.formation.presences.show', $presence)
            ->with('success', 'Présence mise à jour avec succès.');
    }

    public function destroy(Presence $presence)
    {
        $presence->delete();
        
        return redirect()
            ->route('back.formation.presences.index')
            ->with('success', 'Présence supprimée avec succès.');
    }

    public function rapport(Request $request)
    {
        $request->validate([
            'module_id' => 'nullable|exists:modules,id',
            'date_debut' => 'nullable|date',
            'date_fin' => 'nullable|date|after_or_equal:date_debut'
        ]);
        
        $query = Presence::with(['inscription.user', 'cour.module']);
        
        if ($request->module_id) {
            $query->whereHas('cour.module', function($q) use ($request) {
                $q->where('id', $request->module_id);
            });
        }
        
        if ($request->date_debut) {
            $query->whereDate('date_debut', '>=', $request->date_debut);
        }
        
        if ($request->date_fin) {
            $query->whereDate('date_debut', '<=', $request->date_fin);
        }
        
        $presences = $query->orderBy('date_debut', 'desc')->get();
        $modules = \App\Models\Formation\Module::all();
        
        $stats = [
            'total' => $presences->count(),
            'present' => $presences->where('present', true)->count(),
            'absent' => $presences->where('present', false)->count(),
            'taux_presence' => $presences->count() > 0 ? 
                round(($presences->where('present', true)->count() / $presences->count()) * 100, 2) : 0
        ];
        
        return view('back.formation.presences.rapport', compact('presences', 'modules', 'stats', 'request'));
    }
}