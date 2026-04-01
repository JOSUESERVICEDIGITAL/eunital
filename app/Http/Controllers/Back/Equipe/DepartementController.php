<?php

namespace App\Http\Controllers\Back\Equipe;

use App\Models\Departement;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\EnregistrerDepartementRequest;
use App\Http\Requests\ModifierDepartementRequest;

class DepartementController extends Controller
{
    public function listeTous()
    {
        $departements = Departement::withCount(['membres', 'postes', 'messagesInternes'])
            ->latest()
            ->paginate(12);

        return view('back.equipe.departements.liste', compact('departements'));
    }

    public function listeActifs()
    {
        $departements = Departement::withCount(['membres', 'postes', 'messagesInternes'])
            ->where('est_actif', true)
            ->latest()
            ->paginate(12);

        return view('back.equipe.departements.actifs', compact('departements'));
    }

    public function listeInactifs()
    {
        $departements = Departement::withCount(['membres', 'postes', 'messagesInternes'])
            ->where('est_actif', false)
            ->latest()
            ->paginate(12);

        return view('back.equipe.departements.inactifs', compact('departements'));
    }

    public function formulaireCreation()
    {
        return view('back.equipe.departements.creer');
    }

    public function enregistrer(EnregistrerDepartementRequest $request)
    {
        $donnees = $request->validated();

        $slugDeBase = Str::slug($donnees['nom']);
        $slugFinal = $slugDeBase;
        $compteur = 1;

        while (Departement::where('slug', $slugFinal)->exists()) {
            $slugFinal = $slugDeBase . '-' . $compteur;
            $compteur++;
        }

        $departement = Departement::create([
            'nom' => $donnees['nom'],
            'slug' => $slugFinal,
            'description' => $donnees['description'] ?? null,
            'est_actif' => $request->boolean('est_actif', true),
        ]);

        return redirect()
            ->route('back.equipe.departements.details', $departement)
            ->with('success', 'Département créé avec succès.');
    }

    public function details(Departement $departement)
    {
        $departement->load(['postes', 'membres', 'messagesInternes']);

        return view('back.equipe.departements.details', compact('departement'));
    }

    public function formulaireEdition(Departement $departement)
    {
        return view('back.equipe.departements.modifier', compact('departement'));
    }

    public function mettreAJour(ModifierDepartementRequest $request, Departement $departement)
    {
        $donnees = $request->validated();

        $slugFinal = $departement->slug;

        if ($departement->nom !== $donnees['nom']) {
            $slugDeBase = Str::slug($donnees['nom']);
            $slugFinal = $slugDeBase;
            $compteur = 1;

            while (
                Departement::where('slug', $slugFinal)
                    ->where('id', '!=', $departement->id)
                    ->exists()
            ) {
                $slugFinal = $slugDeBase . '-' . $compteur;
                $compteur++;
            }
        }

        $departement->update([
            'nom' => $donnees['nom'],
            'slug' => $slugFinal,
            'description' => $donnees['description'] ?? null,
            'est_actif' => $request->boolean('est_actif', false),
        ]);

        return back()->with('success', 'Département mis à jour avec succès.');
    }

    public function activer(Departement $departement)
    {
        $departement->update([
            'est_actif' => true,
        ]);

        return back()->with('success', 'Département activé.');
    }

    public function desactiver(Departement $departement)
    {
        $departement->update([
            'est_actif' => false,
        ]);

        return back()->with('success', 'Département désactivé.');
    }

    public function supprimer(Departement $departement)
    {
        if ($departement->membres()->count() > 0 || $departement->postes()->count() > 0) {
            return back()->with('error', 'Impossible de supprimer ce département car il contient encore des postes ou des membres.');
        }

        $departement->delete();

        return redirect()
            ->route('back.equipe.departements.tous')
            ->with('success', 'Département supprimé avec succès.');
    }
}
