<?php

namespace App\Http\Controllers\Back\Innovation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Innovation\InnovationRequest;
use App\Models\Innovation\Innovation;
use App\Models\Innovation\InnovationPortefeuille;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InnovationController extends Controller
{
    public function index(Request $request)
    {
        $query = Innovation::with(['portefeuille', 'responsable', 'sponsor'])
            ->withCount([
                'objectifs',
                'indicateurs',
                'experimentations',
                'deploiements',
                'suivis',
                'impacts',
                'financements',
            ]);

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('titre', 'like', "%{$request->search}%")
                    ->orWhere('code', 'like', "%{$request->search}%")
                    ->orWhere('description', 'like', "%{$request->search}%")
                    ->orWhere('secteur', 'like', "%{$request->search}%");
            });
        }

        foreach ([
            'statut',
            'type_innovation',
            'niveau_maturite',
            'portee_geographique',
            'niveau_priorite',
            'innovation_portefeuille_id',
        ] as $filter) {
            if ($request->filled($filter)) {
                $query->where($filter, $request->$filter);
            }
        }

        $innovations = $query->latest()->paginate(15)->withQueryString();

        $stats = [
            'total' => Innovation::count(),
            'brouillons' => Innovation::where('statut', 'brouillon')->count(),
            'en_etude' => Innovation::where('statut', 'en_etude')->count(),
            'en_cours' => Innovation::where('statut', 'en_cours')->count(),
            'pilotes' => Innovation::where('statut', 'en_pilote')->count(),
            'deployees' => Innovation::where('statut', 'deployee')->count(),
            'terminees' => Innovation::where('statut', 'terminee')->count(),
            'archivees' => Innovation::where('statut', 'archivee')->count(),
        ];

        return view('back.innovations.innovations.index', compact('innovations', 'stats'));
    }

    public function create()
    {
        $portefeuilles = InnovationPortefeuille::where('statut', 'actif')->orderBy('nom')->get();
        $users = User::orderBy('name')->get();

        return view('back.innovations.innovations.create', compact('portefeuilles', 'users'));
    }

    public function store(InnovationRequest $request)
    {
        $data = $request->validated();

        $data['code'] = $data['code'] ?? 'INNOV-' . strtoupper(Str::random(8));
        $data['slug'] = $data['slug'] ?? Str::slug($data['titre']) . '-' . Str::lower(Str::random(5));

        $innovation = Innovation::create($data);

        return redirect()
            ->route('back.innovations.innovations.show', $innovation)
            ->with('success', 'Innovation créée avec succès.');
    }

    public function show(Innovation $innovation)
    {
        $innovation->load([
            'portefeuille',
            'responsable',
            'sponsor',
            'objectifs',
            'indicateurs',
            'partiesPrenantes',
            'documents',
            'experimentations',
            'prototypes',
            'deploiements',
            'suivis',
            'impacts',
            'financements',
            'budgets',
            'depenses',
            'partenaires',
            'zones',
            'audits',
            'roi',
            'replicabilite',
            'gestionChangements',
            'formations',
            'satisfactions',
            'signalements',
            'benchmarks',
            'capitalisations',
            'alertes',
        ]);

        return view('back.innovations.innovations.show', compact('innovation'));
    }

    public function edit(Innovation $innovation)
    {
        $portefeuilles = InnovationPortefeuille::orderBy('nom')->get();
        $users = User::orderBy('name')->get();

        return view('back.innovations.innovations.edit', compact(
            'innovation',
            'portefeuilles',
            'users'
        ));
    }

    public function update(InnovationRequest $request, Innovation $innovation)
    {
        $data = $request->validated();

        if (empty($data['slug']) && !empty($data['titre'])) {
            $data['slug'] = Str::slug($data['titre']) . '-' . Str::lower(Str::random(5));
        }

        $innovation->update($data);

        return redirect()
            ->route('back.innovations.innovations.show', $innovation)
            ->with('success', 'Innovation mise à jour avec succès.');
    }

    public function destroy(Innovation $innovation)
    {
        $innovation->delete();

        return redirect()
            ->route('back.innovations.innovations.index')
            ->with('success', 'Innovation archivée.');
    }

    public function changerStatut(Request $request, Innovation $innovation)
    {
        $request->validate([
            'statut' => 'required|in:brouillon,en_etude,en_cours,en_pilote,deployee,suspendue,terminee,archivee',
        ]);

        $innovation->update([
            'statut' => $request->statut,
        ]);

        return back()->with('success', 'Statut mis à jour.');
    }

    public function prioriser(Request $request, Innovation $innovation)
    {
        $request->validate([
            'niveau_priorite' => 'required|in:faible,moyenne,haute,critique',
        ]);

        $innovation->update([
            'niveau_priorite' => $request->niveau_priorite,
        ]);

        return back()->with('success', 'Priorité mise à jour.');
    }

    public function dupliquer(Innovation $innovation)
    {
        $copie = $innovation->replicate();
        $copie->code = 'INNOV-' . strtoupper(Str::random(8));
        $copie->slug = Str::slug($innovation->titre) . '-copie-' . Str::lower(Str::random(5));
        $copie->titre = $innovation->titre . ' - copie';
        $copie->statut = 'brouillon';
        $copie->save();

        return redirect()
            ->route('back.innovations.innovations.edit', $copie)
            ->with('success', 'Innovation dupliquée.');
    }

    public function synthese(Innovation $innovation)
    {
        $innovation->load([
            'objectifs',
            'indicateurs',
            'deploiements.adoptions',
            'impacts',
            'financements',
            'suivis',
        ]);

        return view('back.innovations.innovations.synthese', compact('innovation'));
    }

    public function performance(Innovation $innovation)
    {
        $stats = [
            'progression_moyenne' => round($innovation->suivis()->avg('progression'), 2),
            'budget_previsionnel' => $innovation->budget_previsionnel,
            'budget_consomme' => $innovation->budget_consomme,
            'objectifs' => $innovation->objectifs()->count(),
            'objectifs_atteints' => $innovation->objectifs()->where('statut', 'atteint')->count(),
            'impacts' => $innovation->impacts()->count(),
        ];

        return view('back.innovations.innovations.performance', compact('innovation', 'stats'));
    }

    public function timeline(Innovation $innovation)
    {
        $suivis = $innovation->suivis()->latest('date_suivi')->get();
        $experimentations = $innovation->experimentations()->latest()->get();
        $deploiements = $innovation->deploiements()->latest()->get();

        return view('back.innovations.innovations.timeline', compact(
            'innovation',
            'suivis',
            'experimentations',
            'deploiements'
        ));
    }

    public function exportJson(Innovation $innovation)
    {
        $innovation->load([
            'portefeuille',
            'objectifs',
            'indicateurs',
            'experimentations',
            'deploiements',
            'impacts',
            'financements',
        ]);

        return response()->json($innovation);
    }
}
