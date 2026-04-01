<?php

namespace App\Http\Controllers\Back\ChambreStudio;

use App\Models\EquipementStudio;
use App\Http\Controllers\Controller;
use App\Http\Requests\EnregistrerEquipementStudioRequest;
use App\Http\Requests\ModifierEquipementStudioRequest;

class EquipementStudioController extends Controller
{
    public function listeTous()
    {
        $equipements = EquipementStudio::latest()->paginate(12);

        return view('back.chambre-studio.equipements.liste', compact('equipements'));
    }

    public function listeDisponibles()
    {
        $equipements = EquipementStudio::where('statut', 'disponible')->latest()->paginate(12);

        return view('back.chambre-studio.equipements.disponibles', compact('equipements'));
    }

    public function listeReserves()
    {
        $equipements = EquipementStudio::where('statut', 'en_utilisation')->latest()->paginate(12);

        return view('back.chambre-studio.equipements.reserves', compact('equipements'));
    }

    public function listeMaintenance()
    {
        $equipements = EquipementStudio::where('statut', 'maintenance')->latest()->paginate(12);

        return view('back.chambre-studio.equipements.maintenance', compact('equipements'));
    }

    public function formulaireCreation()
    {
        return view('back.chambre-studio.equipements.creer');
    }

    public function enregistrer(EnregistrerEquipementStudioRequest $request)
    {
        $equipementStudio = EquipementStudio::create($request->validated());

        return redirect()
            ->route('back.chambre-studio.equipements.details', $equipementStudio)
            ->with('success', 'Équipement créé avec succès.');
    }

    public function details(EquipementStudio $equipementStudio)
    {
        return view('back.chambre-studio.equipements.details', compact('equipementStudio'));
    }

    public function formulaireEdition(EquipementStudio $equipementStudio)
    {
        return view('back.chambre-studio.equipements.modifier', compact('equipementStudio'));
    }

    public function mettreAJour(ModifierEquipementStudioRequest $request, EquipementStudio $equipementStudio)
    {
        $equipementStudio->update($request->validated());

        return redirect()
            ->route('back.chambre-studio.equipements.details', $equipementStudio)
            ->with('success', 'Équipement mis à jour avec succès.');
    }

    public function marquerCommeDisponible(EquipementStudio $equipementStudio)
    {
        $equipementStudio->update(['statut' => 'disponible']);

        return back()->with('success', 'Équipement marqué comme disponible.');
    }

    public function marquerCommeReserve(EquipementStudio $equipementStudio)
    {
        $equipementStudio->update(['statut' => 'en_utilisation']);

        return back()->with('success', 'Équipement marqué comme en utilisation.');
    }

    public function marquerCommeEnMaintenance(EquipementStudio $equipementStudio)
    {
        $equipementStudio->update(['statut' => 'maintenance']);

        return back()->with('success', 'Équipement mis en maintenance.');
    }

    public function supprimer(EquipementStudio $equipementStudio)
    {
        $equipementStudio->delete();

        return redirect()
            ->route('back.chambre-studio.equipements.tous')
            ->with('success', 'Équipement supprimé avec succès.');
    }
}