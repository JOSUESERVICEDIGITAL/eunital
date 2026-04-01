<?php

namespace App\Http\Controllers\Back\ChambreGraphisme;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVisuelReseauSocialRequest;
use App\Http\Requests\UpdateVisuelReseauSocialRequest;
use App\Models\ClientStudio;
use App\Models\VisuelReseauSocial;

class VisuelReseauSocialController extends Controller
{
    public function listeToutes()
    {
        $visuels = VisuelReseauSocial::with('client')->latest()->paginate(12);
        return view('back.chambre-graphisme.visuels-reseaux-sociaux.liste', compact('visuels'));
    }

    public function listeProgrammes()
    {
        $visuels = VisuelReseauSocial::with('client')
            ->where('statut', 'programme')
            ->latest()
            ->paginate(12);

        return view('back.chambre-graphisme.visuels-reseaux-sociaux.programmes', compact('visuels'));
    }

    public function listePublies()
    {
        $visuels = VisuelReseauSocial::with('client')
            ->where('statut', 'publie')
            ->latest()
            ->paginate(12);

        return view('back.chambre-graphisme.visuels-reseaux-sociaux.publies', compact('visuels'));
    }

    public function listeInstagram()
    {
        $visuels = VisuelReseauSocial::with('client')
            ->where('plateforme', 'instagram')
            ->latest()
            ->paginate(12);

        return view('back.chambre-graphisme.visuels-reseaux-sociaux.instagram', compact('visuels'));
    }

    public function formulaireCreation()
    {
        $clients = ClientStudio::orderBy('nom')->get();
        return view('back.chambre-graphisme.visuels-reseaux-sociaux.creer', compact('clients'));
    }

    public function enregistrer(StoreVisuelReseauSocialRequest $request)
    {
        $visuel = VisuelReseauSocial::create($request->validated());

        return redirect()
            ->route('back.chambre-graphisme.social.details', $visuel)
            ->with('success', 'Visuel réseau social créé avec succès.');
    }

    public function details(VisuelReseauSocial $visuelReseauSocial)
    {
        $visuelReseauSocial->load('client');

        return view('back.chambre-graphisme.visuels-reseaux-sociaux.details', [
            'visuel' => $visuelReseauSocial
        ]);
    }

    public function formulaireEdition(VisuelReseauSocial $visuelReseauSocial)
    {
        $clients = ClientStudio::orderBy('nom')->get();

        return view('back.chambre-graphisme.visuels-reseaux-sociaux.modifier', [
            'visuel' => $visuelReseauSocial,
            'clients' => $clients,
        ]);
    }

    public function mettreAJour(UpdateVisuelReseauSocialRequest $request, VisuelReseauSocial $visuelReseauSocial)
    {
        $visuelReseauSocial->update($request->validated());

        return redirect()
            ->route('back.chambre-graphisme.social.details', $visuelReseauSocial)
            ->with('success', 'Visuel mis à jour.');
    }

    public function publier(VisuelReseauSocial $visuelReseauSocial)
    {
        $visuelReseauSocial->update(['statut' => 'publie']);

        return back()->with('success', 'Visuel marqué comme publié.');
    }

    public function supprimer(VisuelReseauSocial $visuelReseauSocial)
    {
        $visuelReseauSocial->delete();

        return redirect()
            ->route('back.chambre-graphisme.social.toutes')
            ->with('success', 'Visuel supprimé.');
    }
}
