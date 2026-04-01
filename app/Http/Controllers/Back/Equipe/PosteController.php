<?php

namespace App\Http\Controllers\Back\Equipe;

use App\Models\Poste;
use App\Models\Departement;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\EnregistrerPosteRequest;
use App\Http\Requests\ModifierPosteRequest;

class PosteController extends Controller
{
    public function listeTous()
    {
        $postes = Poste::with(['departement'])
            ->withCount('membres')
            ->latest()
            ->paginate(12);

        return view('back.equipe.postes.liste', compact('postes'));
    }

    public function listeActifs()
    {
        $postes = Poste::with(['departement'])
            ->withCount('membres')
            ->where('est_actif', true)
            ->latest()
            ->paginate(12);

        return view('back.equipe.postes.actifs', compact('postes'));
    }

    public function listeInactifs()
    {
        $postes = Poste::with(['departement'])
            ->withCount('membres')
            ->where('est_actif', false)
            ->latest()
            ->paginate(12);

        return view('back.equipe.postes.inactifs', compact('postes'));
    }

    public function formulaireCreation()
    {
        $departements = Departement::where('est_actif', true)->orderBy('nom')->get();

        return view('back.equipe.postes.creer', compact('departements'));
    }

    public function enregistrer(EnregistrerPosteRequest $request)
    {
        $donnees = $request->validated();

        $slugDeBase = Str::slug($donnees['nom']);
        $slugFinal = $slugDeBase;
        $compteur = 1;

        while (Poste::where('slug', $slugFinal)->exists()) {
            $slugFinal = $slugDeBase . '-' . $compteur;
            $compteur++;
        }

        $poste = Poste::create([
            'departement_id' => $donnees['departement_id'] ?? null,
            'nom' => $donnees['nom'],
            'slug' => $slugFinal,
            'description' => $donnees['description'] ?? null,
            'est_actif' => $request->boolean('est_actif', true),
        ]);

        return redirect()
            ->route('back.equipe.postes.details', $poste)
            ->with('success', 'Poste créé avec succès.');
    }

    public function details(Poste $poste)
    {
        $poste->load(['departement', 'membres']);

        return view('back.equipe.postes.details', compact('poste'));
    }

    public function formulaireEdition(Poste $poste)
    {
        $departements = Departement::orderBy('nom')->get();

        return view('back.equipe.postes.modifier', compact('poste', 'departements'));
    }

    public function mettreAJour(ModifierPosteRequest $request, Poste $poste)
    {
        $donnees = $request->validated();

        $slugFinal = $poste->slug;

        if ($poste->nom !== $donnees['nom']) {
            $slugDeBase = Str::slug($donnees['nom']);
            $slugFinal = $slugDeBase;
            $compteur = 1;

            while (
                Poste::where('slug', $slugFinal)
                    ->where('id', '!=', $poste->id)
                    ->exists()
            ) {
                $slugFinal = $slugDeBase . '-' . $compteur;
                $compteur++;
            }
        }

        $poste->update([
            'departement_id' => $donnees['departement_id'] ?? null,
            'nom' => $donnees['nom'],
            'slug' => $slugFinal,
            'description' => $donnees['description'] ?? null,
            'est_actif' => $request->boolean('est_actif', false),
        ]);

        return back()->with('success', 'Poste mis à jour avec succès.');
    }

    public function activer(Poste $poste)
    {
        $poste->update([
            'est_actif' => true,
        ]);

        return back()->with('success', 'Poste activé.');
    }

    public function desactiver(Poste $poste)
    {
        $poste->update([
            'est_actif' => false,
        ]);

        return back()->with('success', 'Poste désactivé.');
    }

    public function supprimer(Poste $poste)
    {
        if ($poste->membres()->count() > 0) {
            return back()->with('error', 'Impossible de supprimer ce poste car il est encore attribué à des membres.');
        }

        $poste->delete();

        return redirect()
            ->route('back.equipe.postes.tous')
            ->with('success', 'Poste supprimé avec succès.');
    }
}