<?php

namespace App\Http\Controllers\Back\Formation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Formation\InscriptionRequest;
use App\Models\Formation\Inscription;
use App\Models\Formation\Module;
use App\Models\User;
use Illuminate\Http\Request;

class InscriptionController extends Controller
{
    public function index()
    {
        $inscriptions = Inscription::with('user', 'module')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        return view('back.formation.inscriptions.index', compact('inscriptions'));
    }

    public function enAttente()
    {
        $inscriptions = Inscription::with('user', 'module')
            ->where('statut', 'en_attente')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        return view('back.formation.inscriptions.en-attente', compact('inscriptions'));
    }

    public function create()
    {
        $modules = Module::where('is_active', true)->orderBy('titre')->get();
        $utilisateurs = User::orderBy('name')->get();
        
        return view('back.formation.inscriptions.create', compact('modules', 'utilisateurs'));
    }

    public function store(InscriptionRequest $request)
    {
        $data = $request->validated();
        
        // Vérifier si l'utilisateur est déjà inscrit à ce module
        $existing = Inscription::where('user_id', $data['user_id'])
            ->where('module_id', $data['module_id'])
            ->first();
        
        if ($existing) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Cet utilisateur est déjà inscrit à ce module.');
        }
        
        $inscription = Inscription::create($data);
        
        return redirect()
            ->route('back.formation.inscriptions.show', $inscription)
            ->with('success', 'Inscription créée avec succès.');
    }

    public function show(Inscription $inscription)
    {
        $inscription->load(['user', 'module.cours', 'presences' => function($query) {
            $query->with('cour')->orderBy('date_debut', 'desc');
        }]);
        
        $progressions = $inscription->user->progressions()
            ->whereIn('cour_id', $inscription->module->cours->pluck('id'))
            ->get();
        
        return view('back.formation.inscriptions.show', compact('inscription', 'progressions'));
    }

    public function edit(Inscription $inscription)
    {
        $modules = Module::where('is_active', true)->orderBy('titre')->get();
        $utilisateurs = User::orderBy('name')->get();
        
        return view('back.formation.inscriptions.edit', compact('inscription', 'modules', 'utilisateurs'));
    }

    public function update(InscriptionRequest $request, Inscription $inscription)
    {
        $inscription->update($request->validated());
        
        return redirect()
            ->route('back.formation.inscriptions.show', $inscription)
            ->with('success', 'Inscription mise à jour avec succès.');
    }

    public function destroy(Inscription $inscription)
    {
        $inscription->delete();
        
        return redirect()
            ->route('back.formation.inscriptions.index')
            ->with('success', 'Inscription supprimée avec succès.');
    }

    public function valider(Inscription $inscription)
    {
        $inscription->update([
            'statut' => 'valide',
            'date_debut' => now()
        ]);
        
        return redirect()
            ->back()
            ->with('success', 'Inscription validée avec succès.');
    }

    public function terminer(Inscription $inscription)
    {
        $inscription->update([
            'statut' => 'termine',
            'date_fin' => now(),
            'progression' => 100
        ]);
        
        return redirect()
            ->back()
            ->with('success', 'Inscription terminée avec succès.');
    }

    public function abandonner(Inscription $inscription)
    {
        $inscription->update([
            'statut' => 'abandonne',
            'date_fin' => now()
        ]);
        
        return redirect()
            ->back()
            ->with('success', 'Inscription abandonnée.');
    }
}