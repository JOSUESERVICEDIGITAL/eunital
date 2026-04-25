<?php

namespace App\Http\Controllers\Back\Innovation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Innovation\ComiteInnovationRequest;
use App\Models\Innovation\ComiteInnovation;
use Illuminate\Http\Request;

class ComiteInnovationController extends Controller
{
    public function index()
    {
        $comites = ComiteInnovation::withCount('sessions')->paginate(15);

        return view('back.innovations.comites.index', compact('comites'));
    }

    public function create()
    {
        return view('back.innovations.comites.create');
    }

    public function store(ComiteInnovationRequest $request)
    {
        $comite = ComiteInnovation::create($request->validated());

        return redirect()->route('back.innovations.comites.show', $comite)
            ->with('success', 'Comité créé');
    }

    public function show(ComiteInnovation $comite)
    {
        $comite->load(['sessions.participants', 'sessions.decisions']);

        return view('back.innovations.comites.show', compact('comite'));
    }

    public function update(ComiteInnovationRequest $request, ComiteInnovation $comite)
    {
        $comite->update($request->validated());

        return back()->with('success', 'Mis à jour');
    }

    public function destroy(ComiteInnovation $comite)
    {
        $comite->delete();

        return back()->with('success', 'Supprimé');
    }

    public function sessions(ComiteInnovation $comite)
    {
        return view('back.innovations.comites.sessions', compact('comite'));
    }

    public function planning(ComiteInnovation $comite)
    {
        return view('back.innovations.comites.planning', compact('comite'));
    }

    public function decisions(ComiteInnovation $comite)
    {
        return view('back.innovations.comites.decisions', compact('comite'));
    }
}
