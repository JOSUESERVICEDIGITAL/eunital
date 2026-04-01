<?php

namespace App\Http\Controllers\Back\Formation;

use App\Http\Controllers\Controller;
use App\Models\Formation\CategorieModule;
use App\Models\Formation\Module;
use App\Models\Formation\Cour;
use App\Models\Formation\Inscription;
use App\Models\Formation\Devoir;
use App\Models\Formation\SoumissionDevoir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardFormationController extends Controller
{
    public function index()
    {
        // Statistiques globales
        $stats = [
            'total_modules' => Module::count(),
            'total_cours' => Cour::count(),
            'total_cours_publies' => Cour::where('is_published', true)->count(),
            'total_inscriptions' => Inscription::count(),
            'total_inscriptions_validees' => Inscription::where('statut', 'valide')->count(),
            'total_devoirs' => Devoir::count(),
            'total_soumissions' => SoumissionDevoir::count(),
            'total_soumissions_non_corrigees' => SoumissionDevoir::whereNull('note')->count(),
        ];

        // Derniers cours ajoutés
        $derniersCours = Cour::with('module', 'createur')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Dernières inscriptions
        $dernieresInscriptions = Inscription::with('user', 'module')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Progression moyenne par module
        $progressionsParModule = Module::with(['inscriptions' => function($query) {
                $query->where('statut', 'valide');
            }])
            ->get()
            ->map(function($module) {
                return [
                    'module' => $module->titre,
                    'progression_moyenne' => $module->inscriptions->avg('progression') ?? 0,
                    'nb_inscrits' => $module->inscriptions->count()
                ];
            })
            ->sortByDesc('progression_moyenne')
            ->take(5);

        // Cours les plus suivis
        $coursPopulaires = Cour::withCount('utilisateurs')
            ->orderBy('utilisateurs_count', 'desc')
            ->limit(5)
            ->get();

        // Répartition des cours par niveau
        $repartitionNiveaux = Cour::select('niveau_difficulte', DB::raw('count(*) as total'))
            ->groupBy('niveau_difficulte')
            ->get();

        // Évolution des inscriptions (derniers 30 jours)
        $evolutionInscriptions = Inscription::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Devoirs à corriger
        $devoirsACorriger = Devoir::with(['cour', 'soumissions' => function($query) {
                $query->whereNull('note');
            }])
            ->has('soumissions', '>', 0)
            ->get()
            ->map(function($devoir) {
                return [
                    'devoir' => $devoir,
                    'a_corriger' => $devoir->soumissions()->whereNull('note')->count()
                ];
            })
            ->filter(function($item) {
                return $item['a_corriger'] > 0;
            });

        return view('back.formation.dashboard', compact(
            'stats',
            'derniersCours',
            'dernieresInscriptions',
            'progressionsParModule',
            'coursPopulaires',
            'repartitionNiveaux',
            'evolutionInscriptions',
            'devoirsACorriger'
        ));
    }

    public function graphiques()
    {
        $data = [
            'inscriptions_mensuelles' => $this->getInscriptionsMensuelles(),
            'cours_par_categorie' => $this->getCoursParCategorie(),
            'progression_globale' => $this->getProgressionGlobale(),
            'presences' => $this->getStatistiquesPresences()
        ];

        return response()->json($data);
    }

    private function getInscriptionsMensuelles()
    {
        return Inscription::select(DB::raw('MONTH(created_at) as mois'), DB::raw('count(*) as total'))
            ->whereYear('created_at', date('Y'))
            ->groupBy('mois')
            ->orderBy('mois')
            ->get()
            ->pluck('total', 'mois');
    }

    private function getCoursParCategorie()
    {
        return CategorieModule::withCount('modules.cours')
            ->get()
            ->map(function($categorie) {
                return [
                    'categorie' => $categorie->nom,
                    'total' => $categorie->modules->sum(function($module) {
                        return $module->cours->count();
                    })
                ];
            });
    }

    private function getProgressionGlobale()
    {
        $progressionMoyenne = Inscription::where('statut', 'valide')->avg('progression') ?? 0;
        $termines = Inscription::where('statut', 'termine')->count();
        $total = Inscription::where('statut', 'valide')->count();

        return [
            'moyenne' => round($progressionMoyenne, 2),
            'termines' => $termines,
            'total' => $total,
            'pourcentage_termines' => $total > 0 ? round(($termines / $total) * 100, 2) : 0
        ];
    }

    private function getStatistiquesPresences()
    {
        $totalPresences = \App\Models\Formation\Presence::count();
        $presencesPresent = \App\Models\Formation\Presence::where('present', true)->count();

        return [
            'total' => $totalPresences,
            'present' => $presencesPresent,
            'absent' => $totalPresences - $presencesPresent,
            'taux_presence' => $totalPresences > 0 ? round(($presencesPresent / $totalPresences) * 100, 2) : 0
        ];
    }
}