<?php

namespace App\Http\Controllers\Back\ChambreIngenieur;

use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\PrototypeIngenieurie;
use App\Http\Requests\EnregistrerPrototypeIngenieurieRequest;
use App\Http\Requests\ModifierPrototypeIngenieurieRequest;

class PrototypeIngenieurieController extends Controller
{
    public function listeTous()
    {
        $prototypes = PrototypeIngenieurie::with('auteur')
            ->latest()
            ->paginate(12);

        return view('back.chambre-ingenieur.prototypes.liste', compact('prototypes'));
    }

    public function listeEnCours()
    {
        $prototypes = PrototypeIngenieurie::with('auteur')
            ->where('statut', 'en_cours')
            ->latest()
            ->paginate(12);

        return view('back.chambre-ingenieur.prototypes.en-cours', compact('prototypes'));
    }

    public function listeTermines()
    {
        $prototypes = PrototypeIngenieurie::with('auteur')
            ->where('statut', 'termine')
            ->latest()
            ->paginate(12);

        return view('back.chambre-ingenieur.prototypes.termines', compact('prototypes'));
    }

    public function listeAbandonnes()
    {
        $prototypes = PrototypeIngenieurie::with('auteur')
            ->where('statut', 'abandonne')
            ->latest()
            ->paginate(12);

        return view('back.chambre-ingenieur.prototypes.abandonnes', compact('prototypes'));
    }

    public function formulaireCreation()
    {
        $utilisateurs = User::orderBy('name')->get();

        return view('back.chambre-ingenieur.prototypes.creer', compact('utilisateurs'));
    }

    public function enregistrer(EnregistrerPrototypeIngenieurieRequest $request)
    {
        $donnees = $request->validated();

        $slugDeBase = Str::slug($donnees['titre']);
        $slugFinal = $slugDeBase;
        $compteur = 1;

        while (PrototypeIngenieurie::where('slug', $slugFinal)->exists()) {
            $slugFinal = $slugDeBase . '-' . $compteur;
            $compteur++;
        }

        $captures = null;

        if ($request->hasFile('captures')) {
            $captures = $request->file('captures')->store('chambre-ingenieur/prototypes', 'public');
        }

        $prototype = PrototypeIngenieurie::create([
            'auteur_id' => $donnees['auteur_id'] ?? auth()->id(),
            'titre' => $donnees['titre'],
            'slug' => $slugFinal,
            'description' => $donnees['description'] ?? null,
            'objectif' => $donnees['objectif'] ?? null,
            'lien_demo' => $donnees['lien_demo'] ?? null,
            'depot_source' => $donnees['depot_source'] ?? null,
            'captures' => $captures,
            'statut' => $donnees['statut'],
        ]);

        return redirect()
            ->route('back.chambre-ingenieur.prototypes.details', $prototype)
            ->with('success', 'Prototype enregistré avec succès.');
    }

    public function details(PrototypeIngenieurie $prototypeIngenieurie)
    {
        $prototypeIngenieurie->load('auteur');

        return view('back.chambre-ingenieur.prototypes.details', compact('prototypeIngenieurie'));
    }

    public function formulaireEdition(PrototypeIngenieurie $prototypeIngenieurie)
    {
        $utilisateurs = User::orderBy('name')->get();

        return view('back.chambre-ingenieur.prototypes.modifier', compact('prototypeIngenieurie', 'utilisateurs'));
    }

    public function mettreAJour(ModifierPrototypeIngenieurieRequest $request, PrototypeIngenieurie $prototypeIngenieurie)
    {
        $donnees = $request->validated();

        $slugFinal = $prototypeIngenieurie->slug;

        if ($prototypeIngenieurie->titre !== $donnees['titre']) {
            $slugDeBase = Str::slug($donnees['titre']);
            $slugFinal = $slugDeBase;
            $compteur = 1;

            while (
                PrototypeIngenieurie::where('slug', $slugFinal)
                    ->where('id', '!=', $prototypeIngenieurie->id)
                    ->exists()
            ) {
                $slugFinal = $slugDeBase . '-' . $compteur;
                $compteur++;
            }
        }

        $captures = $prototypeIngenieurie->captures;

        if ($request->hasFile('captures')) {
            if ($prototypeIngenieurie->captures) {
                Storage::disk('public')->delete($prototypeIngenieurie->captures);
            }

            $captures = $request->file('captures')->store('chambre-ingenieur/prototypes', 'public');
        }

        $prototypeIngenieurie->update([
            'auteur_id' => $donnees['auteur_id'] ?? $prototypeIngenieurie->auteur_id,
            'titre' => $donnees['titre'],
            'slug' => $slugFinal,
            'description' => $donnees['description'] ?? null,
            'objectif' => $donnees['objectif'] ?? null,
            'lien_demo' => $donnees['lien_demo'] ?? null,
            'depot_source' => $donnees['depot_source'] ?? null,
            'captures' => $captures,
            'statut' => $donnees['statut'],
        ]);

        return back()->with('success', 'Prototype mis à jour avec succès.');
    }

    public function terminer(PrototypeIngenieurie $prototypeIngenieurie)
    {
        $prototypeIngenieurie->update(['statut' => 'termine']);

        return back()->with('success', 'Prototype marqué comme terminé.');
    }

    public function abandonner(PrototypeIngenieurie $prototypeIngenieurie)
    {
        $prototypeIngenieurie->update(['statut' => 'abandonne']);

        return back()->with('success', 'Prototype marqué comme abandonné.');
    }

    public function relancer(PrototypeIngenieurie $prototypeIngenieurie)
    {
        $prototypeIngenieurie->update(['statut' => 'en_cours']);

        return back()->with('success', 'Prototype relancé.');
    }

    public function supprimerCapture(PrototypeIngenieurie $prototypeIngenieurie)
    {
        if ($prototypeIngenieurie->captures) {
            Storage::disk('public')->delete($prototypeIngenieurie->captures);

            $prototypeIngenieurie->update([
                'captures' => null,
            ]);
        }

        return back()->with('success', 'Capture supprimée avec succès.');
    }

    public function supprimer(PrototypeIngenieurie $prototypeIngenieurie)
    {
        if ($prototypeIngenieurie->captures) {
            Storage::disk('public')->delete($prototypeIngenieurie->captures);
        }

        $prototypeIngenieurie->delete();

        return redirect()
            ->route('back.chambre-ingenieur.prototypes.tous')
            ->with('success', 'Prototype supprimé avec succès.');
    }
}