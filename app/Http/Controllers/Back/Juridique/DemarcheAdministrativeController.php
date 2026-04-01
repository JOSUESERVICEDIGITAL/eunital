<?php

namespace App\Http\Controllers\Back\Juridique;

use App\Http\Controllers\Controller;
use App\Http\Requests\Juridique\DemarcheAdministrativeRequest;
use App\Models\Juridique\DemarcheAdministrative;
use Illuminate\Http\Request;

class DemarcheAdministrativeController extends Controller
{
    public function index()
    {
        $demarches = DemarcheAdministrative::orderBy('categorie')
            ->orderBy('titre')
            ->paginate(15);

        return view('back.juridique.demarches.index', compact('demarches'));
    }

    public function enCours()
    {
        // Pour les démarches en cours, nous filtrons par statut via une colonne
        // Si vous n'avez pas de colonne statut, vous pouvez ajouter une condition
        $demarches = DemarcheAdministrative::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('back.juridique.demarches.en-cours', compact('demarches'));
    }

    public function create()
    {
        $categories = $this->getCategories();
        return view('back.juridique.demarches.create', compact('categories'));
    }

    public function store(DemarcheAdministrativeRequest $request)
    {
        $data = $request->validated();
        $demarche = DemarcheAdministrative::create($data);

        return redirect()
            ->route('back.juridique.demarches.show', $demarche)
            ->with('success', 'Démarche administrative créée avec succès.');
    }

    public function show(DemarcheAdministrative $demarcheAdministrative)
    {
        return view('back.juridique.demarches.show', compact('demarcheAdministrative'));
    }

    public function edit(DemarcheAdministrative $demarcheAdministrative)
    {
        $categories = $this->getCategories();
        return view('back.juridique.demarches.edit', compact('demarcheAdministrative', 'categories'));
    }

    public function update(DemarcheAdministrativeRequest $request, DemarcheAdministrative $demarcheAdministrative)
    {
        $demarcheAdministrative->update($request->validated());

        return redirect()
            ->route('back.juridique.demarches.show', $demarcheAdministrative)
            ->with('success', 'Démarche administrative mise à jour avec succès.');
    }

    public function destroy(DemarcheAdministrative $demarcheAdministrative)
    {
        $demarcheAdministrative->delete();

        return redirect()
            ->route('back.juridique.demarches.index')
            ->with('success', 'Démarche administrative supprimée avec succès.');
    }

    public function toggleActive(DemarcheAdministrative $demarcheAdministrative)
    {
        $demarcheAdministrative->update(['is_active' => !$demarcheAdministrative->is_active]);

        return response()->json([
            'success' => true,
            'is_active' => $demarcheAdministrative->is_active
        ]);
    }

    private function getCategories()
    {
        return [
            'creation' => 'Création',
            'modification' => 'Modification',
            'autorisation' => 'Autorisation',
            'declaration' => 'Déclaration',
            'agrement' => 'Agrément',
            'certification' => 'Certification',
            'enregistrement' => 'Enregistrement',
            'radiation' => 'Radiation'
        ];
    }
}
