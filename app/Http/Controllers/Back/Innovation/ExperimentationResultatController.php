<?php

namespace App\Http\Controllers\Back\Innovation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Innovation\ExperimentationResultatRequest;
use App\Models\Innovation\Experimentation;
use App\Models\Innovation\ExperimentationResultat;
use Illuminate\Http\Request;

class ExperimentationResultatController extends Controller
{
    public function index(Request $request)
    {
        $query = ExperimentationResultat::with('experimentation');

        if ($request->filled('experimentation_id')) {
            $query->where('experimentation_id', $request->experimentation_id);
        }

        $resultats = $query->latest()->paginate(15)->withQueryString();

        return view('back.innovations.experimentation-resultats.index', compact('resultats'));
    }

    public function create()
    {
        $experimentations = Experimentation::orderBy('titre')->get();

        return view('back.innovations.experimentation-resultats.create', compact('experimentations'));
    }

    public function store(ExperimentationResultatRequest $request)
    {
        $resultat = ExperimentationResultat::create($request->validated());

        return redirect()
            ->route('back.innovations.experimentation-resultats.show', $resultat)
            ->with('success', 'Résultat ajouté.');
    }

    public function show(ExperimentationResultat $resultat)
    {
        $resultat->load('experimentation');

        return view('back.innovations.experimentation-resultats.show', compact('resultat'));
    }

    public function edit(ExperimentationResultat $resultat)
    {
        $experimentations = Experimentation::orderBy('titre')->get();

        return view('back.innovations.experimentation-resultats.edit', compact('resultat', 'experimentations'));
    }

    public function update(ExperimentationResultatRequest $request, ExperimentationResultat $resultat)
    {
        $resultat->update($request->validated());

        return redirect()
            ->route('back.innovations.experimentation-resultats.show', $resultat)
            ->with('success', 'Résultat mis à jour.');
    }

    public function destroy(ExperimentationResultat $resultat)
    {
        $resultat->delete();

        return back()->with('success', 'Résultat supprimé.');
    }
}
