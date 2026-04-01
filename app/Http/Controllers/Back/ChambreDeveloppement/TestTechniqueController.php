<?php

namespace App\Http\Controllers\Back\ChambreDeveloppement;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\TestTechnique;
use App\Http\Controllers\Controller;
use App\Http\Requests\EnregistrerTestTechniqueRequest;
use App\Http\Requests\ModifierTestTechniqueRequest;

class TestTechniqueController extends Controller
{
    public function listeTous()
    {
        $tests = TestTechnique::with('auteur')
            ->latest()
            ->paginate(12);

        return view('back.chambre-developpement.tests-techniques.liste', compact('tests'));
    }

    public function listePlanifies()
    {
        $tests = TestTechnique::with('auteur')
            ->where('statut', 'planifie')
            ->latest()
            ->paginate(12);

        return view('back.chambre-developpement.tests-techniques.planifies', compact('tests'));
    }

    public function listeEnCours()
    {
        $tests = TestTechnique::with('auteur')
            ->where('statut', 'en_cours')
            ->latest()
            ->paginate(12);

        return view('back.chambre-developpement.tests-techniques.en-cours', compact('tests'));
    }

    public function listeReussis()
    {
        $tests = TestTechnique::with('auteur')
            ->where('resultat', 'reussi')
            ->latest()
            ->paginate(12);

        return view('back.chambre-developpement.tests-techniques.reussis', compact('tests'));
    }

    public function listeEchoues()
    {
        $tests = TestTechnique::with('auteur')
            ->where('resultat', 'echoue')
            ->latest()
            ->paginate(12);

        return view('back.chambre-developpement.tests-techniques.echoues', compact('tests'));
    }

    public function formulaireCreation()
    {
        $utilisateurs = User::orderBy('name')->get();

        return view('back.chambre-developpement.tests-techniques.creer', compact('utilisateurs'));
    }

    public function enregistrer(EnregistrerTestTechniqueRequest $request)
    {
        $donnees = $request->validated();

        $slugBase = Str::slug($donnees['titre']);
        $slug = $slugBase;
        $compteur = 1;

        while (TestTechnique::where('slug', $slug)->exists()) {
            $slug = $slugBase . '-' . $compteur++;
        }

        $test = TestTechnique::create([
            'auteur_id' => $donnees['auteur_id'] ?? auth()->id(),
            'titre' => $donnees['titre'],
            'slug' => $slug,
            'description' => $donnees['description'] ?? null,
            'type_test' => $donnees['type_test'],
            'resultat' => $donnees['resultat'],
            'environnement_test' => $donnees['environnement_test'] ?? null,
            'statut' => $donnees['statut'],
        ]);

        return redirect()
            ->route('back.chambre-developpement.tests-techniques.details', $test)
            ->with('success', 'Test technique enregistré avec succès.');
    }

    public function details(TestTechnique $testTechnique)
    {
        $testTechnique->load('auteur');

        return view('back.chambre-developpement.tests-techniques.details', compact('testTechnique'));
    }

    public function formulaireEdition(TestTechnique $testTechnique)
    {
        $utilisateurs = User::orderBy('name')->get();

        return view('back.chambre-developpement.tests-techniques.modifier', compact('testTechnique', 'utilisateurs'));
    }

    public function mettreAJour(ModifierTestTechniqueRequest $request, TestTechnique $testTechnique)
    {
        $donnees = $request->validated();

        $slug = $testTechnique->slug;
        if ($testTechnique->titre !== $donnees['titre']) {
            $slugBase = Str::slug($donnees['titre']);
            $slug = $slugBase;
            $compteur = 1;

            while (
                TestTechnique::where('slug', $slug)
                    ->where('id', '!=', $testTechnique->id)
                    ->exists()
            ) {
                $slug = $slugBase . '-' . $compteur++;
            }
        }

        $testTechnique->update([
            'auteur_id' => $donnees['auteur_id'] ?? $testTechnique->auteur_id,
            'titre' => $donnees['titre'],
            'slug' => $slug,
            'description' => $donnees['description'] ?? null,
            'type_test' => $donnees['type_test'],
            'resultat' => $donnees['resultat'],
            'environnement_test' => $donnees['environnement_test'] ?? null,
            'statut' => $donnees['statut'],
        ]);

        return back()->with('success', 'Test technique mis à jour avec succès.');
    }

    public function lancer(TestTechnique $testTechnique)
    {
        $testTechnique->update(['statut' => 'en_cours']);

        return back()->with('success', 'Test lancé.');
    }

    public function marquerReussi(TestTechnique $testTechnique)
    {
        $testTechnique->update([
            'statut' => 'termine',
            'resultat' => 'reussi',
        ]);

        return back()->with('success', 'Test marqué comme réussi.');
    }

    public function marquerEchoue(TestTechnique $testTechnique)
    {
        $testTechnique->update([
            'statut' => 'termine',
            'resultat' => 'echoue',
        ]);

        return back()->with('success', 'Test marqué comme échoué.');
    }

    public function annuler(TestTechnique $testTechnique)
    {
        $testTechnique->update(['statut' => 'annule']);

        return back()->with('success', 'Test annulé.');
    }

    public function supprimer(TestTechnique $testTechnique)
    {
        $testTechnique->delete();

        return redirect()
            ->route('back.chambre-developpement.tests-techniques.tous')
            ->with('success', 'Test technique supprimé avec succès.');
    }
}
