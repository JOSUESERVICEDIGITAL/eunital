<?php

namespace App\Http\Controllers\Back\Formation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Formation\AccesSalleRequest;
use App\Models\Formation\AccesSalle;
use App\Models\Formation\Cour;
use Illuminate\Http\Request;

class AccesSalleController extends Controller
{
    public function index()
    {
        $acces = AccesSalle::with('cour')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        return view('back.formation.acces-salles.index', compact('acces'));
    }

    public function create()
    {
        $cours = Cour::where('is_published', true)->get();
        return view('back.formation.acces-salles.create', compact('cours'));
    }

    public function store(AccesSalleRequest $request)
    {
        $data = $request->validated();
        
        // Vérifier si un accès actif existe déjà pour ce cours
        $existing = AccesSalle::where('cour_id', $data['cour_id'])
            ->where('is_active', true)
            ->where('expires_at', '>', now())
            ->first();
        
        if ($existing) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Un accès actif existe déjà pour ce cours. Veuillez d\'abord désactiver l\'accès existant.');
        }
        
        $acces = AccesSalle::create($data);
        
        return redirect()
            ->route('back.formation.acces-salles.show', $acces)
            ->with('success', 'Code d\'accès généré avec succès. Code: ' . $acces->code_acces);
    }

    public function show(AccesSalle $accesSalle)
    {
        $accesSalle->load('cour');
        return view('back.formation.acces-salles.show', compact('accesSalle'));
    }

    public function edit(AccesSalle $accesSalle)
    {
        $cours = Cour::where('is_published', true)->get();
        return view('back.formation.acces-salles.edit', compact('accesSalle', 'cours'));
    }

    public function update(AccesSalleRequest $request, AccesSalle $accesSalle)
    {
        $accesSalle->update($request->validated());
        
        return redirect()
            ->route('back.formation.acces-salles.show', $accesSalle)
            ->with('success', 'Accès mis à jour avec succès.');
    }

    public function destroy(AccesSalle $accesSalle)
    {
        $accesSalle->delete();
        
        return redirect()
            ->route('back.formation.acces-salles.index')
            ->with('success', 'Accès supprimé avec succès.');
    }

    public function desactiver(AccesSalle $accesSalle)
    {
        $accesSalle->update(['is_active' => false]);
        
        return redirect()
            ->back()
            ->with('success', 'Accès désactivé avec succès.');
    }

    public function activer(AccesSalle $accesSalle)
    {
        $accesSalle->update(['is_active' => true]);
        
        return redirect()
            ->back()
            ->with('success', 'Accès activé avec succès.');
    }

    public function verifierCode(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
            'cour_id' => 'required|exists:cours,id'
        ]);
        
        $acces = AccesSalle::where('cour_id', $request->cour_id)
            ->where('code_acces', $request->code)
            ->where('is_active', true)
            ->where('expires_at', '>', now())
            ->first();
        
        if (!$acces) {
            return response()->json([
                'valide' => false,
                'message' => 'Code invalide ou expiré.'
            ], 404);
        }
        
        // Ajouter l'utilisateur à la liste des actifs
        if ($request->user_id) {
            $acces->ajouterUtilisateur($request->user_id);
        }
        
        return response()->json([
            'valide' => true,
            'message' => 'Accès autorisé.',
            'acces' => $acces
        ]);
    }

    public function genererNouveauCode(Cour $cour)
    {
        $acces = AccesSalle::create([
            'cour_id' => $cour->id,
            'code_acces' => strtoupper(substr(md5(uniqid() . $cour->id . now()), 0, 8)),
            'generated_at' => now(),
            'expires_at' => now()->addHours(2),
            'is_active' => true
        ]);
        
        return response()->json([
            'success' => true,
            'code' => $acces->code_acces,
            'expires_at' => $acces->expires_at
        ]);
    }
}