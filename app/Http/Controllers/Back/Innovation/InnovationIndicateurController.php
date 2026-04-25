<?php

namespace App\Http\Controllers\Back\Innovation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Innovation\InnovationIndicateurRequest;
use App\Models\Innovation\Innovation;
use App\Models\Innovation\InnovationIndicateur;
use Illuminate\Http\Request;

class InnovationIndicateurController extends Controller
{
    public function index(Request $request)
    {
        $query = InnovationIndicateur::with('innovation');

        if ($request->filled('innovation_id')) {
            $query->where('innovation_id', $request->innovation_id);
        }

        $indicateurs = $query->latest()->paginate(15)->withQueryString();

        return view('back.innovations.indicateurs.index', compact('indicateurs'));
    }

    public function create()
    {
        $innovations = Innovation::orderBy('titre')->get();

        return view('back.innovations.indicateurs.create', compact('innovations'));
    }

    public function store(InnovationIndicateurRequest $request)
    {
        $indicateur = InnovationIndicateur::create($request->validated());

        return redirect()
            ->route('back.innovations.indicateurs.show', $indicateur)
            ->with('success', 'Indicateur ajouté.');
    }

    public function show(InnovationIndicateur $indicateur)
    {
        $indicateur->load('innovation');

        return view('back.innovations.indicateurs.show', compact('indicateur'));
    }

    public function edit(InnovationIndicateur $indicateur)
    {
        $innovations = Innovation::orderBy('titre')->get();

        return view('back.innovations.indicateurs.edit', compact('indicateur', 'innovations'));
    }

    public function update(InnovationIndicateurRequest $request, InnovationIndicateur $indicateur)
    {
        $indicateur->update($request->validated());

        return redirect()
            ->route('back.innovations.indicateurs.show', $indicateur)
            ->with('success', 'Indicateur mis à jour.');
    }

    public function destroy(InnovationIndicateur $indicateur)
    {
        $indicateur->delete();

        return back()->with('success', 'Indicateur supprimé.');
    }

    public function actualiserValeur(Request $request, InnovationIndicateur $indicateur)
    {
        $request->validate([
            'valeur_actuelle' => ['required', 'numeric'],
        ]);

        $indicateur->update([
            'valeur_actuelle' => $request->valeur_actuelle,
        ]);

        return back()->with('success', 'Valeur actuelle mise à jour.');
    }
}
