<?php

namespace App\Http\Controllers\Back\Innovation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Innovation\InnovationObjectifRequest;
use App\Models\Innovation\Innovation;
use App\Models\Innovation\InnovationObjectif;
use Illuminate\Http\Request;

class InnovationObjectifController extends Controller
{
    public function index(Request $request)
    {
        $query = InnovationObjectif::with('innovation');

        if ($request->filled('innovation_id')) {
            $query->where('innovation_id', $request->innovation_id);
        }

        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        $objectifs = $query->latest()->paginate(15)->withQueryString();

        return view('back.innovations.objectifs.index', compact('objectifs'));
    }

    public function create()
    {
        $innovations = Innovation::orderBy('titre')->get();

        return view('back.innovations.objectifs.create', compact('innovations'));
    }

    public function store(InnovationObjectifRequest $request)
    {
        $objectif = InnovationObjectif::create($request->validated());

        return redirect()
            ->route('back.innovations.objectifs.show', $objectif)
            ->with('success', 'Objectif ajouté.');
    }

    public function show(InnovationObjectif $objectif)
    {
        $objectif->load('innovation');

        return view('back.innovations.objectifs.show', compact('objectif'));
    }

    public function edit(InnovationObjectif $objectif)
    {
        $innovations = Innovation::orderBy('titre')->get();

        return view('back.innovations.objectifs.edit', compact('objectif', 'innovations'));
    }

    public function update(InnovationObjectifRequest $request, InnovationObjectif $objectif)
    {
        $objectif->update($request->validated());

        return redirect()
            ->route('back.innovations.objectifs.show', $objectif)
            ->with('success', 'Objectif mis à jour.');
    }

    public function destroy(InnovationObjectif $objectif)
    {
        $objectif->delete();

        return back()->with('success', 'Objectif supprimé.');
    }

    public function marquerAtteint(InnovationObjectif $objectif)
    {
        $objectif->update(['statut' => 'atteint']);

        return back()->with('success', 'Objectif marqué comme atteint.');
    }

    public function marquerNonAtteint(InnovationObjectif $objectif)
    {
        $objectif->update(['statut' => 'non_atteint']);

        return back()->with('success', 'Objectif marqué comme non atteint.');
    }
}
