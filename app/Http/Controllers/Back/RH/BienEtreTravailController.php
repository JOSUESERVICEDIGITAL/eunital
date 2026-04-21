<?php

namespace App\Http\Controllers\Back\RH;

use App\Http\Controllers\Controller;
use App\Http\Requests\RH\BienEtreTravailRequest;
use App\Models\Departement;
use App\Models\MembreEquipe;
use App\Models\RH\BienEtreTravail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BienEtreTravailController extends Controller
{
    public function index(Request $request): View
    {
        $query = BienEtreTravail::query()
            ->with([
                'membreEquipe.departement',
                'membreEquipe.poste',
                'auteur',
            ]);

        if ($request->filled('search')) {
            $search = trim((string) $request->input('search'));

            $query->where(function ($q) use ($search) {
                $q->where('titre', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhereHas('membreEquipe', function ($subQ) use ($search) {
                        $subQ->where('nom', 'like', "%{$search}%")
                            ->orWhere('prenom', 'like', "%{$search}%")
                            ->orWhere('email_professionnel', 'like', "%{$search}%");
                    })
                    ->orWhereHas('auteur', function ($subQ) use ($search) {
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

        if ($request->filled('auteur_id')) {
            $query->where('auteur_id', $request->integer('auteur_id'));
        }

        if ($request->filled('type')) {
            $query->where('type', $request->input('type'));
        }

        if ($request->filled('niveau_priorite')) {
            $query->where('niveau_priorite', $request->input('niveau_priorite'));
        }

        if ($request->filled('statut')) {
            $query->where('statut', $request->input('statut'));
        }

        if ($request->filled('date_debut')) {
            $query->whereDate('created_at', '>=', $request->input('date_debut'));
        }

        if ($request->filled('date_fin')) {
            $query->whereDate('created_at', '<=', $request->input('date_fin'));
        }

        $dossiers = $query
            ->latest('created_at')
            ->paginate(15)
            ->withQueryString();

        return view('back.rh.bien-etre.index', [
            'pageTitle' => 'Bien-être au travail',
            'dossiers' => $dossiers,
            'membres' => MembreEquipe::orderBy('nom')->orderBy('prenom')->get(),
            'departements' => Departement::orderBy('nom')->get(),
            'auteurs' => User::orderBy('name')->get(),
            'types' => $this->types(),
            'priorites' => $this->priorites(),
            'statuts' => $this->statuts(),
            'filters' => $request->all(),
        ]);
    }

    public function create(): View
    {
        return view('back.rh.bien-etre.create', [
            'pageTitle' => 'Nouveau dossier bien-être',
            'membres' => MembreEquipe::with(['departement', 'poste'])
                ->orderBy('nom')
                ->orderBy('prenom')
                ->get(),
            'auteurs' => User::orderBy('name')->get(),
            'types' => $this->types(),
            'priorites' => $this->priorites(),
            'statuts' => $this->statuts(),
        ]);
    }

    public function store(BienEtreTravailRequest $request): RedirectResponse
    {
        $dossier = BienEtreTravail::create($request->validated());

        return redirect()
            ->route('back.rh.bien-etre.show', $dossier)
            ->with('success', 'Le dossier bien-être a été créé avec succès.');
    }

    public function show(BienEtreTravail $bienEtreTravail): View
    {
        $bienEtreTravail->load([
            'membreEquipe.departement',
            'membreEquipe.poste',
            'auteur',
        ]);

        return view('back.rh.bien-etre.show', [
            'pageTitle' => 'Détail du dossier bien-être',
            'dossier' => $bienEtreTravail,
            'resume' => $this->buildResume($bienEtreTravail),
        ]);
    }

    public function edit(BienEtreTravail $bienEtreTravail): View
    {
        return view('back.rh.bien-etre.edit', [
            'pageTitle' => 'Modifier le dossier bien-être',
            'dossier' => $bienEtreTravail->load(['membreEquipe', 'auteur']),
            'membres' => MembreEquipe::with(['departement', 'poste'])
                ->orderBy('nom')
                ->orderBy('prenom')
                ->get(),
            'auteurs' => User::orderBy('name')->get(),
            'types' => $this->types(),
            'priorites' => $this->priorites(),
            'statuts' => $this->statuts(),
        ]);
    }

    public function update(BienEtreTravailRequest $request, BienEtreTravail $bienEtreTravail): RedirectResponse
    {
        $bienEtreTravail->update($request->validated());

        return redirect()
            ->route('back.rh.bien-etre.show', $bienEtreTravail)
            ->with('success', 'Le dossier bien-être a été mis à jour avec succès.');
    }

    public function destroy(BienEtreTravail $bienEtreTravail): RedirectResponse
    {
        $bienEtreTravail->delete();

        return redirect()
            ->route('back.rh.bien-etre.index')
            ->with('success', 'Le dossier bien-être a été supprimé avec succès.');
    }

    public function ouverts(Request $request): View
    {
        $dossiers = BienEtreTravail::with([
                'membreEquipe.departement',
                'membreEquipe.poste',
                'auteur',
            ])
            ->where('statut', 'ouvert')
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('back.rh.bien-etre.ouverts', [
            'pageTitle' => 'Dossiers bien-être ouverts',
            'dossiers' => $dossiers,
        ]);
    }

    public function enCours(Request $request): View
    {
        $dossiers = BienEtreTravail::with([
                'membreEquipe.departement',
                'membreEquipe.poste',
                'auteur',
            ])
            ->where('statut', 'en_cours')
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('back.rh.bien-etre.en-cours', [
            'pageTitle' => 'Dossiers bien-être en cours',
            'dossiers' => $dossiers,
        ]);
    }

    public function traites(Request $request): View
    {
        $dossiers = BienEtreTravail::with([
                'membreEquipe.departement',
                'membreEquipe.poste',
                'auteur',
            ])
            ->where('statut', 'traite')
            ->latest('updated_at')
            ->paginate(15)
            ->withQueryString();

        return view('back.rh.bien-etre.traites', [
            'pageTitle' => 'Dossiers bien-être traités',
            'dossiers' => $dossiers,
        ]);
    }

    public function archives(Request $request): View
    {
        $dossiers = BienEtreTravail::with([
                'membreEquipe.departement',
                'membreEquipe.poste',
                'auteur',
            ])
            ->where('statut', 'archive')
            ->latest('updated_at')
            ->paginate(15)
            ->withQueryString();

        return view('back.rh.bien-etre.archives', [
            'pageTitle' => 'Dossiers bien-être archivés',
            'dossiers' => $dossiers,
        ]);
    }

    public function parEmploye(MembreEquipe $membreEquipe, Request $request): View
    {
        $query = BienEtreTravail::with(['membreEquipe', 'auteur'])
            ->where('membre_equipe_id', $membreEquipe->id);

        if ($request->filled('type')) {
            $query->where('type', $request->input('type'));
        }

        if ($request->filled('niveau_priorite')) {
            $query->where('niveau_priorite', $request->input('niveau_priorite'));
        }

        if ($request->filled('statut')) {
            $query->where('statut', $request->input('statut'));
        }

        $dossiers = $query
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $stats = [
            'total' => BienEtreTravail::where('membre_equipe_id', $membreEquipe->id)->count(),
            'ouverts' => BienEtreTravail::where('membre_equipe_id', $membreEquipe->id)->where('statut', 'ouvert')->count(),
            'en_cours' => BienEtreTravail::where('membre_equipe_id', $membreEquipe->id)->where('statut', 'en_cours')->count(),
            'traites' => BienEtreTravail::where('membre_equipe_id', $membreEquipe->id)->where('statut', 'traite')->count(),
            'archives' => BienEtreTravail::where('membre_equipe_id', $membreEquipe->id)->where('statut', 'archive')->count(),
        ];

        return view('back.rh.bien-etre.par-employe', [
            'pageTitle' => 'Bien-être par employé',
            'membre' => $membreEquipe->load(['departement', 'poste']),
            'dossiers' => $dossiers,
            'stats' => $stats,
            'types' => $this->types(),
            'priorites' => $this->priorites(),
            'statuts' => $this->statuts(),
        ]);
    }

    public function statistiques(Request $request): View
    {
        $dateDebut = $request->filled('date_debut')
            ? Carbon::parse($request->input('date_debut'))
            : Carbon::today()->startOfMonth();

        $dateFin = $request->filled('date_fin')
            ? Carbon::parse($request->input('date_fin'))
            : Carbon::today()->endOfMonth();

        $baseQuery = BienEtreTravail::whereBetween('created_at', [
            $dateDebut->copy()->startOfDay(),
            $dateFin->copy()->endOfDay(),
        ]);

        $stats = [
            'total' => (clone $baseQuery)->count(),
            'ouverts' => (clone $baseQuery)->where('statut', 'ouvert')->count(),
            'en_cours' => (clone $baseQuery)->where('statut', 'en_cours')->count(),
            'traites' => (clone $baseQuery)->where('statut', 'traite')->count(),
            'archives' => (clone $baseQuery)->where('statut', 'archive')->count(),
            'priorite_urgente' => (clone $baseQuery)->where('niveau_priorite', 'urgente')->count(),
            'priorite_haute' => (clone $baseQuery)->where('niveau_priorite', 'haute')->count(),
        ];

        $statsParType = BienEtreTravail::whereBetween('created_at', [
                $dateDebut->copy()->startOfDay(),
                $dateFin->copy()->endOfDay(),
            ])
            ->selectRaw('type, COUNT(*) as total')
            ->groupBy('type')
            ->pluck('total', 'type');

        $statsParPriorite = BienEtreTravail::whereBetween('created_at', [
                $dateDebut->copy()->startOfDay(),
                $dateFin->copy()->endOfDay(),
            ])
            ->selectRaw('niveau_priorite, COUNT(*) as total')
            ->groupBy('niveau_priorite')
            ->pluck('total', 'niveau_priorite');

        $statsParDepartement = BienEtreTravail::query()
            ->join('membres_equipe', 'bien_etre_travail.membre_equipe_id', '=', 'membres_equipe.id')
            ->join('departements', 'membres_equipe.departement_id', '=', 'departements.id')
            ->whereBetween('bien_etre_travail.created_at', [
                $dateDebut->copy()->startOfDay(),
                $dateFin->copy()->endOfDay(),
            ])
            ->selectRaw('departements.nom as departement, COUNT(bien_etre_travail.id) as total')
            ->groupBy('departements.nom')
            ->orderByDesc('total')
            ->get();

        return view('back.rh.bien-etre.statistiques', [
            'pageTitle' => 'Statistiques bien-être',
            'dateDebut' => $dateDebut,
            'dateFin' => $dateFin,
            'stats' => $stats,
            'statsParType' => $statsParType,
            'statsParPriorite' => $statsParPriorite,
            'statsParDepartement' => $statsParDepartement,
        ]);
    }

    public function suivi(BienEtreTravail $bienEtreTravail): View
    {
        $bienEtreTravail->load([
            'membreEquipe.departement',
            'membreEquipe.poste',
            'auteur',
        ]);

        $timeline = collect([
            [
                'type' => 'creation',
                'date' => $bienEtreTravail->created_at,
                'titre' => 'Dossier créé',
                'description' => 'Création du dossier bien-être.',
            ],
            [
                'type' => 'statut',
                'date' => $bienEtreTravail->updated_at,
                'titre' => 'Statut actuel',
                'description' => 'Statut : ' . $bienEtreTravail->statut,
            ],
            [
                'type' => 'priorite',
                'date' => $bienEtreTravail->updated_at,
                'titre' => 'Priorité',
                'description' => 'Niveau : ' . $bienEtreTravail->niveau_priorite,
            ],
        ])->filter(fn ($item) => !empty($item['date']))
            ->sortByDesc('date')
            ->values();

        return view('back.rh.bien-etre.suivi', [
            'pageTitle' => 'Suivi du dossier bien-être',
            'dossier' => $bienEtreTravail,
             'timeline' => $timeline,
        ]);
    }

    private function buildResume(BienEtreTravail $dossier): array
    {
        return [
            'titre' => $dossier->titre,
            'type' => $dossier->type,
            'priorite' => $dossier->niveau_priorite,
            'statut' => $dossier->statut,
            'employe' => optional($dossier->membreEquipe)->nom . ' ' . optional($dossier->membreEquipe)->prenom,
            'auteur' => optional($dossier->auteur)->name,
        ];
    }

    private function types(): array
    {
        return [
            'signalement' => 'Signalement',
            'accompagnement' => 'Accompagnement',
            'incident' => 'Incident',
            'suggestion' => 'Suggestion',
            'suivi' => 'Suivi',
        ];
    }

    private function priorites(): array
    {
        return [
            'faible' => 'Faible',
            'moyenne' => 'Moyenne',
            'haute' => 'Haute',
            'urgente' => 'Urgente',
        ];
    }

    private function statuts(): array
    {
        return [
            'ouvert' => 'Ouvert',
            'en_cours' => 'En cours',
            'traite' => 'Traité',
            'archive' => 'Archivé',
        ];
    }
}