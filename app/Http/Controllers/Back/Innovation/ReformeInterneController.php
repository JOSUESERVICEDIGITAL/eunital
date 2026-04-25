<?php

namespace App\Http\Controllers\Back\Innovation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Innovation\ReformeInterneRequest;
use App\Models\Innovation\ReformeInterne;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ReformeInterneController extends Controller
{
    public function index(Request $request)
    {
        $query = ReformeInterne::with('responsable')
            ->withCount(['actions', 'risques', 'decisions']);

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('titre', 'like', "%{$request->search}%")
                    ->orWhere('code', 'like', "%{$request->search}%")
                    ->orWhere('domaine', 'like', "%{$request->search}%")
                    ->orWhere('description', 'like', "%{$request->search}%");
            });
        }

        foreach (['statut', 'niveau_priorite'] as $filter) {
            if ($request->filled($filter)) {
                $query->where($filter, $request->$filter);
            }
        }

        $reformes = $query->latest()->paginate(15)->withQueryString();

        $stats = [
            'total' => ReformeInterne::count(),
            'brouillons' => ReformeInterne::where('statut', 'brouillon')->count(),
            'planifiees' => ReformeInterne::where('statut', 'planifiee')->count(),
            'en_cours' => ReformeInterne::where('statut', 'en_cours')->count(),
            'terminees' => ReformeInterne::where('statut', 'terminee')->count(),
            'suspendues' => ReformeInterne::where('statut', 'suspendue')->count(),
        ];

        return view('back.innovations.reformes.index', compact('reformes', 'stats'));
    }

    public function create()
    {
        $users = User::orderBy('name')->get();

        return view('back.innovations.reformes.create', compact('users'));
    }

    public function store(ReformeInterneRequest $request)
    {
        $data = $request->validated();
        $data['code'] = $data['code'] ?? 'REF-' . strtoupper(Str::random(8));

        $reforme = ReformeInterne::create($data);

        return redirect()
            ->route('back.innovations.reformes.show', $reforme)
            ->with('success', 'Réforme créée avec succès.');
    }

    public function show(ReformeInterne $reforme)
    {
        $reforme->load([
            'responsable',
            'actions.responsable',
            'risques',
            'decisions',
            'gestionChangements',
        ]);

        return view('back.innovations.reformes.show', compact('reforme'));
    }

    public function edit(ReformeInterne $reforme)
    {
        $users = User::orderBy('name')->get();

        return view('back.innovations.reformes.edit', compact('reforme', 'users'));
    }

    public function update(ReformeInterneRequest $request, ReformeInterne $reforme)
    {
        $reforme->update($request->validated());

        return redirect()
            ->route('back.innovations.reformes.show', $reforme)
            ->with('success', 'Réforme mise à jour.');
    }

    public function destroy(ReformeInterne $reforme)
    {
        $reforme->delete();

        return redirect()
            ->route('back.innovations.reformes.index')
            ->with('success', 'Réforme archivée.');
    }

    public function changerStatut(Request $request, ReformeInterne $reforme)
    {
        $request->validate([
            'statut' => 'required|in:brouillon,planifiee,en_cours,suspendue,terminee,archivee',
        ]);

        $reforme->update(['statut' => $request->statut]);

        return back()->with('success', 'Statut de la réforme mis à jour.');
    }

    public function risques(ReformeInterne $reforme)
    {
        $reforme->load('risques');

        return view('back.innovations.reformes.risques', compact('reforme'));
    }

    public function actions(ReformeInterne $reforme)
    {
        $reforme->load('actions.responsable');

        return view('back.innovations.reformes.actions', compact('reforme'));
    }

    public function decisions(ReformeInterne $reforme)
    {
        $reforme->load('decisions');

        return view('back.innovations.reformes.decisions', compact('reforme'));
    }

    public function synthese(ReformeInterne $reforme)
    {
        $stats = [
            'actions_total' => $reforme->actions()->count(),
            'actions_realisees' => $reforme->actions()->where('statut', 'realisee')->count(),
            'risques_critiques' => $reforme->risques()->where('niveau', 'critique')->count(),
            'decisions' => $reforme->decisions()->count(),
        ];

        return view('back.innovations.reformes.synthese', compact('reforme', 'stats'));
    }
}
