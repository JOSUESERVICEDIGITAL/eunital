<?php

namespace App\Http\Controllers\Back\Innovation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Innovation\PropositionAmeliorationRequest;
use App\Models\Innovation\PropositionAmelioration;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PropositionAmeliorationController extends Controller
{
    public function index(Request $request)
    {
        $query = PropositionAmelioration::with(['auteur', 'decideur'])
            ->withCount(['commentaires', 'votes', 'piecesJointes']);

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('titre', 'like', "%{$request->search}%")
                    ->orWhere('code', 'like', "%{$request->search}%")
                    ->orWhere('description', 'like', "%{$request->search}%")
                    ->orWhere('service_concerne', 'like', "%{$request->search}%")
                    ->orWhere('institution_source', 'like', "%{$request->search}%");
            });
        }

        foreach (['origine', 'statut', 'niveau_priorite', 'faisabilite'] as $filter) {
            if ($request->filled($filter)) {
                $query->where($filter, $request->$filter);
            }
        }

        $propositions = $query->latest()->paginate(15)->withQueryString();

        $stats = [
            'total' => PropositionAmelioration::count(),
            'soumis' => PropositionAmelioration::where('statut', 'soumis')->count(),
            'en_etude' => PropositionAmelioration::where('statut', 'en_etude')->count(),
            'retenus' => PropositionAmelioration::where('statut', 'retenu')->count(),
            'rejetes' => PropositionAmelioration::where('statut', 'rejete')->count(),
            'transformes' => PropositionAmelioration::where('statut', 'transforme_en_projet')->count(),
        ];

        return view('back.innovations.propositions.index', compact('propositions', 'stats'));
    }

    public function create()
    {
        $users = User::orderBy('name')->get();

        return view('back.innovations.propositions.create', compact('users'));
    }

    public function store(PropositionAmeliorationRequest $request)
    {
        $data = $request->validated();
        $data['code'] = $data['code'] ?? 'PROP-' . strtoupper(Str::random(8));
        $data['date_soumission'] = $data['date_soumission'] ?? now();

        $proposition = PropositionAmelioration::create($data);

        return redirect()
            ->route('back.innovations.propositions.show', $proposition)
            ->with('success', 'Proposition créée avec succès.');
    }

    public function show(PropositionAmelioration $proposition)
    {
        $proposition->load([
            'auteur',
            'decideur',
            'commentaires',
            'votes',
            'piecesJointes',
            'historiquesStatuts',
        ]);

        return view('back.innovations.propositions.show', compact('proposition'));
    }

    public function edit(PropositionAmelioration $proposition)
    {
        $users = User::orderBy('name')->get();

        return view('back.innovations.propositions.edit', compact('proposition', 'users'));
    }

    public function update(PropositionAmeliorationRequest $request, PropositionAmelioration $proposition)
    {
        $proposition->update($request->validated());

        return redirect()
            ->route('back.innovations.propositions.show', $proposition)
            ->with('success', 'Proposition mise à jour.');
    }

    public function destroy(PropositionAmelioration $proposition)
    {
        $proposition->delete();

        return redirect()
            ->route('back.innovations.propositions.index')
            ->with('success', 'Proposition archivée.');
    }

    public function changerStatut(Request $request, PropositionAmelioration $proposition)
    {
        $request->validate([
            'statut' => 'required|in:soumis,en_etude,retenu,rejete,transforme_en_projet',
            'motif' => 'nullable|string',
        ]);

        $ancien = $proposition->statut;

        $proposition->update([
            'statut' => $request->statut,
            'date_decision' => in_array($request->statut, ['retenu', 'rejete', 'transforme_en_projet']) ? now() : $proposition->date_decision,
            'decideur_id' => auth()->id(),
        ]);

        $proposition->historiquesStatuts()->create([
            'ancien_statut' => $ancien,
            'nouveau_statut' => $request->statut,
            'motif' => $request->motif,
            'changed_by' => auth()->id(),
        ]);

        return back()->with('success', 'Statut de la proposition mis à jour.');
    }

    public function retenir(PropositionAmelioration $proposition)
    {
        $proposition->update([
            'statut' => 'retenu',
            'date_decision' => now(),
            'decideur_id' => auth()->id(),
        ]);

        return back()->with('success', 'Proposition retenue.');
    }

    public function rejeter(Request $request, PropositionAmelioration $proposition)
    {
        $request->validate(['motif' => 'nullable|string']);

        $proposition->update([
            'statut' => 'rejete',
            'date_decision' => now(),
            'decideur_id' => auth()->id(),
        ]);

        return back()->with('success', 'Proposition rejetée.');
    }

    public function analyse(PropositionAmelioration $proposition)
    {
        $proposition->load(['commentaires', 'votes', 'piecesJointes', 'historiquesStatuts']);

        $analyse = [
            'votes_pour' => $proposition->votes()->where('vote', 'pour')->count(),
            'votes_contre' => $proposition->votes()->where('vote', 'contre')->count(),
            'votes_neutres' => $proposition->votes()->where('vote', 'neutre')->count(),
            'commentaires' => $proposition->commentaires()->count(),
            'pieces_jointes' => $proposition->piecesJointes()->count(),
        ];

        return view('back.innovations.propositions.analyse', compact('proposition', 'analyse'));
    }
}
