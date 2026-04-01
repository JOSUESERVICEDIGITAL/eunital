<?php

namespace App\Http\Controllers\Back\ChambreIngenieur;

use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\EtudeFaisabilite;
use App\Http\Requests\EnregistrerEtudeFaisabiliteRequest;
use App\Http\Requests\ModifierEtudeFaisabiliteRequest;

class EtudeFaisabiliteController extends Controller
{
    public function listeToutes()
    {
        $etudes = EtudeFaisabilite::with('auteur')
            ->latest()
            ->paginate(12);

        return view('back.chambre-ingenieur.etudes.liste', compact('etudes'));
    }

    public function listeFavorables()
    {
        $etudes = EtudeFaisabilite::with('auteur')
            ->where('decision', 'favorable')
            ->latest()
            ->paginate(12);

        return view('back.chambre-ingenieur.etudes.favorables', compact('etudes'));
    }

    public function listeReservees()
    {
        $etudes = EtudeFaisabilite::with('auteur')
            ->where('decision', 'reservee')
            ->latest()
            ->paginate(12);

        return view('back.chambre-ingenieur.etudes.reservees', compact('etudes'));
    }

    public function listeDefavorables()
    {
        $etudes = EtudeFaisabilite::with('auteur')
            ->where('decision', 'defavorable')
            ->latest()
            ->paginate(12);

        return view('back.chambre-ingenieur.etudes.defavorables', compact('etudes'));
    }

    public function formulaireCreation()
    {
        $utilisateurs = User::orderBy('name')->get();

        return view('back.chambre-ingenieur.etudes.creer', compact('utilisateurs'));
    }

    public function enregistrer(EnregistrerEtudeFaisabiliteRequest $request)
    {
        $donnees = $request->validated();

        $slugDeBase = Str::slug($donnees['titre']);
        $slugFinal = $slugDeBase;
        $compteur = 1;

        while (EtudeFaisabilite::where('slug', $slugFinal)->exists()) {
            $slugFinal = $slugDeBase . '-' . $compteur;
            $compteur++;
        }

        $etude = EtudeFaisabilite::create([
            'auteur_id' => $donnees['auteur_id'] ?? auth()->id(),
            'titre' => $donnees['titre'],
            'slug' => $slugFinal,
            'description' => $donnees['description'] ?? null,
            'faisabilite_technique' => $donnees['faisabilite_technique'] ?? null,
            'faisabilite_financiere' => $donnees['faisabilite_financiere'] ?? null,
            'faisabilite_humaine' => $donnees['faisabilite_humaine'] ?? null,
            'risques' => $donnees['risques'] ?? null,
            'recommandation_finale' => $donnees['recommandation_finale'] ?? null,
            'decision' => $donnees['decision'],
        ]);

        return redirect()
            ->route('back.chambre-ingenieur.etudes.details', $etude)
            ->with('success', 'Étude de faisabilité enregistrée avec succès.');
    }

    public function details(EtudeFaisabilite $etudeFaisabilite)
    {
        $etudeFaisabilite->load('auteur');

        return view('back.chambre-ingenieur.etudes.details', compact('etudeFaisabilite'));
    }

    public function formulaireEdition(EtudeFaisabilite $etudeFaisabilite)
    {
        $utilisateurs = User::orderBy('name')->get();

        return view('back.chambre-ingenieur.etudes.modifier', compact('etudeFaisabilite', 'utilisateurs'));
    }

    public function mettreAJour(ModifierEtudeFaisabiliteRequest $request, EtudeFaisabilite $etudeFaisabilite)
    {
        $donnees = $request->validated();

        $slugFinal = $etudeFaisabilite->slug;

        if ($etudeFaisabilite->titre !== $donnees['titre']) {
            $slugDeBase = Str::slug($donnees['titre']);
            $slugFinal = $slugDeBase;
            $compteur = 1;

            while (
                EtudeFaisabilite::where('slug', $slugFinal)
                    ->where('id', '!=', $etudeFaisabilite->id)
                    ->exists()
            ) {
                $slugFinal = $slugDeBase . '-' . $compteur;
                $compteur++;
            }
        }

        $etudeFaisabilite->update([
            'auteur_id' => $donnees['auteur_id'] ?? $etudeFaisabilite->auteur_id,
            'titre' => $donnees['titre'],
            'slug' => $slugFinal,
            'description' => $donnees['description'] ?? null,
            'faisabilite_technique' => $donnees['faisabilite_technique'] ?? null,
            'faisabilite_financiere' => $donnees['faisabilite_financiere'] ?? null,
            'faisabilite_humaine' => $donnees['faisabilite_humaine'] ?? null,
            'risques' => $donnees['risques'] ?? null,
            'recommandation_finale' => $donnees['recommandation_finale'] ?? null,
            'decision' => $donnees['decision'],
        ]);

        return back()->with('success', 'Étude de faisabilité mise à jour avec succès.');
    }

    public function rendreFavorable(EtudeFaisabilite $etudeFaisabilite)
    {
        $etudeFaisabilite->update(['decision' => 'favorable']);

        return back()->with('success', 'Décision marquée comme favorable.');
    }

    public function rendreReservee(EtudeFaisabilite $etudeFaisabilite)
    {
        $etudeFaisabilite->update(['decision' => 'reservee']);

        return back()->with('success', 'Décision marquée comme réservée.');
    }

    public function rendreDefavorable(EtudeFaisabilite $etudeFaisabilite)
    {
        $etudeFaisabilite->update(['decision' => 'defavorable']);

        return back()->with('success', 'Décision marquée comme défavorable.');
    }

    public function supprimer(EtudeFaisabilite $etudeFaisabilite)
    {
        $etudeFaisabilite->delete();

        return redirect()
            ->route('back.chambre-ingenieur.etudes.toutes')
            ->with('success', 'Étude de faisabilité supprimée avec succès.');
    }
}