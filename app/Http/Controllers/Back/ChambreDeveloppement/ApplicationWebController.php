<?php

namespace App\Http\Controllers\Back\ChambreDeveloppement;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\ApplicationWeb;
use App\Http\Controllers\Controller;
use App\Http\Requests\EnregistrerApplicationWebRequest;
use App\Http\Requests\ModifierApplicationWebRequest;

class ApplicationWebController extends Controller
{
    public function listeToutes()
    {
        $applications = ApplicationWeb::with(['auteur', 'responsable'])
            ->latest()
            ->paginate(12);

        return view('back.chambre-developpement.applications-web.liste', compact('applications'));
    }

    public function listeEnConception()
    {
        $applications = ApplicationWeb::with(['auteur', 'responsable'])
            ->where('statut', 'conception')
            ->latest()
            ->paginate(12);

        return view('back.chambre-developpement.applications-web.conception', compact('applications'));
    }

    public function listeEnDeveloppement()
    {
        $applications = ApplicationWeb::with(['auteur', 'responsable'])
            ->where('statut', 'en_developpement')
            ->latest()
            ->paginate(12);

        return view('back.chambre-developpement.applications-web.developpement', compact('applications'));
    }

    public function listeEnTest()
    {
        $applications = ApplicationWeb::with(['auteur', 'responsable'])
            ->where('statut', 'en_test')
            ->latest()
            ->paginate(12);

        return view('back.chambre-developpement.applications-web.tests', compact('applications'));
    }

    public function listeEnLigne()
    {
        $applications = ApplicationWeb::with(['auteur', 'responsable'])
            ->where('statut', 'en_ligne')
            ->latest()
            ->paginate(12);

        return view('back.chambre-developpement.applications-web.en-ligne', compact('applications'));
    }

    public function listeCritiques()
    {
        $applications = ApplicationWeb::with(['auteur', 'responsable'])
            ->where('priorite', 'critique')
            ->latest()
            ->paginate(12);

        return view('back.chambre-developpement.applications-web.critiques', compact('applications'));
    }

    public function formulaireCreation()
    {
        $utilisateurs = User::orderBy('name')->get();

        return view('back.chambre-developpement.applications-web.creer', compact('utilisateurs'));
    }

    public function enregistrer(EnregistrerApplicationWebRequest $request)
    {
        $donnees = $request->validated();

        $slugBase = Str::slug($donnees['titre']);
        $slug = $slugBase;
        $compteur = 1;

        while (ApplicationWeb::where('slug', $slug)->exists()) {
            $slug = $slugBase . '-' . $compteur++;
        }

        $application = ApplicationWeb::create([
            'auteur_id' => $donnees['auteur_id'] ?? auth()->id(),
            'responsable_id' => $donnees['responsable_id'] ?? null,
            'titre' => $donnees['titre'],
            'slug' => $slug,
            'description' => $donnees['description'] ?? null,
            'stack_technique' => $donnees['stack_technique'] ?? null,
            'url_production' => $donnees['url_production'] ?? null,
            'url_staging' => $donnees['url_staging'] ?? null,
            'statut' => $donnees['statut'],
            'priorite' => $donnees['priorite'],
            'version' => $donnees['version'] ?? '1.0',
        ]);

        return redirect()
            ->route('back.chambre-developpement.applications-web.details', $application)
            ->with('success', 'Application web enregistrée avec succès.');
    }

    public function details(ApplicationWeb $applicationWeb)
    {
        $applicationWeb->load(['auteur', 'responsable']);

        return view('back.chambre-developpement.applications-web.details', compact('applicationWeb'));
    }

    public function formulaireEdition(ApplicationWeb $applicationWeb)
    {
        $utilisateurs = User::orderBy('name')->get();

        return view('back.chambre-developpement.applications-web.modifier', compact('applicationWeb', 'utilisateurs'));
    }

    public function mettreAJour(ModifierApplicationWebRequest $request, ApplicationWeb $applicationWeb)
    {
        $donnees = $request->validated();

        $slug = $applicationWeb->slug;
        if ($applicationWeb->titre !== $donnees['titre']) {
            $slugBase = Str::slug($donnees['titre']);
            $slug = $slugBase;
            $compteur = 1;

            while (
                ApplicationWeb::where('slug', $slug)
                    ->where('id', '!=', $applicationWeb->id)
                    ->exists()
            ) {
                $slug = $slugBase . '-' . $compteur++;
            }
        }

        $applicationWeb->update([
            'auteur_id' => $donnees['auteur_id'] ?? $applicationWeb->auteur_id,
            'responsable_id' => $donnees['responsable_id'] ?? null,
            'titre' => $donnees['titre'],
            'slug' => $slug,
            'description' => $donnees['description'] ?? null,
            'stack_technique' => $donnees['stack_technique'] ?? null,
            'url_production' => $donnees['url_production'] ?? null,
            'url_staging' => $donnees['url_staging'] ?? null,
            'statut' => $donnees['statut'],
            'priorite' => $donnees['priorite'],
            'version' => $donnees['version'] ?? $applicationWeb->version,
        ]);

        return back()->with('success', 'Application web mise à jour avec succès.');
    }

    public function passerEnDeveloppement(ApplicationWeb $applicationWeb)
    {
        $applicationWeb->update(['statut' => 'en_developpement']);

        return back()->with('success', 'Application passée en développement.');
    }

    public function passerEnTest(ApplicationWeb $applicationWeb)
    {
        $applicationWeb->update(['statut' => 'en_test']);

        return back()->with('success', 'Application passée en test.');
    }

    public function mettreEnLigne(ApplicationWeb $applicationWeb)
    {
        $applicationWeb->update(['statut' => 'en_ligne']);

        return back()->with('success', 'Application mise en ligne.');
    }

    public function suspendre(ApplicationWeb $applicationWeb)
    {
        $applicationWeb->update(['statut' => 'suspendue']);

        return back()->with('success', 'Application suspendue.');
    }

    public function archiver(ApplicationWeb $applicationWeb)
    {
        $applicationWeb->update(['statut' => 'archivee']);

        return back()->with('success', 'Application archivée.');
    }

    public function definirPrioriteCritique(ApplicationWeb $applicationWeb)
    {
        $applicationWeb->update(['priorite' => 'critique']);

        return back()->with('success', 'Priorité critique appliquée.');
    }

    public function supprimer(ApplicationWeb $applicationWeb)
    {
        $applicationWeb->delete();

        return redirect()
            ->route('back.chambre-developpement.applications-web.toutes')
            ->with('success', 'Application web supprimée avec succès.');
    }
}
