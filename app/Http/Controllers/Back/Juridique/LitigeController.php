<?php

namespace App\Http\Controllers\Back\Juridique;

use App\Http\Controllers\Controller;
use App\Http\Requests\Juridique\LitigeRequest;
use App\Models\Juridique\Litige;
use Illuminate\Http\Request;

class LitigeController extends Controller
{
    public function index()
    {
        $litiges = Litige::orderBy('date_ouverture', 'desc')
            ->paginate(15);

        return view('back.juridique.litiges.index', compact('litiges'));
    }

    public function ouverts()
    {
        $litiges = Litige::whereIn('statut', ['ouvert', 'instruction', 'mediation', 'arbitrage', 'judiciaire'])
            ->orderBy('date_ouverture', 'desc')
            ->paginate(15);

        return view('back.juridique.litiges.ouverts', compact('litiges'));
    }

    public function clos()
    {
        $litiges = Litige::where('statut', 'clos')
            ->orderBy('date_cloture', 'desc')
            ->paginate(15);

        return view('back.juridique.litiges.clos', compact('litiges'));
    }

    public function create()
    {
        $types = $this->getTypes();
        $statuts = $this->getStatuts();

        return view('back.juridique.litiges.create', compact('types', 'statuts'));
    }

    public function store(LitigeRequest $request)
    {
        $data = $request->validated();
        $litige = Litige::create($data);

        // Ajouter l'historique initial
        $litige->ajouterHistorique('Création', 'Litige créé.');

        return redirect()
            ->route('back.juridique.litiges.show', $litige)
            ->with('success', 'Litige créé avec succès.');
    }

    public function show(Litige $litige)
    {
        $statistiques = [
            'duree' => $litige->duree,
            'cout_moyen_journalier' => $litige->cout_total && $litige->date_ouverture
                ? round($litige->cout_total / $litige->date_ouverture->diffInDays(now() ?: 1), 2)
                : null
        ];

        return view('back.juridique.litiges.show', compact('litige', 'statistiques'));
    }

    public function edit(Litige $litige)
    {
        $types = $this->getTypes();
        $statuts = $this->getStatuts();

        return view('back.juridique.litiges.edit', compact('litige', 'types', 'statuts'));
    }

    public function update(LitigeRequest $request, Litige $litige)
    {
        $oldStatut = $litige->statut;
        $litige->update($request->validated());

        if ($oldStatut !== $litige->statut) {
            $litige->ajouterHistorique('Changement de statut', "Statut passé de {$oldStatut} à {$litige->statut}");
        }

        return redirect()
            ->route('back.juridique.litiges.show', $litige)
            ->with('success', 'Litige mis à jour avec succès.');
    }

    public function destroy(Litige $litige)
    {
        $litige->delete();

        return redirect()
            ->route('back.juridique.litiges.index')
            ->with('success', 'Litige supprimé avec succès.');
    }

    public function ajouterHistorique(Request $request, Litige $litige)
    {
        $request->validate([
            'action' => 'required|string|max:255',
            'commentaire' => 'nullable|string'
        ]);

        $litige->ajouterHistorique($request->action, $request->commentaire);

        return redirect()
            ->back()
            ->with('success', 'Historique ajouté avec succès.');
    }

    public function cloturer(Request $request, Litige $litige)
    {
        $request->validate([
            'conclusion' => 'required|string',
            'date_cloture' => 'required|date'
        ]);

        $litige->update([
            'statut' => 'clos',
            'date_cloture' => $request->date_cloture,
            'conclusion' => $request->conclusion
        ]);

        $litige->ajouterHistorique('Clôture', $request->conclusion);

        return redirect()
            ->route('back.juridique.litiges.show', $litige)
            ->with('success', 'Litige clôturé avec succès.');
    }

    private function getTypes()
    {
        return [
            'commercial' => 'Commercial',
            'social' => 'Social',
            'civil' => 'Civil',
            'administratif' => 'Administratif',
            'penal' => 'Pénal',
            'fiscal' => 'Fiscal',
            'propriete_intellectuelle' => 'Propriété intellectuelle'
        ];
    }

    private function getStatuts()
    {
        return [
            'ouvert' => 'Ouvert',
            'instruction' => 'En instruction',
            'mediation' => 'Médiation',
            'arbitrage' => 'Arbitrage',
            'judiciaire' => 'Judiciaire',
            'clos' => 'Clos',
            'abandonne' => 'Abandonné'
        ];
    }
}
