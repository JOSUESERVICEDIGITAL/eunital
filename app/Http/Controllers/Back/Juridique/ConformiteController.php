<?php

namespace App\Http\Controllers\Back\Juridique;

use App\Http\Controllers\Controller;
use App\Http\Requests\Juridique\ConformiteRequest;
use App\Models\Juridique\Conformite;
use App\Models\Juridique\Legalite;
use App\Models\Entreprise;
use Illuminate\Http\Request;

class ConformiteController extends Controller
{
    public function index()
    {
        $conformites = Conformite::with('legalite', 'entreprise')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('back.juridique.conformites.index', compact('conformites'));
    }

    public function conformes()
    {
        $conformites = Conformite::with('legalite', 'entreprise')
            ->where('statut', 'conforme')
            ->orderBy('score_conformite', 'desc')
            ->paginate(15);

        return view('back.juridique.conformites.conformes', compact('conformites'));
    }

    public function nonConformes()
    {
        $conformites = Conformite::with('legalite', 'entreprise')
            ->where('statut', 'non_conforme')
            ->orderBy('score_conformite', 'asc')
            ->paginate(15);

        return view('back.juridique.conformites.non-conformes', compact('conformites'));
    }

    public function enCours()
    {
        $conformites = Conformite::with('legalite', 'entreprise')
            ->where('statut', 'en_cours')
            ->orderBy('date_prochaine_evaluation', 'asc')
            ->paginate(15);

        return view('back.juridique.conformites.en-cours', compact('conformites'));
    }

    public function create()
    {
        $legalites = Legalite::where('est_en_vigueur', true)->orderBy('titre')->get();
        $entreprises = Entreprise::orderBy('nom')->get();

        return view('back.juridique.conformites.create', compact('legalites', 'entreprises'));
    }

    public function store(ConformiteRequest $request)
    {
        $data = $request->validated();
        $conformite = Conformite::create($data);

        return redirect()
            ->route('back.juridique.conformites.show', $conformite)
            ->with('success', 'Évaluation de conformité créée avec succès.');
    }

    public function show(Conformite $conformite)
    {
        $conformite->load(['legalite', 'entreprise']);

        return view('back.juridique.conformites.show', compact('conformite'));
    }

    public function edit(Conformite $conformite)
    {
        $legalites = Legalite::where('est_en_vigueur', true)->orderBy('titre')->get();
        $entreprises = Entreprise::orderBy('nom')->get();

        return view('back.juridique.conformites.edit', compact('conformite', 'legalites', 'entreprises'));
    }

    public function update(ConformiteRequest $request, Conformite $conformite)
    {
        $conformite->update($request->validated());

        return redirect()
            ->route('back.juridique.conformites.show', $conformite)
            ->with('success', 'Évaluation de conformité mise à jour avec succès.');
    }

    public function destroy(Conformite $conformite)
    {
        $conformite->delete();

        return redirect()
            ->route('back.juridique.conformites.index')
            ->with('success', 'Évaluation de conformité supprimée avec succès.');
    }

    public function evaluer(Request $request, Conformite $conformite)
    {
        $request->validate([
            'score' => 'required|numeric|min:0|max:100'
        ]);

        $conformite->evaluer($request->score);

        return redirect()
            ->back()
            ->with('success', 'Évaluation enregistrée avec succès.');
    }

    public function planAction(Conformite $conformite)
    {
        return view('back.juridique.conformites.plan-action', compact('conformite'));
    }
}
