<?php

namespace App\Http\Controllers\Back\Innovation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Innovation\FinancementInnovationRequest;
use App\Models\Innovation\FinancementInnovation;
use App\Models\Innovation\Innovation;
use Illuminate\Http\Request;

class FinancementInnovationController extends Controller
{
    public function index()
    {
        $financements = FinancementInnovation::with('innovation')->paginate(15);

        return view('back.innovations.financements.index', compact('financements'));
    }

    public function create()
    {
        return view('back.innovations.financements.create', [
            'innovations' => Innovation::all(),
        ]);
    }

    public function store(FinancementInnovationRequest $request)
    {
        $financement = FinancementInnovation::create($request->validated());

        return redirect()->route('back.innovations.financements.show', $financement)
            ->with('success', 'Financement ajouté');
    }

    public function show(FinancementInnovation $financement)
    {
        return view('back.innovations.financements.show', compact('financement'));
    }

    public function update(FinancementInnovationRequest $request, FinancementInnovation $financement)
    {
        $financement->update($request->validated());

        return back()->with('success', 'Mis à jour');
    }

    public function destroy(FinancementInnovation $financement)
    {
        $financement->delete();

        return back()->with('success', 'Supprimé');
    }

    public function stats()
    {
        $stats = [
            'total_prevu' => FinancementInnovation::sum('montant_prevu'),
            'total_obtenu' => FinancementInnovation::sum('montant_obtenu'),
        ];

        return view('back.innovations.financements.stats', compact('stats'));
    }
}
