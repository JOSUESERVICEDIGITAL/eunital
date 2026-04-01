<?php

namespace App\Http\Controllers\Back\ChambreStudio;

use App\Models\ClientStudio;
use App\Models\ProjetStudio;
use App\Models\ProductionAudio;
use App\Http\Controllers\Controller;
use App\Http\Requests\EnregistrerProductionAudioRequest;
use App\Http\Requests\ModifierProductionAudioRequest;

class ProductionAudioController extends Controller
{
    public function listeToutes()
    {
        $audios = ProductionAudio::with(['client', 'projet', 'auteur'])
            ->latest()
            ->paginate(12);

        return view('back.chambre-studio.productions-audio.liste', compact('audios'));
    }

    public function listeEnregistrement()
    {
        $audios = ProductionAudio::with(['client', 'projet', 'auteur'])
            ->where('statut', 'enregistrement')
            ->latest()
            ->paginate(12);

        return view('back.chambre-studio.productions-audio.liste', compact('audios'));
    }

    public function listeMixage()
    {
        $audios = ProductionAudio::with(['client', 'projet', 'auteur'])
            ->where('statut', 'mixage')
            ->latest()
            ->paginate(12);

        return view('back.chambre-studio.productions-audio.liste', compact('audios'));
    }

    public function listeMastering()
    {
        $audios = ProductionAudio::with(['client', 'projet', 'auteur'])
            ->where('statut', 'mastering')
            ->latest()
            ->paginate(12);

        return view('back.chambre-studio.productions-audio.liste', compact('audios'));
    }

    public function listeLivrees()
    {
        $audios = ProductionAudio::with(['client', 'projet', 'auteur'])
            ->where('statut', 'livre')
            ->latest()
            ->paginate(12);

        return view('back.chambre-studio.productions-audio.liste', compact('audios'));
    }

    public function formulaireCreation()
    {
        $clients = ClientStudio::orderBy('nom')->get();
        $projets = ProjetStudio::orderBy('titre')->get();

        return view('back.chambre-studio.productions-audio.creer', compact('clients', 'projets'));
    }

    public function enregistrer(EnregistrerProductionAudioRequest $request)
    {
        $data = $request->validated();
        $data['auteur_id'] = auth()->id();

        $productionAudio = ProductionAudio::create($data);

        return redirect()
            ->route('back.chambre-studio.productions-audio.details', $productionAudio)
            ->with('success', 'Production audio créée avec succès.');
    }

    public function details(ProductionAudio $productionAudio)
    {
        $productionAudio->load(['client', 'projet', 'auteur']);

        return view('back.chambre-studio.productions-audio.details', compact('productionAudio'));
    }

    public function formulaireEdition(ProductionAudio $productionAudio)
    {
        $clients = ClientStudio::orderBy('nom')->get();
        $projets = ProjetStudio::orderBy('titre')->get();

        return view('back.chambre-studio.productions-audio.modifier', compact('productionAudio', 'clients', 'projets'));
    }

    public function mettreAJour(ModifierProductionAudioRequest $request, ProductionAudio $productionAudio)
    {
        $productionAudio->update($request->validated());

        return redirect()
            ->route('back.chambre-studio.productions-audio.details', $productionAudio)
            ->with('success', 'Production audio mise à jour avec succès.');
    }

    public function envoyerEnMixage(ProductionAudio $productionAudio)
    {
        $productionAudio->update(['statut' => 'mixage']);

        return back()->with('success', 'Production audio envoyée en mixage.');
    }

    public function envoyerEnMastering(ProductionAudio $productionAudio)
    {
        $productionAudio->update(['statut' => 'mastering']);

        return back()->with('success', 'Production audio envoyée en mastering.');
    }

    public function marquerCommeLivree(ProductionAudio $productionAudio)
    {
        $productionAudio->update(['statut' => 'livre']);

        return back()->with('success', 'Production audio marquée comme livrée.');
    }

    public function archiver(ProductionAudio $productionAudio)
    {
        $productionAudio->update(['statut' => 'archive']);

        return back()->with('success', 'Production audio archivée.');
    }

    public function supprimer(ProductionAudio $productionAudio)
    {
        $productionAudio->delete();

        return redirect()
            ->route('back.chambre-studio.productions-audio.toutes')
            ->with('success', 'Production audio supprimée avec succès.');
    }
}