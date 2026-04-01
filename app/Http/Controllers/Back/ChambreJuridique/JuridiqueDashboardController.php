<?php

namespace App\Http\Controllers\Back\ChambreJuridique;

use App\Http\Controllers\Controller;
use App\Models\ArchiveHub;
use App\Models\ContratJuridique;
use App\Models\DossierJuridique;
use App\Models\DocumentJuridique;
use App\Models\EngagementJuridique;
use App\Models\ModeleDocumentJuridique;
use App\Models\PieceJointeJuridique;

class JuridiqueDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'contrats' => ContratJuridique::count(),
            'engagements' => EngagementJuridique::count(),
            'modeles' => ModeleDocumentJuridique::count(),
            'documents' => DocumentJuridique::count(),
            'dossiers' => DossierJuridique::count(),
            'archives' => ArchiveHub::count(),
            'pieces_jointes' => PieceJointeJuridique::count(),
        ];

        $derniersContrats = ContratJuridique::with(['client', 'user', 'auteur', 'validateur'])
            ->latest()
            ->take(6)
            ->get();

        $derniersEngagements = EngagementJuridique::with(['client', 'user', 'validateur'])
            ->latest()
            ->take(6)
            ->get();

        $derniersDossiers = DossierJuridique::with(['client', 'responsable'])
            ->latest()
            ->take(6)
            ->get();

        return view('back.chambre-juridique.dashboard', compact(
            'stats',
            'derniersContrats',
            'derniersEngagements',
            'derniersDossiers'
        ));
    }
}
