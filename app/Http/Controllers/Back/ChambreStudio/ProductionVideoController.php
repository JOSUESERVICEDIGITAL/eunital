<?php

namespace App\Http\Controllers\Back\ChambreStudio;

use App\Models\ClientStudio;
use App\Models\ProjetStudio;
use App\Models\ProductionVideo;
use App\Http\Controllers\Controller;
use App\Http\Requests\EnregistrerProductionVideoRequest;
use App\Http\Requests\ModifierProductionVideoRequest;

class ProductionVideoController extends Controller
{
    public function listeToutes()
    {
        $videos = ProductionVideo::with(['client', 'projet', 'auteur', 'montages'])
            ->latest()
            ->paginate(12);

        return view('back.chambre-studio.productions-video.liste', compact('videos'));
    }

    public function listeTournage()
    {
        $videos = ProductionVideo::with(['client', 'projet', 'auteur', 'montages'])
            ->where('statut', 'tournage')
            ->latest()
            ->paginate(12);

        return view('back.chambre-studio.productions-video.liste', compact('videos'));
    }

    public function listeMontage()
    {
        $videos = ProductionVideo::with(['client', 'projet', 'auteur', 'montages'])
            ->where('statut', 'montage')
            ->latest()
            ->paginate(12);

        return view('back.chambre-studio.productions-video.liste', compact('videos'));
    }

    public function listeValidation()
    {
        $videos = ProductionVideo::with(['client', 'projet', 'auteur', 'montages'])
            ->where('statut', 'validation')
            ->latest()
            ->paginate(12);

        return view('back.chambre-studio.productions-video.liste', compact('videos'));
    }

    public function listeLivrees()
    {
        $videos = ProductionVideo::with(['client', 'projet', 'auteur', 'montages'])
            ->where('statut', 'livre')
            ->latest()
            ->paginate(12);

        return view('back.chambre-studio.productions-video.liste', compact('videos'));
    }

    public function formulaireCreation()
    {
        $clients = ClientStudio::pluck('nom', 'id');
        $projets = ProjetStudio::pluck('titre', 'id');

        return view('back.chambre-studio.productions-video.creer', compact('clients', 'projets'));
    }

    public function enregistrer(EnregistrerProductionVideoRequest $request)
    {
        $data = $request->validated();
        $data['auteur_id'] = auth()->id();

        $productionVideo = ProductionVideo::create($data);

        return redirect()
            ->route('back.chambre-studio.productions-video.details', $productionVideo)
            ->with('success', 'Production vidéo créée avec succès.');
    }

    public function details(ProductionVideo $productionVideo)
    {
        $productionVideo->load(['client', 'projet', 'auteur', 'montages']);

        return view('back.chambre-studio.productions-video.details', compact('productionVideo'));
    }

    public function formulaireEdition(ProductionVideo $productionVideo)
    {
        $clients = ClientStudio::pluck('nom', 'id');
        $projets = ProjetStudio::pluck('titre', 'id');

        return view('back.chambre-studio.productions-video.modifier', compact('productionVideo', 'clients', 'projets'));
    }

    public function mettreAJour(ModifierProductionVideoRequest $request, ProductionVideo $productionVideo)
    {
        $productionVideo->update($request->validated());

        return redirect()
            ->route('back.chambre-studio.productions-video.details', $productionVideo)
            ->with('success', 'Production vidéo mise à jour.');
    }

    public function envoyerEnMontage(ProductionVideo $productionVideo)
    {
        $productionVideo->update(['statut' => 'montage']);

        return back()->with('success', 'Vidéo envoyée en montage.');
    }

    public function envoyerEnValidation(ProductionVideo $productionVideo)
    {
        $productionVideo->update(['statut' => 'validation']);

        return back()->with('success', 'Vidéo envoyée en validation.');
    }

    public function marquerCommeLivree(ProductionVideo $productionVideo)
    {
        $productionVideo->update(['statut' => 'livre']);

        return back()->with('success', 'Vidéo marquée comme livrée.');
    }

    public function archiver(ProductionVideo $productionVideo)
    {
        $productionVideo->update(['statut' => 'archive']);

        return back()->with('success', 'Vidéo archivée.');
    }

    public function supprimer(ProductionVideo $productionVideo)
    {
        $productionVideo->delete();

        return redirect()
            ->route('back.chambre-studio.productions-video.toutes')
            ->with('success', 'Production vidéo supprimée.');
    }
}