<?php

namespace App\Http\Controllers\Back\ChambreJuridique;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArchiveHubRequest;
use App\Http\Requests\UpdateArchiveHubRequest;
use App\Models\ArchiveHub;
use Illuminate\Support\Facades\Storage;

class ArchiveHubController extends Controller
{
    public function listeToutes()
    {
        $archives = ArchiveHub::with('auteur')
            ->latest()
            ->paginate(12);

        return view('back.chambre-juridique.archives-hub.liste', compact('archives'));
    }

    public function listeFondations()
    {
        $archives = ArchiveHub::with('auteur')
            ->where('categorie', 'fondation')
            ->latest()
            ->paginate(12);

        return view('back.chambre-juridique.archives-hub.fondations', compact('archives'));
    }

    public function listeInaugurations()
    {
        $archives = ArchiveHub::with('auteur')
            ->where('categorie', 'inauguration')
            ->latest()
            ->paginate(12);

        return view('back.chambre-juridique.archives-hub.inaugurations', compact('archives'));
    }

    public function listeMedias()
    {
        $archives = ArchiveHub::with('auteur')
            ->whereIn('type_fichier', ['image', 'video', 'audio'])
            ->latest()
            ->paginate(12);

        return view('back.chambre-juridique.archives-hub.medias', compact('archives'));
    }

    public function formulaireCreation()
    {
        return view('back.chambre-juridique.archives-hub.creer');
    }

    public function enregistrer(StoreArchiveHubRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('fichier')) {
            $data['fichier'] = $request->file('fichier')->store('juridique/archives-hub', 'public');
        }

        $data['auteur_id'] = auth()->id();

        $archive = ArchiveHub::create($data);

        return redirect()
            ->route('back.chambre-juridique.archives-hub.details', $archive)
            ->with('success', 'Archive créée avec succès.');
    }

    public function details(ArchiveHub $archiveHub)
    {
        $archiveHub->load(['auteur', 'piecesJointes']);

        return view('back.chambre-juridique.archives-hub.details', [
            'archive' => $archiveHub
        ]);
    }

    public function formulaireEdition(ArchiveHub $archiveHub)
    {
        return view('back.chambre-juridique.archives-hub.modifier', [
            'archive' => $archiveHub
        ]);
    }

    public function mettreAJour(UpdateArchiveHubRequest $request, ArchiveHub $archiveHub)
    {
        $data = $request->validated();

        if ($request->hasFile('fichier')) {
            if ($archiveHub->fichier && Storage::disk('public')->exists($archiveHub->fichier)) {
                Storage::disk('public')->delete($archiveHub->fichier);
            }

            $data['fichier'] = $request->file('fichier')->store('juridique/archives-hub', 'public');
        }

        $archiveHub->update($data);

        return redirect()
            ->route('back.chambre-juridique.archives-hub.details', $archiveHub)
            ->with('success', 'Archive mise à jour avec succès.');
    }

    public function rendreVisible(ArchiveHub $archiveHub)
    {
        $archiveHub->update(['visible' => true]);

        return back()->with('success', 'Archive rendue visible.');
    }

    public function masquer(ArchiveHub $archiveHub)
    {
        $archiveHub->update(['visible' => false]);

        return back()->with('success', 'Archive masquée.');
    }

    public function supprimer(ArchiveHub $archiveHub)
    {
        if ($archiveHub->fichier && Storage::disk('public')->exists($archiveHub->fichier)) {
            Storage::disk('public')->delete($archiveHub->fichier);
        }

        $archiveHub->delete();

        return redirect()
            ->route('back.chambre-juridique.archives-hub.toutes')
            ->with('success', 'Archive supprimée avec succès.');
    }
}
