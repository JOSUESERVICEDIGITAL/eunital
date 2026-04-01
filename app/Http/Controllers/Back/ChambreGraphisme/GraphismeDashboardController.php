<?php

namespace App\Http\Controllers\Back\ChambreGraphisme;

use App\Http\Controllers\Controller;
use App\Models\AfficheFlyer;
use App\Models\CreationGraphique;
use App\Models\DemandeClientGraphisme;
use App\Models\IdentiteVisuelle;
use App\Models\MaquetteGraphique;
use App\Models\UiuxDesign;
use App\Models\VisuelReseauSocial;

class GraphismeDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'creations' => CreationGraphique::count(),
            'identites' => IdentiteVisuelle::count(),
            'affiches' => AfficheFlyer::count(),
            'reseaux' => VisuelReseauSocial::count(),
            'uiux' => UiuxDesign::count(),
            'maquettes' => MaquetteGraphique::count(),
            'demandes' => DemandeClientGraphisme::count(),
        ];

        $dernieresCreations = CreationGraphique::with(['client', 'projet', 'auteur'])
            ->latest()
            ->take(6)
            ->get();

        $dernieresDemandes = DemandeClientGraphisme::with('client')
            ->latest()
            ->take(6)
            ->get();

        return view('back.chambre-graphisme.dashboard', compact(
            'stats',
            'dernieresCreations',
            'dernieresDemandes'
        ));
    }
}
