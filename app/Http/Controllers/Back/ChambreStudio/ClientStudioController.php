<?php

namespace App\Http\Controllers\Back\ChambreStudio;

use App\Models\ClientStudio;
use App\Http\Controllers\Controller;
use App\Http\Requests\EnregistrerClientStudioRequest;
use App\Http\Requests\ModifierClientStudioRequest;

class ClientStudioController extends Controller
{
    public function listeTous()
    {
        $clients = ClientStudio::latest()->paginate(12);

        return view('back.chambre-studio.clients.liste', compact('clients'));
    }

    public function listeParticuliers()
    {
        $clients = ClientStudio::where('type', 'particulier')->latest()->paginate(12);

        return view('back.chambre-studio.clients.particuliers', compact('clients'));
    }

    public function listeEntreprises()
    {
        $clients = ClientStudio::where('type', 'entreprise')->latest()->paginate(12);

        return view('back.chambre-studio.clients.entreprises', compact('clients'));
    }

    public function listeArtistes()
    {
        $clients = ClientStudio::where('type', 'artiste')->latest()->paginate(12);

        return view('back.chambre-studio.clients.artistes', compact('clients'));
    }

    public function formulaireCreation()
    {
        return view('back.chambre-studio.clients.creer');
    }

    public function enregistrer(EnregistrerClientStudioRequest $request)
    {
        $clientStudio = ClientStudio::create($request->validated());

        return redirect()
            ->route('back.chambre-studio.clients.details', $clientStudio)
            ->with('success', 'Client créé avec succès.');
    }

    public function details(ClientStudio $clientStudio)
    {
        $clientStudio->load(['projets', 'reservations', 'productionsVideo', 'productionsAudio', 'evenements']);

        return view('back.chambre-studio.clients.details', compact('clientStudio'));
    }

    public function formulaireEdition(ClientStudio $clientStudio)
    {
        return view('back.chambre-studio.clients.modifier', compact('clientStudio'));
    }

    public function mettreAJour(ModifierClientStudioRequest $request, ClientStudio $clientStudio)
    {
        $clientStudio->update($request->validated());

        return redirect()
            ->route('back.chambre-studio.clients.details', $clientStudio)
            ->with('success', 'Client mis à jour avec succès.');
    }

    public function supprimer(ClientStudio $clientStudio)
    {
        $clientStudio->delete();

        return redirect()
            ->route('back.chambre-studio.clients.tous')
            ->with('success', 'Client supprimé avec succès.');
    }
}