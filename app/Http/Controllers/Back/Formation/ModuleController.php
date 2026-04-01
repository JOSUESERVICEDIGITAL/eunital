<?php

namespace App\Http\Controllers\Back\Formation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Formation\ModuleRequest;
use App\Models\Formation\Module;
use App\Models\Formation\CategorieModule;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ModuleController extends Controller
{
    public function index()
    {
        $modules = Module::with('categorie', 'createur')
            ->withCount('cours', 'inscriptions')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('back.formation.modules.index', compact('modules'));
    }

    public function create()
    {
        $categories = CategorieModule::where('is_active', true)->orderBy('ordre')->get();
        return view('back.formation.modules.create', compact('categories'));
    }

    public function store(ModuleRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = auth()->id();
        
        // Gestion de l'image
        if ($request->hasFile('image_couverture')) {
            $path = $request->file('image_couverture')->store('modules', 'public');
            $data['image_couverture'] = $path;
        }
        
        $module = Module::create($data);
        
        return redirect()
            ->route('back.formation.modules.show', $module)
            ->with('success', 'Module créé avec succès.');
    }

    public function show(Module $module)
    {
        $module->load([
            'categorie',
            'cours' => function($query) {
                $query->orderBy('ordre')->withCount('chapitres', 'utilisateurs');
            },
            'inscriptions' => function($query) {
                $query->with('user')->limit(10);
            }
        ]);
        
        $stats = [
            'nb_cours' => $module->cours->count(),
            'nb_inscrits' => $module->inscriptions()->where('statut', 'valide')->count(),
            'progression_moyenne' => $module->inscriptions()->where('statut', 'valide')->avg('progression') ?? 0,
            'duree_totale' => $module->cours->sum('duree_estimee')
        ];
        
        return view('back.formation.modules.show', compact('module', 'stats'));
    }

    public function edit(Module $module)
    {
        $categories = CategorieModule::where('is_active', true)->orderBy('ordre')->get();
        return view('back.formation.modules.edit', compact('module', 'categories'));
    }

    public function update(ModuleRequest $request, Module $module)
    {
        $data = $request->validated();
        
        // Gestion de l'image
        if ($request->hasFile('image_couverture')) {
            // Supprimer l'ancienne image
            if ($module->image_couverture) {
                \Storage::disk('public')->delete($module->image_couverture);
            }
            $path = $request->file('image_couverture')->store('modules', 'public');
            $data['image_couverture'] = $path;
        }
        
        $module->update($data);
        
        return redirect()
            ->route('back.formation.modules.show', $module)
            ->with('success', 'Module mis à jour avec succès.');
    }

    public function destroy(Module $module)
    {
        // Vérifier si le module a des cours
        if ($module->cours()->count() > 0) {
            return redirect()
                ->back()
                ->with('error', 'Impossible de supprimer ce module car il contient des cours.');
        }
        
        // Supprimer l'image
        if ($module->image_couverture) {
            \Storage::disk('public')->delete($module->image_couverture);
        }
        
        $module->delete();
        
        return redirect()
            ->route('back.formation.modules.index')
            ->with('success', 'Module supprimé avec succès.');
    }

    public function toggleActive(Module $module)
    {
        $module->update(['is_active' => !$module->is_active]);
        
        return response()->json([
            'success' => true,
            'is_active' => $module->is_active
        ]);
    }
}