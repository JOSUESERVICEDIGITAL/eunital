<?php

namespace App\Http\Controllers\Back\Innovation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Innovation\DeploiementInnovationRequest;
use App\Models\Innovation\DeploiementInnovation;
use App\Models\Innovation\Innovation;
use Illuminate\Http\Request;

class DeploiementInnovationController extends Controller
{
    public function index(Request $request)
    {
        $query = DeploiementInnovation::with('innovation')
            ->withCount(['zones', 'incidents', 'adoptions', 'couvertures', 'formations', 'signalements']);

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('titre', 'like', "%{$request->search}%")
                    ->orWhere('description', 'like', "%{$request->search}%")
                    ->orWhere('mode_deploiement', 'like', "%{$request->search}%");
            });
        }

        foreach (['statut', 'innovation_id'] as $filter) {
            if ($request->filled($filter)) {
                $query->where($filter, $request->$filter);
            }
        }

        $deploiements = $query->latest()->paginate(15)->withQueryString();

        $stats = [
            'total' => DeploiementInnovation::count(),
            'planifies' => DeploiementInnovation::where('statut', 'planifie')->count(),
            'en_cours' => DeploiementInnovation::where('statut', 'en_cours')->count(),
            'termines' => DeploiementInnovation::where('statut', 'termine')->count(),
            'suspendus' => DeploiementInnovation::where('statut', 'suspendu')->count(),
        ];

        return view('back.innovations.deploiements.index', compact('deploiements', 'stats'));
    }

    public function create()
    {
        $innovations = Innovation::orderBy('titre')->get();

        return view('back.innovations.deploiements.create', compact('innovations'));
    }

    public function store(DeploiementInnovationRequest $request)
    {
        $deploiement = DeploiementInnovation::create($request->validated());

        return redirect()
            ->route('back.innovations.deploiements.show', $deploiement)
            ->with('success', 'Déploiement créé avec succès.');
    }

    public function show(DeploiementInnovation $deploiement)
    {
        $deploiement->load([
            'innovation',
            'zones',
            'incidents',
            'adoptions.details',
            'couvertures',
            'formations',
            'signalements',
        ]);

        return view('back.innovations.deploiements.show', compact('deploiement'));
    }

    public function edit(DeploiementInnovation $deploiement)
    {
        $innovations = Innovation::orderBy('titre')->get();

        return view('back.innovations.deploiements.edit', compact('deploiement', 'innovations'));
    }

    public function update(DeploiementInnovationRequest $request, DeploiementInnovation $deploiement)
    {
        $deploiement->update($request->validated());

        return redirect()
            ->route('back.innovations.deploiements.show', $deploiement)
            ->with('success', 'Déploiement mis à jour.');
    }

    public function destroy(DeploiementInnovation $deploiement)
    {
        $deploiement->delete();

        return redirect()
            ->route('back.innovations.deploiements.index')
            ->with('success', 'Déploiement archivé.');
    }

    public function changerStatut(Request $request, DeploiementInnovation $deploiement)
    {
        $request->validate([
            'statut' => 'required|in:planifie,en_cours,termine,suspendu',
        ]);

        $deploiement->update(['statut' => $request->statut]);

        return back()->with('success', 'Statut du déploiement mis à jour.');
    }

    public function couverture(DeploiementInnovation $deploiement)
    {
        $deploiement->load('couvertures');

        return view('back.innovations.deploiements.couverture', compact('deploiement'));
    }

    public function adoption(DeploiementInnovation $deploiement)
    {
        $deploiement->load('adoptions.details');

        return view('back.innovations.deploiements.adoption', compact('deploiement'));
    }

    public function incidents(DeploiementInnovation $deploiement)
    {
        $deploiement->load('incidents');

        return view('back.innovations.deploiements.incidents', compact('deploiement'));
    }

    public function carte(DeploiementInnovation $deploiement)
    {
        $deploiement->load('zones');

        return view('back.innovations.deploiements.carte', compact('deploiement'));
    }
}
