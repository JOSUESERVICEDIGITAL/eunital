<?php

namespace App\Http\Controllers\Back\Formation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Formation\CategorieModuleRequest;
use App\Models\Formation\CategorieModule;
use Illuminate\Http\Request;

class CategorieModuleController extends Controller
{
    public function index()
    {
        $categories = CategorieModule::withCount('modules')
            ->orderBy('ordre')
            ->paginate(15);
        
        return view('back.formation.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('back.formation.categories.create');
    }

    public function store(CategorieModuleRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = auth()->id();
        
        $categorie = CategorieModule::create($data);
        
        return redirect()
            ->route('back.formation.categories-modules.index')
            ->with('success', 'Catégorie créée avec succès.');
    }

    public function show(CategorieModule $categorieModule)
    {
        $categorieModule->load(['modules' => function($query) {
            $query->withCount('cours');
        }]);
        
        return view('back.formation.categories.show', compact('categorieModule'));
    }

    public function edit(CategorieModule $categorieModule)
    {
        return view('back.formation.categories.edit', compact('categorieModule'));
    }

    public function update(CategorieModuleRequest $request, CategorieModule $categorieModule)
    {
        $categorieModule->update($request->validated());
        
        return redirect()
            ->route('back.formation.categories-modules.index')
            ->with('success', 'Catégorie mise à jour avec succès.');
    }

    public function destroy(CategorieModule $categorieModule)
    {
        // Vérifier si la catégorie a des modules
        if ($categorieModule->modules()->count() > 0) {
            return redirect()
                ->back()
                ->with('error', 'Impossible de supprimer cette catégorie car elle contient des modules.');
        }
        
        $categorieModule->delete();
        
        return redirect()
            ->route('back.formation.categories-modules.index')
            ->with('success', 'Catégorie supprimée avec succès.');
    }

    public function toggleActive(CategorieModule $categorieModule)
    {
        $categorieModule->update(['is_active' => !$categorieModule->is_active]);
        
        return response()->json([
            'success' => true,
            'is_active' => $categorieModule->is_active
        ]);
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'exists:categories_modules,id'
        ]);
        
        foreach ($request->order as $index => $id) {
            CategorieModule::where('id', $id)->update(['ordre' => $index]);
        }
        
        return response()->json(['success' => true]);
    }
}