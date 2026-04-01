<?php

namespace App\Http\Controllers\Back\ChambreIngenieur;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\IdeeIngenieurie;
use App\Http\Controllers\Controller;
use App\Http\Requests\EnregistrerIdeeIngenieurieRequest;
use App\Http\Requests\ModifierIdeeIngenieurieRequest;

class IdeeIngenieurieController extends Controller
{
    public function listeToutes()
    {
        $idees = IdeeIngenieurie::with(['auteur', 'responsable'])
            ->latest()
            ->paginate(12);

        return view('back.chambre-ingenieur.idees.liste', compact('idees'));
    }

    public function listeNouvelles()
    {
        $idees = IdeeIngenieurie::with(['auteur', 'responsable'])
            ->where('statut', 'nouvelle')
            ->latest()
            ->paginate(12);

        return view('back.chambre-ingenieur.idees.nouvelles', compact('idees'));
    }

    public function listeEnEtude()
    {
        $idees = IdeeIngenieurie::with(['auteur', 'responsable'])
            ->where('statut', 'en_etude')
            ->latest()
            ->paginate(12);

        return view('back.chambre-ingenieur.idees.en-etude', compact('idees'));
    }

    public function listeRetenues()
    {
        $idees = IdeeIngenieurie::with(['auteur', 'responsable'])
            ->where('statut', 'retenue')
            ->latest()
            ->paginate(12);

        return view('back.chambre-ingenieur.idees.retenues', compact('idees'));
    }

    public function listeCritiques()
    {
        $idees = IdeeIngenieurie::with(['auteur', 'responsable'])
            ->where('niveau_priorite', 'critique')
            ->latest()
            ->paginate(12);

        return view('back.chambre-ingenieur.idees.critiques', compact('idees'));
    }

    public function formulaireCreation()
    {
        $utilisateurs = User::orderBy('name')->get();

        return view('back.chambre-ingenieur.idees.creer', compact('utilisateurs'));
    }

    public function enregistrer(EnregistrerIdeeIngenieurieRequest $request)
    {
        $donnees = $request->validated();

        $slugDeBase = Str::slug($donnees['titre']);
        $slugFinal = $slugDeBase;
        $compteur = 1;

        while (IdeeIngenieurie::where('slug', $slugFinal)->exists()) {
            $slugFinal = $slugDeBase . '-' . $compteur;
            $compteur++;
        }

        $idee = IdeeIngenieurie::create([
            'auteur_id' => $donnees['auteur_id'] ?? auth()->id(),
            'responsable_id' => $donnees['responsable_id'] ?? null,
            'titre' => $donnees['titre'],
            'slug' => $slugFinal,
            'description' => $donnees['description'] ?? null,
            'probleme_identifie' => $donnees['probleme_identifie'] ?? null,
            'solution_proposee' => $donnees['solution_proposee'] ?? null,
            'niveau_priorite' => $donnees['niveau_priorite'],
            'statut' => $donnees['statut'],
        ]);

        return redirect()
            ->route('back.chambre-ingenieur.idees.details', $idee)
            ->with('success', 'Idée enregistrée avec succès.');
    }

    public function details(IdeeIngenieurie $ideeIngenieurie)
    {
        $ideeIngenieurie->load(['auteur', 'responsable']);

        return view('back.chambre-ingenieur.idees.details', compact('ideeIngenieurie'));
    }

    public function formulaireEdition(IdeeIngenieurie $ideeIngenieurie)
    {
        $utilisateurs = User::orderBy('name')->get();

        return view('back.chambre-ingenieur.idees.modifier', compact('ideeIngenieurie', 'utilisateurs'));
    }

    public function mettreAJour(ModifierIdeeIngenieurieRequest $request, IdeeIngenieurie $ideeIngenieurie)
    {
        $donnees = $request->validated();

        $slugFinal = $ideeIngenieurie->slug;

        if ($ideeIngenieurie->titre !== $donnees['titre']) {
            $slugDeBase = Str::slug($donnees['titre']);
            $slugFinal = $slugDeBase;
            $compteur = 1;

            while (
                IdeeIngenieurie::where('slug', $slugFinal)
                    ->where('id', '!=', $ideeIngenieurie->id)
                    ->exists()
            ) {
                $slugFinal = $slugDeBase . '-' . $compteur;
                $compteur++;
            }
        }

        $ideeIngenieurie->update([
            'auteur_id' => $donnees['auteur_id'] ?? $ideeIngenieurie->auteur_id,
            'responsable_id' => $donnees['responsable_id'] ?? null,
            'titre' => $donnees['titre'],
            'slug' => $slugFinal,
            'description' => $donnees['description'] ?? null,
            'probleme_identifie' => $donnees['probleme_identifie'] ?? null,
            'solution_proposee' => $donnees['solution_proposee'] ?? null,
            'niveau_priorite' => $donnees['niveau_priorite'],
            'statut' => $donnees['statut'],
        ]);

        return back()->with('success', 'Idée mise à jour avec succès.');
    }

    public function mettreEnEtude(IdeeIngenieurie $ideeIngenieurie)
    {
        $ideeIngenieurie->update(['statut' => 'en_etude']);

        return back()->with('success', 'L’idée est maintenant en étude.');
    }

    public function retenir(IdeeIngenieurie $ideeIngenieurie)
    {
        $ideeIngenieurie->update(['statut' => 'retenue']);

        return back()->with('success', 'L’idée a été retenue.');
    }

    public function rejeter(IdeeIngenieurie $ideeIngenieurie)
    {
        $ideeIngenieurie->update(['statut' => 'rejetee']);

        return back()->with('success', 'L’idée a été rejetée.');
    }

    public function marquerCommeRealisee(IdeeIngenieurie $ideeIngenieurie)
    {
        $ideeIngenieurie->update(['statut' => 'realisee']);

        return back()->with('success', 'L’idée est maintenant marquée comme réalisée.');
    }

    public function definirPrioriteCritique(IdeeIngenieurie $ideeIngenieurie)
    {
        $ideeIngenieurie->update(['niveau_priorite' => 'critique']);

        return back()->with('success', 'La priorité critique a été appliquée.');
    }

    public function supprimer(IdeeIngenieurie $ideeIngenieurie)
    {
        $ideeIngenieurie->delete();

        return redirect()
            ->route('back.chambre-ingenieur.idees.toutes')
            ->with('success', 'Idée supprimée avec succès.');
    }
}