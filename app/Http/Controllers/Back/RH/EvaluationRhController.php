<?php

namespace App\Http\Controllers\Back\RH;

use App\Http\Controllers\Controller;
use App\Http\Requests\RH\EvaluationRhRequest;
use App\Models\Departement;
use App\Models\MembreEquipe;
use App\Models\RH\EvaluationRh;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EvaluationRhController extends Controller
{
    public function index(Request $request): View
    {
        $query = EvaluationRh::query()
            ->with([
                'membreEquipe.departement',
                'membreEquipe.poste',
                'evaluateur',
            ]);

        if ($request->filled('search')) {
            $search = trim((string) $request->input('search'));

            $query->where(function ($q) use ($search) {
                $q->where('titre', 'like', "%{$search}%")
                    ->orWhere('points_forts', 'like', "%{$search}%")
                    ->orWhere('points_a_ameliorer', 'like', "%{$search}%")
                    ->orWhere('recommandations', 'like', "%{$search}%")
                    ->orWhereHas('membreEquipe', function ($subQ) use ($search) {
                        $subQ->where('nom', 'like', "%{$search}%")
                            ->orWhere('prenom', 'like', "%{$search}%")
                            ->orWhere('email_professionnel', 'like', "%{$search}%");
                    })
                    ->orWhereHas('evaluateur', function ($subQ) use ($search) {
                        $subQ->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('membre_equipe_id')) {
            $query->where('membre_equipe_id', $request->integer('membre_equipe_id'));
        }

        if ($request->filled('departement_id')) {
            $departementId = $request->integer('departement_id');

            $query->whereHas('membreEquipe', function ($q) use ($departementId) {
                $q->where('departement_id', $departementId);
            });
        }

        if ($request->filled('evaluateur_id')) {
            $query->where('evaluateur_id', $request->integer('evaluateur_id'));
        }

        if ($request->filled('statut')) {
            $query->where('statut', $request->input('statut'));
        }

        if ($request->filled('note_min')) {
            $query->where('note_globale', '>=', (int) $request->input('note_min'));
        }

        if ($request->filled('note_max')) {
            $query->where('note_globale', '<=', (int) $request->input('note_max'));
        }

        if ($request->filled('date_evaluation_debut')) {
            $query->whereDate('date_evaluation', '>=', $request->input('date_evaluation_debut'));
        }

        if ($request->filled('date_evaluation_fin')) {
            $query->whereDate('date_evaluation', '<=', $request->input('date_evaluation_fin'));
        }

        $evaluations = $query
            ->latest('date_evaluation')
            ->latest('created_at')
            ->paginate(15)
            ->withQueryString();

        return view('back.rh.evaluations.index', [
            'pageTitle' => 'Évaluations RH',
            'evaluations' => $evaluations,
            'membres' => MembreEquipe::orderBy('nom')->orderBy('prenom')->get(),
            'departements' => Departement::orderBy('nom')->get(),
            'evaluateurs' => User::orderBy('name')->get(),
            'statuts' => $this->statuts(),
            'filters' => $request->all(),
        ]);
    }

    public function create(): View
    {
        return view('back.rh.evaluations.create', [
            'pageTitle' => 'Nouvelle évaluation',
            'membres' => MembreEquipe::with(['departement', 'poste'])
                ->orderBy('nom')
                ->orderBy('prenom')
                ->get(),
            'evaluateurs' => User::orderBy('name')->get(),
            'statuts' => $this->statuts(),
        ]);
    }

    public function store(EvaluationRhRequest $request): RedirectResponse
    {
        $evaluation = EvaluationRh::create($request->validated());

        return redirect()
            ->route('rh.evaluations.show', $evaluation)
            ->with('success', 'L’évaluation a été créée avec succès.');
    }

    public function show(EvaluationRh $evaluationRh): View
    {
        $evaluationRh->load([
            'membreEquipe.departement',
            'membreEquipe.poste',
            'evaluateur',
        ]);

        return view('back.rh.evaluations.show', [
            'pageTitle' => 'Détail de l’évaluation',
            'evaluation' => $evaluationRh,
            'resume' => $this->buildResume($evaluationRh),
        ]);
    }

    public function edit(EvaluationRh $evaluationRh): View
    {
        return view('back.rh.evaluations.edit', [
            'pageTitle' => 'Modifier l’évaluation',
            'evaluation' => $evaluationRh->load(['membreEquipe', 'evaluateur']),
            'membres' => MembreEquipe::with(['departement', 'poste'])
                ->orderBy('nom')
                ->orderBy('prenom')
                ->get(),
            'evaluateurs' => User::orderBy('name')->get(),
            'statuts' => $this->statuts(),
        ]);
    }

    public function update(EvaluationRhRequest $request, EvaluationRh $evaluationRh): RedirectResponse
    {
        $evaluationRh->update($request->validated());

        return redirect()
            ->route('rh.evaluations.show', $evaluationRh)
            ->with('success', 'L’évaluation a été mise à jour avec succès.');
    }

    public function destroy(EvaluationRh $evaluationRh): RedirectResponse
    {
        $evaluationRh->delete();

        return redirect()
            ->route('rh.evaluations.index')
            ->with('success', 'L’évaluation a été supprimée avec succès.');
    }

    public function validees(Request $request): View
    {
        $evaluations = EvaluationRh::with([
                'membreEquipe.departement',
                'membreEquipe.poste',
                'evaluateur',
            ])
            ->where('statut', 'validee')
            ->latest('date_evaluation')
            ->paginate(15)
            ->withQueryString();

        return view('back.rh.evaluations.validees', [
            'pageTitle' => 'Évaluations validées',
            'evaluations' => $evaluations,
        ]);
    }

    public function brouillons(Request $request): View
    {
        $evaluations = EvaluationRh::with([
                'membreEquipe.departement',
                'membreEquipe.poste',
                'evaluateur',
            ])
            ->where('statut', 'brouillon')
            ->latest('created_at')
            ->paginate(15)
            ->withQueryString();

        return view('back.rh.evaluations.brouillons', [
            'pageTitle' => 'Évaluations en brouillon',
            'evaluations' => $evaluations,
        ]);
    }

    public function archivees(Request $request): View
    {
        $evaluations = EvaluationRh::with([
                'membreEquipe.departement',
                'membreEquipe.poste',
                'evaluateur',
            ])
            ->where('statut', 'archivee')
            ->latest('updated_at')
            ->paginate(15)
            ->withQueryString();

        return view('back.rh.evaluations.archivees', [
            'pageTitle' => 'Évaluations archivées',
            'evaluations' => $evaluations,
        ]);
    }

    public function parEmploye(MembreEquipe $membreEquipe, Request $request): View
    {
        $query = EvaluationRh::with(['membreEquipe', 'evaluateur'])
            ->where('membre_equipe_id', $membreEquipe->id);

        if ($request->filled('statut')) {
            $query->where('statut', $request->input('statut'));
        }

        if ($request->filled('date_evaluation_debut')) {
            $query->whereDate('date_evaluation', '>=', $request->input('date_evaluation_debut'));
        }

        if ($request->filled('date_evaluation_fin')) {
            $query->whereDate('date_evaluation', '<=', $request->input('date_evaluation_fin'));
        }

        $evaluations = $query
            ->latest('date_evaluation')
            ->paginate(15)
            ->withQueryString();

        $stats = [
            'total' => EvaluationRh::where('membre_equipe_id', $membreEquipe->id)->count(),
            'brouillon' => EvaluationRh::where('membre_equipe_id', $membreEquipe->id)->where('statut', 'brouillon')->count(),
            'validee' => EvaluationRh::where('membre_equipe_id', $membreEquipe->id)->where('statut', 'validee')->count(),
            'archivee' => EvaluationRh::where('membre_equipe_id', $membreEquipe->id)->where('statut', 'archivee')->count(),
            'moyenne_note' => round(
                (float) EvaluationRh::where('membre_equipe_id', $membreEquipe->id)
                    ->whereNotNull('note_globale')
                    ->avg('note_globale'),
                2
            ),
        ];

        return view('back.rh.evaluations.par-employe', [
            'pageTitle' => 'Évaluations par employé',
            'membre' => $membreEquipe->load(['departement', 'poste']),
            'evaluations' => $evaluations,
            'stats' => $stats,
            'statuts' => $this->statuts(),
        ]);
    }

    public function historique(EvaluationRh $evaluationRh): View
    {
        $evaluationRh->load([
            'membreEquipe.departement',
            'membreEquipe.poste',
            'evaluateur',
        ]);

        $timeline = collect([
            [
                'type' => 'creation',
                'date' => $evaluationRh->created_at,
                'titre' => 'Évaluation créée',
                'description' => 'Création initiale de l’évaluation.',
            ],
            [
                'type' => 'statut',
                'date' => $evaluationRh->updated_at,
                'titre' => 'Statut actuel',
                'description' => 'Statut : ' . $evaluationRh->statut,
            ],
            [
                'type' => 'evaluation',
                'date' => $evaluationRh->date_evaluation,
                'titre' => 'Date d’évaluation',
                'description' => $evaluationRh->date_evaluation
                    ? Carbon::parse($evaluationRh->date_evaluation)->format('d/m/Y')
                    : 'Date non définie',
            ],
        ])->filter(fn ($item) => !empty($item['date']))
            ->sortByDesc('date')
            ->values();

        return view('back.rh.evaluations.historique', [
            'pageTitle' => 'Historique de l’évaluation',
            'evaluation' => $evaluationRh,
            'timeline' => $timeline,
        ]);
    }

    public function synthese(Request $request): View
    {
        $dateDebut = $request->filled('date_debut')
            ? Carbon::parse($request->input('date_debut'))
            : Carbon::today()->startOfMonth();

        $dateFin = $request->filled('date_fin')
            ? Carbon::parse($request->input('date_fin'))
            : Carbon::today()->endOfMonth();

        $baseQuery = EvaluationRh::whereBetween('created_at', [
            $dateDebut->copy()->startOfDay(),
            $dateFin->copy()->endOfDay(),
        ]);

        $stats = [
            'total' => (clone $baseQuery)->count(),
            'brouillon' => (clone $baseQuery)->where('statut', 'brouillon')->count(),
            'validee' => (clone $baseQuery)->where('statut', 'validee')->count(),
            'archivee' => (clone $baseQuery)->where('statut', 'archivee')->count(),
            'moyenne_globale' => round(
                (float) (clone $baseQuery)->whereNotNull('note_globale')->avg('note_globale'),
                2
            ),
        ];

        $topNotes = EvaluationRh::with(['membreEquipe.departement', 'evaluateur'])
            ->whereBetween('created_at', [
                $dateDebut->copy()->startOfDay(),
                $dateFin->copy()->endOfDay(),
            ])
            ->whereNotNull('note_globale')
            ->orderByDesc('note_globale')
            ->take(10)
            ->get();

        $besoinsProgression = EvaluationRh::with(['membreEquipe.departement', 'evaluateur'])
            ->whereBetween('created_at', [
                $dateDebut->copy()->startOfDay(),
                $dateFin->copy()->endOfDay(),
            ])
            ->whereNotNull('note_globale')
            ->where('note_globale', '<=', 5)
            ->orderBy('note_globale')
            ->take(10)
            ->get();

        $statsParDepartement = EvaluationRh::query()
            ->join('membres_equipe', 'evaluations_rh.membre_equipe_id', '=', 'membres_equipe.id')
            ->join('departements', 'membres_equipe.departement_id', '=', 'departements.id')
            ->whereBetween('evaluations_rh.created_at', [
                $dateDebut->copy()->startOfDay(),
                $dateFin->copy()->endOfDay(),
            ])
            ->selectRaw('departements.nom as departement, COUNT(evaluations_rh.id) as total, AVG(evaluations_rh.note_globale) as moyenne')
            ->groupBy('departements.nom')
            ->orderByDesc('total')
            ->get();

        return view('back.rh.evaluations.synthese', [
            'pageTitle' => 'Synthèse des évaluations',
            'dateDebut' => $dateDebut,
            'dateFin' => $dateFin,
            'stats' => $stats,
            'topNotes' => $topNotes,
            'besoinsProgression' => $besoinsProgression,
            'statsParDepartement' => $statsParDepartement,
        ]);
    }

    private function buildResume(EvaluationRh $evaluation): array
    {
        return [
            'note' => $evaluation->note_globale,
            'statut' => $evaluation->statut,
            'date_evaluation' => $evaluation->date_evaluation,
            'employe' => optional($evaluation->membreEquipe)->nom . ' ' . optional($evaluation->membreEquipe)->prenom,
            'evaluateur' => optional($evaluation->evaluateur)->name,
        ];
    }

    private function statuts(): array
    {
        return [
            'brouillon' => 'Brouillon',
            'validee' => 'Validée',
            'archivee' => 'Archivée',
        ];
    }
}