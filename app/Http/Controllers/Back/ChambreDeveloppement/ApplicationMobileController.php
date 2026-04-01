<?php
namespace App\Http\Controllers\Back\ChambreDeveloppement;

use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\ApplicationMobile;
use App\Http\Requests\EnregistrerApplicationMobileRequest;
use App\Http\Requests\ModifierApplicationMobileRequest;

class ApplicationMobileController extends Controller
{
    public function listeToutes()
    {
        $applications = ApplicationMobile::with(['auteur', 'responsable'])
            ->latest()
            ->paginate(12);

        return view('back.chambre-developpement.applications-mobiles.liste', compact('applications'));
    }

    public function listeAndroid()
    {
        $applications = ApplicationMobile::with(['auteur', 'responsable'])
            ->where('plateforme', 'android')
            ->latest()
            ->paginate(12);

        return view('back.chambre-developpement.applications-mobiles.android', compact('applications'));
    }

    public function listeIos()
    {
        $applications = ApplicationMobile::with(['auteur', 'responsable'])
            ->where('plateforme', 'ios')
            ->latest()
            ->paginate(12);

        return view('back.chambre-developpement.applications-mobiles.ios', compact('applications'));
    }

    public function listeHybrides()
    {
        $applications = ApplicationMobile::with(['auteur', 'responsable'])
            ->where('plateforme', 'hybride')
            ->latest()
            ->paginate(12);

        return view('back.chambre-developpement.applications-mobiles.hybrides', compact('applications'));
    }

    public function listePubliees()
    {
        $applications = ApplicationMobile::with(['auteur', 'responsable'])
            ->where('statut', 'publiee')
            ->latest()
            ->paginate(12);

        return view('back.chambre-developpement.applications-mobiles.publiees', compact('applications'));
    }

    public function formulaireCreation()
    {
        $utilisateurs = User::orderBy('name')->get();

        return view('back.chambre-developpement.applications-mobiles.creer', compact('utilisateurs'));
    }

    public function enregistrer(EnregistrerApplicationMobileRequest $request)
    {
        $donnees = $request->validated();

        $slugBase = Str::slug($donnees['titre']);
        $slug = $slugBase;
        $compteur = 1;

        while (ApplicationMobile::where('slug', $slug)->exists()) {
            $slug = $slugBase . '-' . $compteur++;
        }

        $application = ApplicationMobile::create([
            'auteur_id' => $donnees['auteur_id'] ?? auth()->id(),
            'responsable_id' => $donnees['responsable_id'] ?? null,
            'titre' => $donnees['titre'],
            'slug' => $slug,
            'description' => $donnees['description'] ?? null,
            'plateforme' => $donnees['plateforme'],
            'stack_mobile' => $donnees['stack_mobile'] ?? null,
            'lien_demo' => $donnees['lien_demo'] ?? null,
            'version' => $donnees['version'] ?? '1.0',
            'statut' => $donnees['statut'],
        ]);

        return redirect()
            ->route('back.chambre-developpement.applications-mobiles.details', $application)
            ->with('success', 'Application mobile enregistrée avec succès.');
    }

    public function details(ApplicationMobile $applicationMobile)
    {
        $applicationMobile->load(['auteur', 'responsable']);

        return view('back.chambre-developpement.applications-mobiles.details', compact('applicationMobile'));
    }

    public function formulaireEdition(ApplicationMobile $applicationMobile)
    {
        $utilisateurs = User::orderBy('name')->get();

        return view('back.chambre-developpement.applications-mobiles.modifier', compact('applicationMobile', 'utilisateurs'));
    }

    public function mettreAJour(ModifierApplicationMobileRequest $request, ApplicationMobile $applicationMobile)
    {
        $donnees = $request->validated();

        $slug = $applicationMobile->slug;
        if ($applicationMobile->titre !== $donnees['titre']) {
            $slugBase = Str::slug($donnees['titre']);
            $slug = $slugBase;
            $compteur = 1;

            while (
                ApplicationMobile::where('slug', $slug)
                    ->where('id', '!=', $applicationMobile->id)
                    ->exists()
            ) {
                $slug = $slugBase . '-' . $compteur++;
            }
        }

        $applicationMobile->update([
            'auteur_id' => $donnees['auteur_id'] ?? $applicationMobile->auteur_id,
            'responsable_id' => $donnees['responsable_id'] ?? null,
            'titre' => $donnees['titre'],
            'slug' => $slug,
            'description' => $donnees['description'] ?? null,
            'plateforme' => $donnees['plateforme'],
            'stack_mobile' => $donnees['stack_mobile'] ?? null,
            'lien_demo' => $donnees['lien_demo'] ?? null,
            'version' => $donnees['version'] ?? $applicationMobile->version,
            'statut' => $donnees['statut'],
        ]);

        return back()->with('success', 'Application mobile mise à jour avec succès.');
    }

    public function passerEnDeveloppement(ApplicationMobile $applicationMobile)
    {
        $applicationMobile->update(['statut' => 'en_developpement']);

        return back()->with('success', 'Application mobile passée en développement.');
    }

    public function passerEnTest(ApplicationMobile $applicationMobile)
    {
        $applicationMobile->update(['statut' => 'en_test']);

        return back()->with('success', 'Application mobile passée en test.');
    }

    public function publier(ApplicationMobile $applicationMobile)
    {
        $applicationMobile->update(['statut' => 'publiee']);

        return back()->with('success', 'Application mobile publiée.');
    }

    public function suspendre(ApplicationMobile $applicationMobile)
    {
        $applicationMobile->update(['statut' => 'suspendue']);

        return back()->with('success', 'Application mobile suspendue.');
    }

    public function archiver(ApplicationMobile $applicationMobile)
    {
        $applicationMobile->update(['statut' => 'archivee']);

        return back()->with('success', 'Application mobile archivée.');
    }

    public function supprimer(ApplicationMobile $applicationMobile)
    {
        $applicationMobile->delete();

        return redirect()
            ->route('back.chambre-developpement.applications-mobiles.toutes')
            ->with('success', 'Application mobile supprimée avec succès.');
    }
}
