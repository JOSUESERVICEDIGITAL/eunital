<?php

namespace App\Http\Controllers\Back\Innovation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Innovation\IdeeInnovationRequest;
use App\Models\Innovation\IdeeInnovation;
use App\Models\Innovation\IdeeTag;
use App\Models\User;
use Illuminate\Http\Request;

class IdeeInnovationController extends Controller
{
    public function index(Request $request)
    {
        $query = IdeeInnovation::with(['auteur', 'tags'])
            ->withCount(['commentaires', 'votes']);

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('titre', 'like', "%{$request->search}%")
                    ->orWhere('description', 'like', "%{$request->search}%")
                    ->orWhere('categorie', 'like', "%{$request->search}%");
            });
        }

        foreach (['origine', 'statut', 'niveau_maturite', 'impact_potentiel', 'faisabilite'] as $filter) {
            if ($request->filled($filter)) {
                $query->where($filter, $request->$filter);
            }
        }

        $idees = $query->latest()->paginate(15)->withQueryString();

        $stats = [
            'total' => IdeeInnovation::count(),
            'soumises' => IdeeInnovation::where('statut', 'soumise')->count(),
            'en_etude' => IdeeInnovation::where('statut', 'en_etude')->count(),
            'retenues' => IdeeInnovation::where('statut', 'retenue')->count(),
            'rejetees' => IdeeInnovation::where('statut', 'rejetee')->count(),
            'transformees' => IdeeInnovation::where('statut', 'transformee_en_innovation')->count(),
        ];

        return view('back.innovations.idees.index', compact('idees', 'stats'));
    }

    public function create()
    {
        $users = User::orderBy('name')->get();
        $tags = IdeeTag::orderBy('nom')->get();

        return view('back.innovations.idees.create', compact('users', 'tags'));
    }

    public function store(IdeeInnovationRequest $request)
    {
        $idee = IdeeInnovation::create($request->validated());

        if ($request->has('tags')) {
            $idee->tags()->sync($request->tags ?? []);
        }

        return redirect()
            ->route('back.innovations.idees.show', $idee)
            ->with('success', 'Idée créée avec succès.');
    }

    public function show(IdeeInnovation $idee)
    {
        $idee->load(['auteur', 'tags', 'commentaires', 'votes']);

        return view('back.innovations.idees.show', compact('idee'));
    }

    public function edit(IdeeInnovation $idee)
    {
        $users = User::orderBy('name')->get();
        $tags = IdeeTag::orderBy('nom')->get();

        return view('back.innovations.idees.edit', compact('idee', 'users', 'tags'));
    }

    public function update(IdeeInnovationRequest $request, IdeeInnovation $idee)
    {
        $idee->update($request->validated());

        if ($request->has('tags')) {
            $idee->tags()->sync($request->tags ?? []);
        }

        return redirect()
            ->route('back.innovations.idees.show', $idee)
            ->with('success', 'Idée mise à jour.');
    }

    public function destroy(IdeeInnovation $idee)
    {
        $idee->delete();

        return redirect()
            ->route('back.innovations.idees.index')
            ->with('success', 'Idée archivée.');
    }

    public function changerStatut(Request $request, IdeeInnovation $idee)
    {
        $request->validate([
            'statut' => 'required|in:soumise,en_etude,retenue,rejetee,transformee_en_innovation',
        ]);

        $idee->update(['statut' => $request->statut]);

        return back()->with('success', 'Statut de l’idée mis à jour.');
    }

    public function shortlist()
    {
        $idees = IdeeInnovation::withCount('votes')
            ->whereIn('statut', ['soumise', 'en_etude', 'retenue'])
            ->orderByDesc('votes_count')
            ->paginate(15);

        return view('back.innovations.idees.shortlist', compact('idees'));
    }

    public function populaires()
    {
        $idees = IdeeInnovation::withCount('votes')
            ->orderByDesc('votes_count')
            ->paginate(15);

        return view('back.innovations.idees.populaires', compact('idees'));
    }

    public function maturite()
    {
        $stats = IdeeInnovation::selectRaw('niveau_maturite, COUNT(*) as total')
            ->groupBy('niveau_maturite')
            ->pluck('total', 'niveau_maturite');

        return view('back.innovations.idees.maturite', compact('stats'));
    }
}