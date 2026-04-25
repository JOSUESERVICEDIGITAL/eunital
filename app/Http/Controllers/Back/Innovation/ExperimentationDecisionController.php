<?php

namespace App\Http\Controllers\Back\Innovation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Innovation\ExperimentationDecisionRequest;
use App\Models\Innovation\Experimentation;
use App\Models\Innovation\ExperimentationDecision;
use App\Models\User;
use Illuminate\Http\Request;

class ExperimentationDecisionController extends Controller
{
    public function index(Request $request)
    {
        $query = ExperimentationDecision::with(['experimentation', 'auteur']);

        if ($request->filled('experimentation_id')) {
            $query->where('experimentation_id', $request->experimentation_id);
        }

        if ($request->filled('decision')) {
            $query->where('decision', $request->decision);
        }

        $decisions = $query->latest('date_decision')->paginate(15)->withQueryString();

        return view('back.innovations.experimentation-decisions.index', compact('decisions'));
    }

    public function create()
    {
        $experimentations = Experimentation::orderBy('titre')->get();
        $users = User::orderBy('name')->get();

        return view('back.innovations.experimentation-decisions.create', compact('experimentations', 'users'));
    }

    public function store(ExperimentationDecisionRequest $request)
    {
        $decision = ExperimentationDecision::create($request->validated());

        return redirect()
            ->route('back.innovations.experimentation-decisions.show', $decision)
            ->with('success', 'Décision ajoutée.');
    }

    public function show(ExperimentationDecision $decision)
    {
        $decision->load(['experimentation', 'auteur']);

        return view('back.innovations.experimentation-decisions.show', compact('decision'));
    }

    public function edit(ExperimentationDecision $decision)
    {
        $experimentations = Experimentation::orderBy('titre')->get();
        $users = User::orderBy('name')->get();

        return view('back.innovations.experimentation-decisions.edit', compact('decision', 'experimentations', 'users'));
    }

    public function update(ExperimentationDecisionRequest $request, ExperimentationDecision $decision)
    {
        $decision->update($request->validated());

        return redirect()
            ->route('back.innovations.experimentation-decisions.show', $decision)
            ->with('success', 'Décision mise à jour.');
    }

    public function destroy(ExperimentationDecision $decision)
    {
        $decision->delete();

        return back()->with('success', 'Décision supprimée.');
    }
}
