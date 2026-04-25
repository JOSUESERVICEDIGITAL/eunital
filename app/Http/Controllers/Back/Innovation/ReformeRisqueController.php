<?php

namespace App\Http\Controllers\Back\Innovation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Innovation\ReformeRisqueRequest;
use App\Models\Innovation\ReformeInterne;
use App\Models\Innovation\ReformeRisque;
use Illuminate\Http\Request;

class ReformeRisqueController extends Controller
{
    public function index(Request $request)
    {
        $query = ReformeRisque::with('reforme');

        if ($request->filled('reforme_interne_id')) {
            $query->where('reforme_interne_id', $request->reforme_interne_id);
        }

        if ($request->filled('niveau')) {
            $query->where('niveau', $request->niveau);
        }

        $risques = $query->latest()->paginate(15)->withQueryString();

        return view('back.innovations.risques.index', compact('risques'));
    }

    public function create()
    {
        $reformes = ReformeInterne::orderBy('titre')->get();

        return view('back.innovations.risques.create', compact('reformes'));
    }

    public function store(ReformeRisqueRequest $request)
    {
        $risque = ReformeRisque::create($request->validated());

        return redirect()
            ->route('back.innovations.risques.show', $risque)
            ->with('success', 'Risque ajouté.');
    }

    public function show(ReformeRisque $risque)
    {
        $risque->load('reforme');

        return view('back.innovations.risques.show', compact('risque'));
    }

    public function edit(ReformeRisque $risque)
    {
        $reformes = ReformeInterne::orderBy('titre')->get();

        return view('back.innovations.risques.edit', compact('risque', 'reformes'));
    }

    public function update(ReformeRisqueRequest $request, ReformeRisque $risque)
    {
        $risque->update($request->validated());

        return redirect()
            ->route('back.innovations.risques.show', $risque)
            ->with('success', 'Risque mis à jour.');
    }

    public function destroy(ReformeRisque $risque)
    {
        $risque->delete();

        return back()->with('success', 'Risque supprimé.');
    }

    public function critiques()
    {
        $risques = ReformeRisque::with('reforme')
            ->where('niveau', 'critique')
            ->latest()
            ->paginate(15);

        return view('back.innovations.risques.critiques', compact('risques'));
    }
}
