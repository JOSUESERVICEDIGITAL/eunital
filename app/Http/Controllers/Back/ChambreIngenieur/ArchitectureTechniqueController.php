<?php

namespace App\Http\Controllers\Back\ChambreIngenieur;

use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\ArchitectureTechnique;
use App\Http\Requests\EnregistrerArchitectureTechniqueRequest;
use App\Http\Requests\ModifierArchitectureTechniqueRequest;

class ArchitectureTechniqueController extends Controller
{
    public function listeToutes()
    {
        $architectures = ArchitectureTechnique::with('auteur')
            ->latest()
            ->paginate(12);

        return view('back.chambre-ingenieur.architectures.liste', compact('architectures'));
    }

    public function listeBrouillons()
    {
        $architectures = ArchitectureTechnique::with('auteur')
            ->where('statut', 'brouillon')
            ->latest()
            ->paginate(12);

        return view('back.chambre-ingenieur.architectures.brouillons', compact('architectures'));
    }

    public function listeValidees()
    {
        $architectures = ArchitectureTechnique::with('auteur')
            ->where('statut', 'validee')
            ->latest()
            ->paginate(12);

        return view('back.chambre-ingenieur.architectures.validees', compact('architectures'));
    }

    public function listeObsoletes()
    {
        $architectures = ArchitectureTechnique::with('auteur')
            ->where('statut', 'obsolete')
            ->latest()
            ->paginate(12);

        return view('back.chambre-ingenieur.architectures.obsoletes', compact('architectures'));
    }

    public function formulaireCreation()
    {
        $utilisateurs = User::orderBy('name')->get();

        return view('back.chambre-ingenieur.architectures.creer', compact('utilisateurs'));
    }

    public function enregistrer(EnregistrerArchitectureTechniqueRequest $request)
    {
        $donnees = $request->validated();

        $slugDeBase = Str::slug($donnees['titre']);
        $slugFinal = $slugDeBase;
        $compteur = 1;

        while (ArchitectureTechnique::where('slug', $slugFinal)->exists()) {
            $slugFinal = $slugDeBase . '-' . $compteur;
            $compteur++;
        }

        $diagramme = null;

        if ($request->hasFile('diagramme')) {
            $diagramme = $request->file('diagramme')->store('chambre-ingenieur/architectures', 'public');
        }

        $architecture = ArchitectureTechnique::create([
            'auteur_id' => $donnees['auteur_id'] ?? auth()->id(),
            'titre' => $donnees['titre'],
            'slug' => $slugFinal,
            'description' => $donnees['description'] ?? null,
            'composants' => $donnees['composants'] ?? null,
            'technologies_recommandees' => $donnees['technologies_recommandees'] ?? null,
            'contraintes_techniques' => $donnees['contraintes_techniques'] ?? null,
            'diagramme' => $diagramme,
            'version' => $donnees['version'] ?? '1.0',
            'statut' => $donnees['statut'],
        ]);

        return redirect()
            ->route('back.chambre-ingenieur.architectures.details', $architecture)
            ->with('success', 'Architecture technique enregistrée avec succès.');
    }

    public function details(ArchitectureTechnique $architectureTechnique)
    {
        $architectureTechnique->load('auteur');

        return view('back.chambre-ingenieur.architectures.details', compact('architectureTechnique'));
    }

    public function formulaireEdition(ArchitectureTechnique $architectureTechnique)
    {
        $utilisateurs = User::orderBy('name')->get();

        return view('back.chambre-ingenieur.architectures.modifier', compact('architectureTechnique', 'utilisateurs'));
    }

    public function mettreAJour(ModifierArchitectureTechniqueRequest $request, ArchitectureTechnique $architectureTechnique)
    {
        $donnees = $request->validated();

        $slugFinal = $architectureTechnique->slug;

        if ($architectureTechnique->titre !== $donnees['titre']) {
            $slugDeBase = Str::slug($donnees['titre']);
            $slugFinal = $slugDeBase;
            $compteur = 1;

            while (
                ArchitectureTechnique::where('slug', $slugFinal)
                    ->where('id', '!=', $architectureTechnique->id)
                    ->exists()
            ) {
                $slugFinal = $slugDeBase . '-' . $compteur;
                $compteur++;
            }
        }

        $diagramme = $architectureTechnique->diagramme;

        if ($request->hasFile('diagramme')) {
            if ($architectureTechnique->diagramme) {
                Storage::disk('public')->delete($architectureTechnique->diagramme);
            }

            $diagramme = $request->file('diagramme')->store('chambre-ingenieur/architectures', 'public');
        }

        $architectureTechnique->update([
            'auteur_id' => $donnees['auteur_id'] ?? $architectureTechnique->auteur_id,
            'titre' => $donnees['titre'],
            'slug' => $slugFinal,
            'description' => $donnees['description'] ?? null,
            'composants' => $donnees['composants'] ?? null,
            'technologies_recommandees' => $donnees['technologies_recommandees'] ?? null,
            'contraintes_techniques' => $donnees['contraintes_techniques'] ?? null,
            'diagramme' => $diagramme,
            'version' => $donnees['version'] ?? '1.0',
            'statut' => $donnees['statut'],
        ]);

        return back()->with('success', 'Architecture technique mise à jour avec succès.');
    }

    public function valider(ArchitectureTechnique $architectureTechnique)
    {
        $architectureTechnique->update(['statut' => 'validee']);

        return back()->with('success', 'Architecture validée.');
    }

    public function rendreObsolete(ArchitectureTechnique $architectureTechnique)
    {
        $architectureTechnique->update(['statut' => 'obsolete']);

        return back()->with('success', 'Architecture marquée comme obsolète.');
    }

    public function remettreEnBrouillon(ArchitectureTechnique $architectureTechnique)
    {
        $architectureTechnique->update(['statut' => 'brouillon']);

        return back()->with('success', 'Architecture remise en brouillon.');
    }

    public function supprimerDiagramme(ArchitectureTechnique $architectureTechnique)
    {
        if ($architectureTechnique->diagramme) {
            Storage::disk('public')->delete($architectureTechnique->diagramme);

            $architectureTechnique->update([
                'diagramme' => null,
            ]);
        }

        return back()->with('success', 'Diagramme supprimé avec succès.');
    }

    public function supprimer(ArchitectureTechnique $architectureTechnique)
    {
        if ($architectureTechnique->diagramme) {
            Storage::disk('public')->delete($architectureTechnique->diagramme);
        }

        $architectureTechnique->delete();

        return redirect()
            ->route('back.chambre-ingenieur.architectures.toutes')
            ->with('success', 'Architecture technique supprimée avec succès.');
    }
}