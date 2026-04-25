<?php

namespace App\Http\Controllers\Back\Innovation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Innovation\ReformeActionRequest;
use App\Models\Innovation\ReformeAction;
use App\Models\Innovation\ReformeInterne;
use App\Models\User;
use Illuminate\Http\Request;

class ReformeActionController extends Controller
{
    public function index(Request $request)
    {
        $query = ReformeAction::with(['reforme', 'responsable']);

        if ($request->filled('reforme_interne_id')) {
            $query->where('reforme_interne_id', $request->reforme_interne_id);
        }

        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        $actions = $query->latest()->paginate(15)->withQueryString();

        return view('back.innovations.actions.index', compact('actions'));
    }

    public function create()
    {
        $reformes = ReformeInterne::orderBy('titre')->get();
        $users = User::orderBy('name')->get();

        return view('back.innovations.actions.create', compact('reformes', 'users'));
    }

    public function store(ReformeActionRequest $request)
    {
        $action = ReformeAction::create($request->validated());

        return redirect()
            ->route('back.innovations.actions.show', $action)
            ->with('success', 'Action ajoutée.');
    }

    public function show(ReformeAction $action)
    {
        $action->load(['reforme', 'responsable']);

        return view('back.innovations.actions.show', compact('action'));
    }

    public function edit(ReformeAction $action)
    {
        $reformes = ReformeInterne::orderBy('titre')->get();
        $users = User::orderBy('name')->get();

        return view('back.innovations.actions.edit', compact('action', 'reformes', 'users'));
    }

    public function update(ReformeActionRequest $request, ReformeAction $action)
    {
        $action->update($request->validated());

        return redirect()
            ->route('back.innovations.actions.show', $action)
            ->with('success', 'Action mise à jour.');
    }

    public function destroy(ReformeAction $action)
    {
        $action->delete();

        return back()->with('success', 'Action supprimée.');
    }

    public function terminer(ReformeAction $action)
    {
        $action->update(['statut' => 'realisee']);

        return back()->with('success', 'Action terminée.');
    }

    public function bloquer(ReformeAction $action)
    {
        $action->update(['statut' => 'bloquee']);

        return back()->with('success', 'Action bloquée.');
    }
}
