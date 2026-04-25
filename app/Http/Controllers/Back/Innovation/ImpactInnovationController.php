<?php

namespace App\Http\Controllers\Back\Innovation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Innovation\ImpactInnovationRequest;
use App\Models\Innovation\ImpactInnovation;
use App\Models\Innovation\Innovation;
use Illuminate\Http\Request;

class ImpactInnovationController extends Controller
{
    public function index()
    {
        $impacts = ImpactInnovation::with('innovation')->latest()->paginate(15);

        return view('back.innovations.impacts.index', compact('impacts'));
    }

    public function create()
    {
        return view('back.innovations.impacts.create', [
            'innovations' => Innovation::all(),
        ]);
    }

    public function store(ImpactInnovationRequest $request)
    {
        $data = $request->validated();

        if (isset($data['valeur_avant'], $data['valeur_apres'])) {
            $data['variation'] = $data['valeur_apres'] - $data['valeur_avant'];
        }

        $impact = ImpactInnovation::create($data);

        return redirect()->route('back.innovations.impacts.show', $impact)
            ->with('success', 'Impact créé');
    }

    public function show(ImpactInnovation $impact)
    {
        $impact->load(['mesures', 'beneficiaires', 'rapports']);

        return view('back.innovations.impacts.show', compact('impact'));
    }

    public function update(ImpactInnovationRequest $request, ImpactInnovation $impact)
    {
        $impact->update($request->validated());

        return back()->with('success', 'Mis à jour');
    }

    public function destroy(ImpactInnovation $impact)
    {
        $impact->delete();

        return back()->with('success', 'Supprimé');
    }

    public function mesures(ImpactInnovation $impact)
    {
        return view('back.innovations.impacts.mesures', compact('impact'));
    }

    public function beneficiaires(ImpactInnovation $impact)
    {
        return view('back.innovations.impacts.beneficiaires', compact('impact'));
    }

    public function rapports(ImpactInnovation $impact)
    {
        return view('back.innovations.impacts.rapports', compact('impact'));
    }
}
