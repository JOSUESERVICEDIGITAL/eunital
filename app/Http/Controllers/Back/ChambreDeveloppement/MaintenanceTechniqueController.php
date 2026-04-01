<?php

namespace App\Http\Controllers\Back\ChambreDeveloppement;

use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\MaintenanceTechnique;
use App\Http\Requests\EnregistrerMaintenanceTechniqueRequest;
use App\Http\Requests\ModifierMaintenanceTechniqueRequest;

class MaintenanceTechniqueController extends Controller
{
    public function listeToutes()
    {
        $maintenances = MaintenanceTechnique::with(['auteur', 'responsable'])
            ->latest()
            ->paginate(12);

        return view('back.chambre-developpement.maintenances.liste', compact('maintenances'));
    }

    public function listeOuvertes()
    {
        $maintenances = MaintenanceTechnique::with(['auteur', 'responsable'])
            ->where('statut', 'ouverte')
            ->latest()
            ->paginate(12);

        return view('back.chambre-developpement.maintenances.ouvertes', compact('maintenances'));
    }

    public function listeEnCours()
    {
        $maintenances = MaintenanceTechnique::with(['auteur', 'responsable'])
            ->where('statut', 'en_cours')
            ->latest()
            ->paginate(12);

        return view('back.chambre-developpement.maintenances.en-cours', compact('maintenances'));
    }

    public function listeCritiques()
    {
        $maintenances = MaintenanceTechnique::with(['auteur', 'responsable'])
            ->where('niveau_urgence', 'critique')
            ->latest()
            ->paginate(12);

        return view('back.chambre-developpement.maintenances.critiques', compact('maintenances'));
    }

    public function listeResolues()
    {
        $maintenances = MaintenanceTechnique::with(['auteur', 'responsable'])
            ->where('statut', 'resolue')
            ->latest()
            ->paginate(12);

        return view('back.chambre-developpement.maintenances.resolues', compact('maintenances'));
    }

    public function formulaireCreation()
    {
        $utilisateurs = User::orderBy('name')->get();

        return view('back.chambre-developpement.maintenances.creer', compact('utilisateurs'));
    }

    public function enregistrer(EnregistrerMaintenanceTechniqueRequest $request)
    {
        $donnees = $request->validated();

        $slugBase = Str::slug($donnees['titre']);
        $slug = $slugBase;
        $compteur = 1;

        while (MaintenanceTechnique::where('slug', $slug)->exists()) {
            $slug = $slugBase . '-' . $compteur++;
        }

        $maintenance = MaintenanceTechnique::create([
            'auteur_id' => $donnees['auteur_id'] ?? auth()->id(),
            'responsable_id' => $donnees['responsable_id'] ?? null,
            'titre' => $donnees['titre'],
            'slug' => $slug,
            'description' => $donnees['description'] ?? null,
            'type_maintenance' => $donnees['type_maintenance'],
            'niveau_urgence' => $donnees['niveau_urgence'],
            'statut' => $donnees['statut'],
            'date_signalement' => $donnees['date_signalement'] ?? now(),
            'date_resolution' => $donnees['date_resolution'] ?? null,
        ]);

        return redirect()
            ->route('back.chambre-developpement.maintenances.details', $maintenance)
            ->with('success', 'Maintenance enregistrée avec succès.');
    }

    public function details(MaintenanceTechnique $maintenanceTechnique)
    {
        $maintenanceTechnique->load(['auteur', 'responsable']);

        return view('back.chambre-developpement.maintenances.details', compact('maintenanceTechnique'));
    }

    public function formulaireEdition(MaintenanceTechnique $maintenanceTechnique)
    {
        $utilisateurs = User::orderBy('name')->get();

        return view('back.chambre-developpement.maintenances.modifier', compact('maintenanceTechnique', 'utilisateurs'));
    }

    public function mettreAJour(ModifierMaintenanceTechniqueRequest $request, MaintenanceTechnique $maintenanceTechnique)
    {
        $donnees = $request->validated();

        $slug = $maintenanceTechnique->slug;
        if ($maintenanceTechnique->titre !== $donnees['titre']) {
            $slugBase = Str::slug($donnees['titre']);
            $slug = $slugBase;
            $compteur = 1;

            while (
                MaintenanceTechnique::where('slug', $slug)
                    ->where('id', '!=', $maintenanceTechnique->id)
                    ->exists()
            ) {
                $slug = $slugBase . '-' . $compteur++;
            }
        }

        $maintenanceTechnique->update([
            'auteur_id' => $donnees['auteur_id'] ?? $maintenanceTechnique->auteur_id,
            'responsable_id' => $donnees['responsable_id'] ?? null,
            'titre' => $donnees['titre'],
            'slug' => $slug,
            'description' => $donnees['description'] ?? null,
            'type_maintenance' => $donnees['type_maintenance'],
            'niveau_urgence' => $donnees['niveau_urgence'],
            'statut' => $donnees['statut'],
            'date_signalement' => $donnees['date_signalement'] ?? $maintenanceTechnique->date_signalement,
            'date_resolution' => $donnees['date_resolution'] ?? $maintenanceTechnique->date_resolution,
        ]);

        return back()->with('success', 'Maintenance mise à jour avec succès.');
    }

    public function prendreEnCharge(MaintenanceTechnique $maintenanceTechnique)
    {
        $maintenanceTechnique->update(['statut' => 'en_cours']);

        return back()->with('success', 'Maintenance prise en charge.');
    }

    public function marquerCommeResolue(MaintenanceTechnique $maintenanceTechnique)
    {
        $maintenanceTechnique->update([
            'statut' => 'resolue',
            'date_resolution' => now(),
        ]);

        return back()->with('success', 'Maintenance marquée comme résolue.');
    }

    public function fermer(MaintenanceTechnique $maintenanceTechnique)
    {
        $maintenanceTechnique->update(['statut' => 'fermee']);

        return back()->with('success', 'Maintenance fermée.');
    }

    public function reporter(MaintenanceTechnique $maintenanceTechnique)
    {
        $maintenanceTechnique->update(['statut' => 'reportee']);

        return back()->with('success', 'Maintenance reportée.');
    }

    public function definirUrgenceCritique(MaintenanceTechnique $maintenanceTechnique)
    {
        $maintenanceTechnique->update(['niveau_urgence' => 'critique']);

        return back()->with('success', 'Urgence critique appliquée.');
    }

    public function supprimer(MaintenanceTechnique $maintenanceTechnique)
    {
        $maintenanceTechnique->delete();

        return redirect()
            ->route('back.chambre-developpement.maintenances.toutes')
            ->with('success', 'Maintenance supprimée avec succès.');
    }
}
