<?php

namespace App\Http\Controllers\Back\ChambreJuridique;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePieceJointeJuridiqueRequest;
use App\Models\ArchiveHub;
use App\Models\ContratJuridique;
use App\Models\DossierJuridique;
use App\Models\EngagementJuridique;
use App\Models\PieceJointeJuridique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PieceJointeJuridiqueController extends Controller
{
    public function listeToutes()
    {
        $pieces = PieceJointeJuridique::with(['contrat', 'engagement', 'dossier', 'archive', 'auteur'])
            ->latest()
            ->paginate(12);

        return view('back.chambre-juridique.pieces-jointes.liste', compact('pieces'));
    }

    public function listeContrats()
    {
        $pieces = PieceJointeJuridique::with(['contrat', 'auteur'])
            ->whereNotNull('contrat_juridique_id')
            ->latest()
            ->paginate(12);

        return view('back.chambre-juridique.pieces-jointes.contrats', compact('pieces'));
    }

    public function listeEngagements()
    {
        $pieces = PieceJointeJuridique::with(['engagement', 'auteur'])
            ->whereNotNull('engagement_juridique_id')
            ->latest()
            ->paginate(12);

        return view('back.chambre-juridique.pieces-jointes.engagements', compact('pieces'));
    }

    public function listeDossiers()
    {
        $pieces = PieceJointeJuridique::with(['dossier', 'auteur'])
            ->whereNotNull('dossier_juridique_id')
            ->latest()
            ->paginate(12);

        return view('back.chambre-juridique.pieces-jointes.dossiers', compact('pieces'));
    }

    public function formulaireCreation()
    {
        $contrats = ContratJuridique::orderBy('titre')->get();
        $engagements = EngagementJuridique::orderBy('nom_complet')->get();
        $dossiers = DossierJuridique::orderBy('titre')->get();
        $archives = ArchiveHub::orderBy('titre')->get();

        return view('back.chambre-juridique.pieces-jointes.creer', compact(
            'contrats',
            'engagements',
            'dossiers',
            'archives'
        ));
    }

    public function enregistrer(StorePieceJointeJuridiqueRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('fichier')) {
            $data['fichier'] = $request->file('fichier')->store('juridique/pieces-jointes', 'public');
        }

        $data['auteur_id'] = auth()->id();

        $piece = PieceJointeJuridique::create($data);

        return redirect()
            ->route('back.chambre-juridique.pieces-jointes.details', $piece)
            ->with('success', 'Pièce jointe créée avec succès.');
    }

    public function details(PieceJointeJuridique $pieceJointeJuridique)
    {
        $pieceJointeJuridique->load(['contrat', 'engagement', 'dossier', 'archive', 'auteur']);

        return view('back.chambre-juridique.pieces-jointes.details', [
            'piece' => $pieceJointeJuridique
        ]);
    }

    public function formulaireEdition(PieceJointeJuridique $pieceJointeJuridique)
    {
        $contrats = ContratJuridique::orderBy('titre')->get();
        $engagements = EngagementJuridique::orderBy('nom_complet')->get();
        $dossiers = DossierJuridique::orderBy('titre')->get();
        $archives = ArchiveHub::orderBy('titre')->get();

        return view('back.chambre-juridique.pieces-jointes.modifier', [
            'piece' => $pieceJointeJuridique,
            'contrats' => $contrats,
            'engagements' => $engagements,
            'dossiers' => $dossiers,
            'archives' => $archives,
        ]);
    }

    public function mettreAJour(Request $request, PieceJointeJuridique $pieceJointeJuridique)
    {
        $data = $request->validate([
            'titre' => ['required', 'string', 'max:255'],
            'type_piece' => ['required', 'string', 'max:255'],
            'fichier' => ['nullable', 'file', 'max:5120'],
            'contrat_juridique_id' => ['nullable', 'exists:contrats_juridiques,id'],
            'engagement_juridique_id' => ['nullable', 'exists:engagements_juridiques,id'],
            'dossier_juridique_id' => ['nullable', 'exists:dossiers_juridiques,id'],
            'archive_hub_id' => ['nullable', 'exists:archives_hub,id'],
        ]);

        if ($request->hasFile('fichier')) {
            if ($pieceJointeJuridique->fichier && Storage::disk('public')->exists($pieceJointeJuridique->fichier)) {
                Storage::disk('public')->delete($pieceJointeJuridique->fichier);
            }

            $data['fichier'] = $request->file('fichier')->store('juridique/pieces-jointes', 'public');
        }

        $pieceJointeJuridique->update($data);

        return redirect()
            ->route('back.chambre-juridique.pieces-jointes.details', $pieceJointeJuridique)
            ->with('success', 'Pièce jointe mise à jour avec succès.');
    }

    public function supprimer(PieceJointeJuridique $pieceJointeJuridique)
    {
        if ($pieceJointeJuridique->fichier && Storage::disk('public')->exists($pieceJointeJuridique->fichier)) {
            Storage::disk('public')->delete($pieceJointeJuridique->fichier);
        }

        $pieceJointeJuridique->delete();

        return redirect()
            ->route('back.chambre-juridique.pieces-jointes.toutes')
            ->with('success', 'Pièce jointe supprimée avec succès.');
    }
}
