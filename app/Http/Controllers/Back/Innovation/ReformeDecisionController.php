<?php

namespace App\Http\Controllers\Back\Innovation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Innovation\ReformeDecisionRequest;
use App\Models\Innovation\ReformeDecision;
use App\Models\Innovation\ReformeInterne;
use App\Models\User;
use Illuminate\Http\Request;

class ReformeDecisionController extends Controller
{
    public function index(Request $request)
    {
        $query = ReformeDecision::with(['reforme', 'auteur']);

        if ($request->filled('reforme_interne_id')) {
            $query->where('reforme_interne_id', $request->reforme_interne_id);
        }

        $decisions = $query->latest('date_decision')->paginate(15)->withQueryString();

        return view('back.innovations.decisions.index', compact('decisions'));
    }

    public function create()
    {
        $reformes = ReformeInterne::orderBy('titre')->get();
        $users = User::orderBy('name')->get();

        return view('back.innovations.decisions.create', compact('reformes', 'users'));
    }

    public function store(ReformeDecisionRequest $request)
    {
        $decision = ReformeDecision::create($request->validated());

        return redirect()
            ->route('back.innovations.decisions.show', $decision)
            ->with('success', 'Décision ajoutée.');
    }

    public function show(ReformeDecision $decision)
    {
        $decision->load(['reforme', 'auteur']);

        return view('back.innovations.decisions.show', compact('decision'));
    }

    public function edit(ReformeDecision $decision)
    {
        $reformes = ReformeInterne::orderBy('titre')->get();
        $users = User::orderBy('name')->get();

        return view('back.innovations.decisions.edit', compact('decision', 'reformes', 'users'));
    }

    public function update(ReformeDecisionRequest $request, ReformeDecision $decision)
    {
        $decision->update($request->validated());

        return redirect()
            ->route('back.innovations.decisions.show', $decision)
            ->with('success', 'Décision mise à jour.');
    }

    public function destroy(ReformeDecision $decision)
    {
        $decision->delete();

        return back()->with('success', 'Décision supprimée.');
    }
}
