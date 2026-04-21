<?php

namespace App\Http\Controllers\Back\RH;

use App\Http\Controllers\Controller;
use App\Models\MembreEquipe;
use App\Models\RH\BienEtreTravail;
use App\Models\RH\Candidature;
use App\Models\RH\CongeRh;
use App\Models\RH\DossierPersonnel;
use App\Models\RH\EvaluationRh;
use App\Models\RH\PresenceRh;
use App\Models\RH\Recrutement;
use App\Models\RH\SanctionDisciplinaire;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardRhController extends Controller
{
    public function index(Request $request): View
    {
        $today = Carbon::today();
        $startOfMonth = $today->copy()->startOfMonth();
        $endOfMonth = $today->copy()->endOfMonth();
        $startOfWeek = $today->copy()->startOfWeek();
        $endOfWeek = $today->copy()->endOfWeek();

        $stats = $this->buildStats($today, $startOfWeek, $endOfWeek, $startOfMonth, $endOfMonth);
        $alertes = $this->buildAlertes($today);
        $activites = $this->buildActivitesRecentes();
        $widgets = $this->buildWidgets($today, $startOfMonth, $endOfMonth);

        return view('back.rh.dashboard.index', [
            'pageTitle' => 'Dashboard RH',
            'stats' => $stats,
            'alertes' => $alertes,
            'activites' => $activites,
            'widgets' => $widgets,
            'today' => $today,
        ]);
    }

    public function statistiques(Request $request): JsonResponse
    {
        $today = Carbon::today();
        $startOfMonth = $today->copy()->startOfMonth();
        $endOfMonth = $today->copy()->endOfMonth();
        $startOfWeek = $today->copy()->startOfWeek();
        $endOfWeek = $today->copy()->endOfWeek();

        return response()->json([
            'success' => true,
            'data' => $this->buildStats($today, $startOfWeek, $endOfWeek, $startOfMonth, $endOfMonth),
        ]);
    }

    public function alertes(Request $request): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $this->buildAlertes(Carbon::today()),
        ]);
    }

    public function activitesRecentes(Request $request): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $this->buildActivitesRecentes(),
        ]);
    }

    public function indicateurs(Request $request): JsonResponse
    {
        $today = Carbon::today();
        $startOfMonth = $today->copy()->startOfMonth();
        $endOfMonth = $today->copy()->endOfMonth();
        $startOfWeek = $today->copy()->startOfWeek();
        $endOfWeek = $today->copy()->endOfWeek();

        $stats = $this->buildStats($today, $startOfWeek, $endOfWeek, $startOfMonth, $endOfMonth);

        return response()->json([
            'success' => true,
            'data' => [
                'employes' => [
                    'total' => $stats['employes']['total'],
                    'actifs' => $stats['employes']['actifs'],
                    'inactifs' => $stats['employes']['inactifs'],
                    'en_pause' => $stats['employes']['en_pause'],
                ],
                'recrutements' => [
                    'ouverts' => $stats['recrutements']['ouverts'],
                    'en_cours' => $stats['recrutements']['en_cours'],
                    'candidatures_du_mois' => $stats['recrutements']['candidatures_du_mois'],
                ],
                'conges' => [
                    'en_attente' => $stats['conges']['en_attente'],
                    'valides_du_mois' => $stats['conges']['valides_du_mois'],
                ],
                'presences' => [
                    'present_du_jour' => $stats['presences']['present_du_jour'],
                    'absents_du_jour' => $stats['presences']['absents_du_jour'],
                    'retards_du_jour' => $stats['presences']['retards_du_jour'],
                    'taux_presence_jour' => $stats['presences']['taux_presence_jour'],
                ],
                'evaluations' => [
                    'a_valider' => $stats['evaluations']['a_valider'],
                    'validees_du_mois' => $stats['evaluations']['validees_du_mois'],
                ],
                'discipline' => [
                    'sanctions_actives' => $stats['discipline']['sanctions_actives'],
                ],
                'bien_etre' => [
                    'ouverts' => $stats['bien_etre']['ouverts'],
                    'urgents' => $stats['bien_etre']['urgents'],
                ],
            ],
        ]);
    }

    public function widgets(Request $request): JsonResponse
    {
        $today = Carbon::today();
        $startOfMonth = $today->copy()->startOfMonth();
        $endOfMonth = $today->copy()->endOfMonth();

        return response()->json([
            'success' => true,
            'data' => $this->buildWidgets($today, $startOfMonth, $endOfMonth),
        ]);
    }

    private function buildStats(
        Carbon $today,
        Carbon $startOfWeek,
        Carbon $endOfWeek,
        Carbon $startOfMonth,
        Carbon $endOfMonth
    ): array {
        $totalEmployes = MembreEquipe::count();
        $employesActifs = MembreEquipe::where('statut', 'actif')->count();
        $employesInactifs = MembreEquipe::where('statut', 'inactif')->count();
        $employesEnPause = MembreEquipe::where('statut', 'en_pause')->count();

        $totalDossiers = DossierPersonnel::count();
        $dossiersActifs = DossierPersonnel::where('statut_professionnel', 'en_poste')->count();
        $dossiersArchives = DossierPersonnel::where('statut_professionnel', 'archive')->count();

        $presencesDuJour = PresenceRh::whereDate('date_presence', $today)->count();
        $presentDuJour = PresenceRh::whereDate('date_presence', $today)
            ->where('statut', 'present')
            ->count();
        $absentsDuJour = PresenceRh::whereDate('date_presence', $today)
            ->where('statut', 'absent')
            ->count();
        $retardsDuJour = PresenceRh::whereDate('date_presence', $today)
            ->where('statut', 'retard')
            ->count();
        $teletravailDuJour = PresenceRh::whereDate('date_presence', $today)
            ->where('statut', 'teletravail')
            ->count();

        $totalPresencePositive = $presentDuJour + $retardsDuJour + $teletravailDuJour;
        $tauxPresenceJour = $totalEmployes > 0
            ? round(($totalPresencePositive / $totalEmployes) * 100, 2)
            : 0;

        $presencesSemaine = PresenceRh::whereBetween('date_presence', [
            $startOfWeek->toDateString(),
            $endOfWeek->toDateString(),
        ])->count();

        $congesEnAttente = CongeRh::where('statut', 'en_attente')->count();
        $congesValidesDuMois = CongeRh::where('statut', 'valide')
            ->whereBetween('date_debut', [$startOfMonth->toDateString(), $endOfMonth->toDateString()])
            ->count();
        $congesRefusesDuMois = CongeRh::where('statut', 'refuse')
            ->whereBetween('updated_at', [
                $startOfMonth->copy()->startOfDay(),
                $endOfMonth->copy()->endOfDay(),
            ])->count();

        $recrutementsOuverts = Recrutement::where('statut', 'ouvert')->count();
        $recrutementsEnCours = Recrutement::where('statut', 'en_cours')->count();
        $candidaturesDuMois = Candidature::whereBetween('created_at', [
            $startOfMonth->copy()->startOfDay(),
            $endOfMonth->copy()->endOfDay(),
        ])->count();
        $candidaturesRetenues = Candidature::where('statut', 'retenu')->count();

        $evaluationsAValider = EvaluationRh::where('statut', 'brouillon')->count();
        $evaluationsValideesDuMois = EvaluationRh::where('statut', 'validee')
            ->whereBetween('updated_at', [
                $startOfMonth->copy()->startOfDay(),
                $endOfMonth->copy()->endOfDay(),
            ])->count();
        $moyenneEvaluations = round((float) EvaluationRh::whereNotNull('note_globale')->avg('note_globale'), 2);

        $sanctionsActives = SanctionDisciplinaire::where('statut', 'active')->count();
        $sanctionsLeveesDuMois = SanctionDisciplinaire::where('statut', 'levee')
            ->whereBetween('updated_at', [
                $startOfMonth->copy()->startOfDay(),
                $endOfMonth->copy()->endOfDay(),
            ])->count();

        $bienEtreOuverts = BienEtreTravail::whereIn('statut', ['ouvert', 'en_cours'])->count();
        $bienEtreUrgents = BienEtreTravail::whereIn('statut', ['ouvert', 'en_cours'])
            ->where('niveau_priorite', 'urgente')
            ->count();
        $bienEtreHauts = BienEtreTravail::whereIn('statut', ['ouvert', 'en_cours'])
            ->where('niveau_priorite', 'haute')
            ->count();

        return [
            'employes' => [
                'total' => $totalEmployes,
                'actifs' => $employesActifs,
                'inactifs' => $employesInactifs,
                'en_pause' => $employesEnPause,
            ],
            'dossiers' => [
                'total' => $totalDossiers,
                'actifs' => $dossiersActifs,
                'archives' => $dossiersArchives,
            ],
            'presences' => [
                'du_jour' => $presencesDuJour,
                'present_du_jour' => $presentDuJour,
                'absents_du_jour' => $absentsDuJour,
                'retards_du_jour' => $retardsDuJour,
                'teletravail_du_jour' => $teletravailDuJour,
                'semaine' => $presencesSemaine,
                'taux_presence_jour' => $tauxPresenceJour,
            ],
            'conges' => [
                'en_attente' => $congesEnAttente,
                'valides_du_mois' => $congesValidesDuMois,
                'refuses_du_mois' => $congesRefusesDuMois,
            ],
            'recrutements' => [
                'ouverts' => $recrutementsOuverts,
                'en_cours' => $recrutementsEnCours,
                'candidatures_du_mois' => $candidaturesDuMois,
                'candidatures_retenues' => $candidaturesRetenues,
            ],
            'evaluations' => [
                'a_valider' => $evaluationsAValider,
                'validees_du_mois' => $evaluationsValideesDuMois,
                'moyenne_notes' => $moyenneEvaluations,
            ],
            'discipline' => [
                'sanctions_actives' => $sanctionsActives,
                'sanctions_levees_du_mois' => $sanctionsLeveesDuMois,
            ],
            'bien_etre' => [
                'ouverts' => $bienEtreOuverts,
                'urgents' => $bienEtreUrgents,
                'haute_priorite' => $bienEtreHauts,
            ],
        ];
    }

    private function buildAlertes(Carbon $today): array
    {
        $congesEnAttente = CongeRh::with(['membreEquipe'])
            ->where('statut', 'en_attente')
            ->latest()
            ->take(5)
            ->get();

        $recrutementsSansResponsable = Recrutement::whereIn('statut', ['ouvert', 'en_cours'])
            ->whereNull('responsable_id')
            ->latest()
            ->take(5)
            ->get();

        $evaluationsEnRetard = EvaluationRh::with(['membreEquipe'])
            ->where('statut', 'brouillon')
            ->whereDate('created_at', '<=', $today->copy()->subDays(15)->toDateString())
            ->latest()
            ->take(5)
            ->get();

        $sanctionsActives = SanctionDisciplinaire::with(['membreEquipe'])
            ->where('statut', 'active')
            ->latest()
            ->take(5)
            ->get();

        $bienEtreUrgent = BienEtreTravail::with(['membreEquipe'])
            ->whereIn('statut', ['ouvert', 'en_cours'])
            ->whereIn('niveau_priorite', ['haute', 'urgente'])
            ->latest()
            ->take(5)
            ->get();

        return [
            'conges_en_attente' => $congesEnAttente,
            'recrutements_sans_responsable' => $recrutementsSansResponsable,
            'evaluations_en_retard' => $evaluationsEnRetard,
            'sanctions_actives' => $sanctionsActives,
            'bien_etre_urgent' => $bienEtreUrgent,
        ];
    }

    private function buildActivitesRecentes(): array
    {
        $activites = collect();

        $conges = CongeRh::with('membreEquipe')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($item) {
                return [
                    'type' => 'conge',
                    'date' => $item->created_at,
                    'titre' => 'Nouvelle demande de congé',
                    'description' => trim((optional($item->membreEquipe)->nom ?? '') . ' ' . (optional($item->membreEquipe)->prenom ?? '')),
                    'statut' => $item->statut,
                    'url' => route('rh.conges.show', $item),
                ];
            });

        $candidatures = Candidature::latest()
            ->take(5)
            ->get()
            ->map(function ($item) {
                return [
                    'type' => 'candidature',
                    'date' => $item->created_at,
                    'titre' => 'Nouvelle candidature',
                    'description' => trim(($item->nom ?? '') . ' ' . ($item->prenom ?? '')),
                    'statut' => $item->statut,
                    'url' => route('rh.candidatures.show', $item),
                ];
            });

        $evaluations = EvaluationRh::with('membreEquipe')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($item) {
                return [
                    'type' => 'evaluation',
                    'date' => $item->created_at,
                    'titre' => 'Nouvelle évaluation',
                    'description' => trim((optional($item->membreEquipe)->nom ?? '') . ' ' . (optional($item->membreEquipe)->prenom ?? '')),
                    'statut' => $item->statut,
                    'url' => route('rh.evaluations.show', $item),
                ];
            });

        $sanctions = SanctionDisciplinaire::with('membreEquipe')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($item) {
                return [
                    'type' => 'sanction',
                    'date' => $item->created_at,
                    'titre' => 'Nouvelle sanction disciplinaire',
                    'description' => trim((optional($item->membreEquipe)->nom ?? '') . ' ' . (optional($item->membreEquipe)->prenom ?? '')),
                    'statut' => $item->statut,
                    'url' => route('rh.sanctions.show', $item),
                ];
            });

        $bienEtre = BienEtreTravail::with('membreEquipe')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($item) {
                return [
                    'type' => 'bien_etre',
                    'date' => $item->created_at,
                    'titre' => 'Nouveau dossier bien-être',
                    'description' => $item->titre,
                    'statut' => $item->statut,
                    'url' => route('rh.bien-etre.show', $item),
                ];
            });

        $dossiers = DossierPersonnel::with('membreEquipe')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($item) {
                return [
                    'type' => 'dossier',
                    'date' => $item->created_at,
                    'titre' => 'Nouveau dossier du personnel',
                    'description' => trim((optional($item->membreEquipe)->nom ?? '') . ' ' . (optional($item->membreEquipe)->prenom ?? '')),
                    'statut' => $item->statut_professionnel,
                    'url' => route('rh.dossiers-personnel.show', $item),
                ];
            });

        $activites = $activites
            ->merge($conges)
            ->merge($candidatures)
            ->merge($evaluations)
            ->merge($sanctions)
            ->merge($bienEtre)
            ->merge($dossiers)
            ->sortByDesc('date')
            ->take(12)
            ->values();

        return $activites->all();
    }

    private function buildWidgets(Carbon $today, Carbon $startOfMonth, Carbon $endOfMonth): array
    {
        $congesParStatut = CongeRh::selectRaw('statut, COUNT(*) as total')
            ->groupBy('statut')
            ->pluck('total', 'statut');

        $candidaturesParStatut = Candidature::selectRaw('statut, COUNT(*) as total')
            ->groupBy('statut')
            ->pluck('total', 'statut');

        $presencesParStatutDuJour = PresenceRh::whereDate('date_presence', $today->toDateString())
            ->selectRaw('statut, COUNT(*) as total')
            ->groupBy('statut')
            ->pluck('total', 'statut');

        $evaluationsParStatut = EvaluationRh::selectRaw('statut, COUNT(*) as total')
            ->groupBy('statut')
            ->pluck('total', 'statut');

        $bienEtreParPriorite = BienEtreTravail::whereBetween('created_at', [
                $startOfMonth->copy()->startOfDay(),
                $endOfMonth->copy()->endOfDay(),
            ])
            ->selectRaw('niveau_priorite, COUNT(*) as total')
            ->groupBy('niveau_priorite')
            ->pluck('total', 'niveau_priorite');

        return [
            'conges_par_statut' => $congesParStatut,
            'candidatures_par_statut' => $candidaturesParStatut,
            'presences_par_statut_du_jour' => $presencesParStatutDuJour,
            'evaluations_par_statut' => $evaluationsParStatut,
            'bien_etre_par_priorite' => $bienEtreParPriorite,
            'periode' => [
                'debut_mois' => $startOfMonth->toDateString(),
                'fin_mois' => $endOfMonth->toDateString(),
            ],
        ];
    }
}