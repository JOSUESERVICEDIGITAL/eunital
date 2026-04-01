<?php

namespace App\Http\Controllers\Back\Juridique;

use App\Http\Controllers\Controller;
use App\Http\Requests\Juridique\LegaliteRequest;
use App\Models\Juridique\Legalite;
use Illuminate\Http\Request;

class LegaliteController extends Controller
{
    public function index()
    {
        $legalites = Legalite::orderBy('type')
            ->orderBy('titre')
            ->paginate(15);

        return view('back.juridique.legalites.index', compact('legalites'));
    }

    public function lois()
    {
        $legalites = Legalite::where('type', 'loi')
            ->orderBy('date_publication', 'desc')
            ->paginate(15);

        return view('back.juridique.legalites.lois', compact('legalites'));
    }

    public function decrets()
    {
        $legalites = Legalite::where('type', 'decret')
            ->orderBy('date_publication', 'desc')
            ->paginate(15);

        return view('back.juridique.legalites.decrets', compact('legalites'));
    }

    public function reglements()
    {
        $legalites = Legalite::where('type', 'reglement')
            ->orderBy('date_publication', 'desc')
            ->paginate(15);

        return view('back.juridique.legalites.reglements', compact('legalites'));
    }

    public function normes()
    {
        $legalites = Legalite::whereIn('type', ['norme', 'standard'])
            ->orderBy('date_publication', 'desc')
            ->paginate(15);

        return view('back.juridique.legalites.normes', compact('legalites'));
    }

    public function enVigueur()
    {
        $legalites = Legalite::where('est_en_vigueur', true)
            ->orderBy('date_application', 'desc')
            ->paginate(15);

        return view('back.juridique.legalites.en-vigueur', compact('legalites'));
    }

    public function create()
    {
        $types = $this->getTypes();

        return view('back.juridique.legalites.create', compact('types'));
    }

    public function store(LegaliteRequest $request)
    {
        $data = $request->validated();
        $legalite = Legalite::create($data);

        return redirect()
            ->route('back.juridique.legalites.show', $legalite)
            ->with('success', 'Texte légal créé avec succès.');
    }

    public function show(Legalite $legalite)
    {
        $legalite->load('conformites');

        $stats = [
            'nb_conformites' => $legalite->conformites()->count(),
            'conformites_conformes' => $legalite->conformites()->where('statut', 'conforme')->count(),
            'conformites_non_conformes' => $legalite->conformites()->where('statut', 'non_conforme')->count(),
            'derniere_evaluation' => $legalite->conformites()->latest('date_controle')->first()?->date_controle
        ];

        return view('back.juridique.legalites.show', compact('legalite', 'stats'));
    }

    public function edit(Legalite $legalite)
    {
        $types = $this->getTypes();

        return view('back.juridique.legalites.edit', compact('legalite', 'types'));
    }

    public function update(LegaliteRequest $request, Legalite $legalite)
    {
        $legalite->update($request->validated());

        return redirect()
            ->route('back.juridique.legalites.show', $legalite)
            ->with('success', 'Texte légal mis à jour avec succès.');
    }

    public function destroy(Legalite $legalite)
    {
        if ($legalite->conformites()->count() > 0) {
            return redirect()
                ->back()
                ->with('error', 'Impossible de supprimer ce texte légal car des évaluations de conformité y sont associées.');
        }

        $legalite->delete();

        return redirect()
            ->route('back.juridique.legalites.index')
            ->with('success', 'Texte légal supprimé avec succès.');
    }

    public function toggleVigueur(Legalite $legalite)
    {
        $legalite->update(['est_en_vigueur' => !$legalite->est_en_vigueur]);

        return response()->json([
            'success' => true,
            'est_en_vigueur' => $legalite->est_en_vigueur
        ]);
    }

    public function search(Request $request)
    {
        $request->validate([
            'q' => 'required|string|min:2'
        ]);

        $results = Legalite::where('titre', 'LIKE', "%{$request->q}%")
            ->orWhere('reference', 'LIKE', "%{$request->q}%")
            ->orWhere('resume', 'LIKE', "%{$request->q}%")
            ->limit(10)
            ->get();

        return response()->json([
            'success' => true,
            'results' => $results->map(fn($l) => [
                'id' => $l->id,
                'titre' => $l->titre,
                'type' => $l->type_label,
                'reference' => $l->reference,
                'url' => route('back.juridique.legalites.show', $l)
            ])
        ]);
    }

    private function getTypes()
    {
        return [
            'loi' => 'Loi',
            'decret' => 'Décret',
            'arrete' => 'Arrêté',
            'circulaire' => 'Circulaire',
            'directive' => 'Directive',
            'reglement' => 'Règlement',
            'norme' => 'Norme',
            'standard' => 'Standard',
            'jurisprudence' => 'Jurisprudence'
        ];
    }
}
