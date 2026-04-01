<?php

namespace App\Http\Controllers\Back\Juridique;

use App\Http\Controllers\Controller;
use App\Models\Entreprise;
use Illuminate\Http\Request;

class EntrepriseController extends Controller
{
    public function index()
    {
        $entreprises = Entreprise::orderBy('nom')
            ->paginate(15);

        return view('back.juridique.entreprises.index', compact('entreprises'));
    }

    public function create()
    {
        $formesJuridiques = $this->getFormesJuridiques();
        
        return view('back.juridique.entreprises.create', compact('formesJuridiques'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'siret' => 'nullable|string|size:14|unique:entreprises',
            'siren' => 'nullable|string|size:9',
            'ape' => 'nullable|string|size:5',
            'forme_juridique' => 'nullable|string|max:50',
            'capital_social' => 'nullable|string|max:50',
            'adresse' => 'nullable|string|max:255',
            'code_postal' => 'nullable|string|max:10',
            'ville' => 'nullable|string|max:100',
            'pays' => 'nullable|string|max:100',
            'telephone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'site_web' => 'nullable|url|max:255',
            'date_creation' => 'nullable|date',
            'metadatas' => 'nullable|array'
        ]);

        $entreprise = Entreprise::create($data);

        return redirect()
            ->route('back.juridique.entreprises.show', $entreprise)
            ->with('success', 'Entreprise créée avec succès.');
    }

    public function show(Entreprise $entreprise)
    {
        $entreprise->load(['documents' => function($q) {
            $q->latest()->limit(10);
        }, 'conformites']);

        $stats = [
            'total_documents' => $entreprise->documents()->count(),
            'total_contrats' => $entreprise->documents()->whereHas('contrat')->count(),
            'total_conformites' => $entreprise->conformites()->count(),
            'taux_conformite' => $entreprise->getTauxConformite()
        ];

        return view('back.juridique.entreprises.show', compact('entreprise', 'stats'));
    }

    public function edit(Entreprise $entreprise)
    {
        $formesJuridiques = $this->getFormesJuridiques();
        
        return view('back.juridique.entreprises.edit', compact('entreprise', 'formesJuridiques'));
    }

    public function update(Request $request, Entreprise $entreprise)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'siret' => 'nullable|string|size:14|unique:entreprises,siret,' . $entreprise->id,
            'siren' => 'nullable|string|size:9',
            'ape' => 'nullable|string|size:5',
            'forme_juridique' => 'nullable|string|max:50',
            'capital_social' => 'nullable|string|max:50',
            'adresse' => 'nullable|string|max:255',
            'code_postal' => 'nullable|string|max:10',
            'ville' => 'nullable|string|max:100',
            'pays' => 'nullable|string|max:100',
            'telephone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'site_web' => 'nullable|url|max:255',
            'date_creation' => 'nullable|date',
            'metadatas' => 'nullable|array'
        ]);

        $entreprise->update($data);

        return redirect()
            ->route('back.juridique.entreprises.show', $entreprise)
            ->with('success', 'Entreprise mise à jour avec succès.');
    }

    public function destroy(Entreprise $entreprise)
    {
        if ($entreprise->documents()->count() > 0) {
            return redirect()
                ->back()
                ->with('error', 'Impossible de supprimer cette entreprise car elle est liée à des documents.');
        }

        $entreprise->delete();

        return redirect()
            ->route('back.juridique.entreprises.index')
            ->with('success', 'Entreprise supprimée avec succès.');
    }

    public function search(Request $request)
    {
        $request->validate([
            'q' => 'required|string|min:2'
        ]);

        $results = Entreprise::search($request->q)
            ->limit(10)
            ->get()
            ->map(fn($e) => [
                'id' => $e->id,
                'nom' => $e->nom,
                'siret' => $e->siret_formate,
                'ville' => $e->ville,
                'url' => route('back.juridique.entreprises.show', $e)
            ]);

        return response()->json([
            'success' => true,
            'results' => $results
        ]);
    }

    private function getFormesJuridiques()
    {
        return [
            'sa' => 'SA (Société Anonyme)',
            'sas' => 'SAS (Société par Actions Simplifiée)',
            'sarl' => 'SARL (Société à Responsabilité Limitée)',
            'ei' => 'Entreprise Individuelle',
            'eurl' => 'EURL (Entreprise Unipersonnelle à Responsabilité Limitée)',
            'snc' => 'SNC (Société en Nom Collectif)',
            'sc' => 'SC (Société Civile)',
            'autres' => 'Autre forme juridique'
        ];
    }
}