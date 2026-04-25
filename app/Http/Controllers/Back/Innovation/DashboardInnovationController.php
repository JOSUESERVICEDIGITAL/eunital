<?php

namespace App\Http\Controllers\Back\Innovation;

use App\Http\Controllers\Controller;
use App\Models\Innovation\Innovation;
use App\Models\Innovation\InnovationPortefeuille;
use App\Models\Innovation\PropositionAmelioration;
use App\Models\Innovation\IdeeInnovation;
use App\Models\Innovation\ReformeInterne;
use App\Models\Innovation\Experimentation;
use App\Models\Innovation\DeploiementInnovation;
use App\Models\Innovation\ImpactInnovation;
use App\Models\Innovation\FinancementInnovation;

class DashboardInnovationController extends Controller
{
    public function index()
    {
        $stats = [
            'portefeuilles' => InnovationPortefeuille::count(),
            'innovations' => Innovation::count(),
            'propositions' => PropositionAmelioration::count(),
            'idees' => IdeeInnovation::count(),
            'reformes' => ReformeInterne::count(),
            'experimentations' => Experimentation::count(),
            'deploiements' => DeploiementInnovation::count(),
            'impacts' => ImpactInnovation::count(),
            'financements' => FinancementInnovation::sum('montant_obtenu'),
        ];

        $innovationsRecentes = Innovation::with(['portefeuille', 'responsable'])
            ->latest()
            ->limit(8)
            ->get();

        $propositionsUrgentes = PropositionAmelioration::where('niveau_priorite', 'critique')
            ->latest()
            ->limit(8)
            ->get();

        $deploiementsEnCours = DeploiementInnovation::with('innovation')
            ->where('statut', 'en_cours')
            ->latest()
            ->limit(8)
            ->get();

        return view('back.innovations.dashboard', compact(
            'stats',
            'innovationsRecentes',
            'propositionsUrgentes',
            'deploiementsEnCours'
        ));
    }

    public function pilotage()
    {
        $parStatut = Innovation::selectRaw('statut, COUNT(*) as total')
            ->groupBy('statut')
            ->pluck('total', 'statut');

        $parType = Innovation::selectRaw('type_innovation, COUNT(*) as total')
            ->groupBy('type_innovation')
            ->pluck('total', 'type_innovation');

        $parPriorite = Innovation::selectRaw('niveau_priorite, COUNT(*) as total')
            ->groupBy('niveau_priorite')
            ->pluck('total', 'niveau_priorite');

        return view('back.innovations.dashboard-pilotage', compact(
            'parStatut',
            'parType',
            'parPriorite'
        ));
    }

    public function cartographie()
    {
        $innovations = Innovation::with('portefeuille')
            ->whereNotNull('region_id')
            ->latest()
            ->get();

        return view('back.innovations.cartographie', compact('innovations'));
    }

    public function alertes()
    {
        $innovationsCritiques = Innovation::where('niveau_priorite', 'critique')
            ->whereNotIn('statut', ['terminee', 'archivee'])
            ->latest()
            ->get();

        $deploiementsSuspendus = DeploiementInnovation::where('statut', 'suspendu')
            ->with('innovation')
            ->latest()
            ->get();

        return view('back.innovations.alertes', compact(
            'innovationsCritiques',
            'deploiementsSuspendus'
        ));
    }
}
