<?php

namespace App\Http\Controllers\Back\Innovation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Innovation\ExperimentationRequest;
use App\Models\Innovation\Experimentation;
use App\Models\Innovation\Innovation;
use App\Models\User;
use Illuminate\Http\Request;

class ExperimentationController extends Controller
{
    public function index(Request $request)
    {
        $query = Experimentation::with(['innovation', 'responsable'])
            ->withCount(['sites', 'resultats', 'decisions', 'capitalisations', 'satisfactions']);

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('titre', 'like', "%{$request->search}%")
                    ->orWhere('description', 'like', "%{$request->search}%")
                    ->orWhere('hypothese', 'like', "%{$request->search}%")
                    ->orWhere('protocole', 'like', "%{$request->search}%");
            });
        }

        foreach (['statut', 'innovation_id'] as $filter) {
            if ($request->filled($filter)) {
                $query->where($filter, $request->$filter);
            }
        }

        $experimentations = $query->latest()->paginate(15)->withQueryString();

        $stats = [
            'total' => Experimentation::count(),
            'planifiees' => Experimentation::where('statut', 'planifiee')->count(),
            'en_cours' => Experimentation::where('statut', 'en_cours')->count(),
            'terminees' => Experimentation::where('statut', 'terminee')->count(),
            'suspendues' => Experimentation::where('statut', 'suspendue')->count(),
            'abandonnees' => Experimentation::where('statut', 'abandonnee')->count(),
        ];

        return view('back.innovations.experimentations.index', compact('experimentations', 'stats'));
    }

    public function create()
    {
        $innovations = Innovation::orderBy('titre')->get();
        $users = User::orderBy('name')->get();

        return view('back.innovations.experimentations.create', compact('innovations', 'users'));
    }

    public function store(ExperimentationRequest $request)
    {
        $experimentation = Experimentation::create($request->validated());

        return redirect()
            ->route('back.innovations.experimentations.show', $experimentation)
            ->with('success', 'Expérimentation créée avec succès.');
    }

    public function show(Experimentation $experimentation)
    {
        $experimentation->load([
            'innovation',
            'responsable',
            'sites',
            'resultats',
            'decisions',
            'capitalisations',
            'satisfactions',
        ]);

        return view('back.innovations.experimentations.show', compact('experimentation'));
    }

    public function edit(Experimentation $experimentation)
    {
        $innovations = Innovation::orderBy('titre')->get();
        $users = User::orderBy('name')->get();

        return view('back.innovations.experimentations.edit', compact(
            'experimentation',
            'innovations',
            'users'
        ));
    }

    public function update(ExperimentationRequest $request, Experimentation $experimentation)
    {
        $experimentation->update($request->validated());

        return redirect()
            ->route('back.innovations.experimentations.show', $experimentation)
            ->with('success', 'Expérimentation mise à jour.');
    }

    public function destroy(Experimentation $experimentation)
    {
        $experimentation->delete();

        return redirect()
            ->route('back.innovations.experimentations.index')
            ->with('success', 'Expérimentation archivée.');
    }

    public function changerStatut(Request $request, Experimentation $experimentation)
    {
        $request->validate([
            'statut' => 'required|in:planifiee,en_cours,terminee,suspendue,abandonnee',
        ]);

        $experimentation->update(['statut' => $request->statut]);

        return back()->with('success', 'Statut de l’expérimentation mis à jour.');
    }

    public function resultats(Experimentation $experimentation)
    {
        $experimentation->load('resultats');

        return view('back.innovations.experimentations.resultats', compact('experimentation'));
    }

    public function sites(Experimentation $experimentation)
    {
        $experimentation->load('sites');

        return view('back.innovations.experimentations.sites', compact('experimentation'));
    }

    public function decisions(Experimentation $experimentation)
    {
        $experimentation->load('decisions');

        return view('back.innovations.experimentations.decisions', compact('experimentation'));
    }

    public function rapport(Experimentation $experimentation)
    {
        $experimentation->load([
            'innovation',
            'responsable',
            'sites',
            'resultats',
            'decisions',
        ]);

        return view('back.innovations.experimentations.rapport', compact('experimentation'));
    }
}
