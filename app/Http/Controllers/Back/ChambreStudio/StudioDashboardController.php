<?php

namespace App\Http\Controllers\Back\ChambreStudio;

use Carbon\Carbon;
use App\Models\CommandeStudio;
use App\Models\EvenementStudio;
use App\Models\ProductionAudio;
use App\Models\ProductionVideo;
use App\Models\ReservationStudio;
use App\Models\EquipementStudio;
use App\Http\Controllers\Controller;

class StudioDashboardController extends Controller
{
    public function index()
    {
        $totalVideos = ProductionVideo::count();
        $videosTournage = ProductionVideo::where('statut', 'tournage')->count();
        $videosMontage = ProductionVideo::where('statut', 'montage')->count();
        $videosLivrees = ProductionVideo::where('statut', 'livre')->count();

        $totalAudios = ProductionAudio::count();
        $audiosEnregistrement = ProductionAudio::where('statut', 'enregistrement')->count();
        $audiosMixage = ProductionAudio::where('statut', 'mixage')->count();
        $audiosLivres = ProductionAudio::where('statut', 'livre')->count();

        $commandesEnCours = CommandeStudio::with('client')
            ->where('statut', 'en_cours')
            ->latest()
            ->take(6)
            ->get();

        $commandesEnAttenteCount = CommandeStudio::where('statut', 'en_attente')->count();
        $commandesLivreesCount = CommandeStudio::where('statut', 'livree')->count();

        $reservationsAujourdhui = ReservationStudio::with('client')
            ->whereDate('date_debut', Carbon::today())
            ->orderBy('date_debut')
            ->take(8)
            ->get();

        $evenementsAVenir = EvenementStudio::with('client')
            ->whereDate('date', '>=', Carbon::today())
            ->where('statut', 'planifie')
            ->orderBy('date')
            ->take(6)
            ->get();

        $equipementsMaintenance = EquipementStudio::where('statut', 'maintenance')->count();
        $equipementsDisponibles = EquipementStudio::where('statut', 'disponible')->count();
        $equipementsUtilisation = EquipementStudio::where('statut', 'en_utilisation')->count();

        return view('back.chambre-studio.dashboard', compact(
            'totalVideos',
            'videosTournage',
            'videosMontage',
            'videosLivrees',
            'totalAudios',
            'audiosEnregistrement',
            'audiosMixage',
            'audiosLivres',
            'commandesEnCours',
            'commandesEnAttenteCount',
            'commandesLivreesCount',
            'reservationsAujourdhui',
            'evenementsAVenir',
            'equipementsMaintenance',
            'equipementsDisponibles',
            'equipementsUtilisation'
        ));
    }
}