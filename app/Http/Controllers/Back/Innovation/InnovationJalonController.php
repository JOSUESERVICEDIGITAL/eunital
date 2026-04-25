<?php

namespace App\Http\Controllers\Back\Innovation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Innovation\InnovationJalonRequest;
use App\Models\Innovation\InnovationFeuilleRoute;
use App\Models\Innovation\InnovationJalon;
use Illuminate\Http\Request;

class InnovationJalonController extends Controller
{
    public function index(Request $request)
    {
        $query = InnovationJalon::with('feuilleRoute');

        if ($request->filled('innovation_feuille_route_id')) {
            $query->where('innovation_feuille_route_id', $request->innovation_feuille_route_id);
        }

        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        $jalons = $query->orderBy('date_prevue')->paginate(15)->withQueryString();

        return view('back.innovations.jalons.index', compact('jalons'));
    }

    public function create()
    {
        $feuillesRoutes = InnovationFeuilleRoute::orderBy('titre')->get();

        return view('back.innovations.jalons.create', compact('feuillesRoutes'));
    }

    public function store(InnovationJalonRequest $request)
    {
        $jalon = InnovationJalon::create($request->validated());

        return redirect()
            ->route('back.innovations.jalons.show', $jalon)
            ->with('success', 'Jalon ajouté.');
    }

    public function show(InnovationJalon $jalon)
    {
        $jalon->load('feuilleRoute');

        return view('back.innovations.jalons.show', compact('jalon'));
    }

    public function edit(InnovationJalon $jalon)
    {
        $feuillesRoutes = InnovationFeuilleRoute::orderBy('titre')->get();

        return view('back.innovations.jalons.edit', compact('jalon', 'feuillesRoutes'));
    }

    public function update(InnovationJalonRequest $request, InnovationJalon $jalon)
    {
        $jalon->update($request->validated());

        return redirect()
            ->route('back.innovations.jalons.show', $jalon)
            ->with('success', 'Jalon mis à jour.');
    }

    public function destroy(InnovationJalon $jalon)
    {
        $jalon->delete();

        return back()->with('success', 'Jalon supprimé.');
    }

    public function realiser(InnovationJalon $jalon)
    {
        $jalon->update([
            'statut' => 'realise',
            'date_realisation' => now(),
        ]);

        return back()->with('success', 'Jalon marqué comme réalisé.');
    }

    public function retarder(InnovationJalon $jalon)
    {
        $jalon->update(['statut' => 'retarde']);

        return back()->with('success', 'Jalon marqué en retard.');
    }
}
