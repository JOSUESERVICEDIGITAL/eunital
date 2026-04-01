<?php

namespace App\Http\Controllers\Back\ChambreIngenieur;

use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\DossierTechnique;
use App\Http\Requests\EnregistrerDossierTechniqueRequest;
use App\Http\Requests\ModifierDossierTechniqueRequest;

class DossierTechniqueController extends Controller
{
    public function listeTous()
    {
        $dossiers = DossierTechnique::with('auteur')
            ->latest()
            ->paginate(12);

        return view('back.chambre-ingenieur.dossiers.liste', compact('dossiers'));
    }

    public function listeBrouillons()
    {
        $dossiers = DossierTechnique::with('auteur')
            ->where('statut', 'brouillon')
            ->latest()
            ->paginate(12);

        return view('back.chambre-ingenieur.dossiers.brouillons', compact('dossiers'));
    }

    public function listePublies()
    {
        $dossiers = DossierTechnique::with('auteur')
            ->where('statut', 'publie')
            ->latest()
            ->paginate(12);

        return view('back.chambre-ingenieur.dossiers.publies', compact('dossiers'));
    }

    public function listeArchives()
    {
        $dossiers = DossierTechnique::with('auteur')
            ->where('statut', 'archive')
            ->latest()
            ->paginate(12);

        return view('back.chambre-ingenieur.dossiers.archives', compact('dossiers'));
    }

    public function formulaireCreation()
    {
        $utilisateurs = User::orderBy('name')->get();

        return view('back.chambre-ingenieur.dossiers.creer', compact('utilisateurs'));
    }

    public function enregistrer(EnregistrerDossierTechniqueRequest $request)
    {
        $donnees = $request->validated();

        $slugDeBase = Str::slug($donnees['titre']);
        $slugFinal = $slugDeBase;
        $compteur = 1;

        while (DossierTechnique::where('slug', $slugFinal)->exists()) {
            $slugFinal = $slugDeBase . '-' . $compteur;
            $compteur++;
        }

        $documentPrincipal = null;

        if ($request->hasFile('document_principal')) {
            $documentPrincipal = $request->file('document_principal')->store('chambre-ingenieur/dossiers', 'public');
        }

        $dossier = DossierTechnique::create([
            'auteur_id' => $donnees['auteur_id'] ?? auth()->id(),
            'titre' => $donnees['titre'],
            'slug' => $slugFinal,
            'resume' => $donnees['resume'] ?? null,
            'document_principal' => $documentPrincipal,
            'version' => $donnees['version'] ?? '1.0',
            'type_dossier' => $donnees['type_dossier'],
            'statut' => $donnees['statut'],
        ]);

        return redirect()
            ->route('back.chambre-ingenieur.dossiers.details', $dossier)
            ->with('success', 'Dossier technique enregistré avec succès.');
    }

    public function details(DossierTechnique $dossierTechnique)
    {
        $dossierTechnique->load('auteur');

        return view('back.chambre-ingenieur.dossiers.details', compact('dossierTechnique'));
    }

    public function formulaireEdition(DossierTechnique $dossierTechnique)
    {
        $utilisateurs = User::orderBy('name')->get();

        return view('back.chambre-ingenieur.dossiers.modifier', compact('dossierTechnique', 'utilisateurs'));
    }

    public function mettreAJour(ModifierDossierTechniqueRequest $request, DossierTechnique $dossierTechnique)
    {
        $donnees = $request->validated();

        $slugFinal = $dossierTechnique->slug;

        if ($dossierTechnique->titre !== $donnees['titre']) {
            $slugDeBase = Str::slug($donnees['titre']);
            $slugFinal = $slugDeBase;
            $compteur = 1;

            while (
                DossierTechnique::where('slug', $slugFinal)
                    ->where('id', '!=', $dossierTechnique->id)
                    ->exists()
            ) {
                $slugFinal = $slugDeBase . '-' . $compteur;
                $compteur++;
            }
        }

        $documentPrincipal = $dossierTechnique->document_principal;

        if ($request->hasFile('document_principal')) {
            if ($dossierTechnique->document_principal) {
                Storage::disk('public')->delete($dossierTechnique->document_principal);
            }

            $documentPrincipal = $request->file('document_principal')->store('chambre-ingenieur/dossiers', 'public');
        }

        $dossierTechnique->update([
            'auteur_id' => $donnees['auteur_id'] ?? $dossierTechnique->auteur_id,
            'titre' => $donnees['titre'],
            'slug' => $slugFinal,
            'resume' => $donnees['resume'] ?? null,
            'document_principal' => $documentPrincipal,
            'version' => $donnees['version'] ?? '1.0',
            'type_dossier' => $donnees['type_dossier'],
            'statut' => $donnees['statut'],
        ]);

        return back()->with('success', 'Dossier technique mis à jour avec succès.');
    }

    public function publier(DossierTechnique $dossierTechnique)
    {
        $dossierTechnique->update(['statut' => 'publie']);

        return back()->with('success', 'Dossier publié avec succès.');
    }

    public function archiver(DossierTechnique $dossierTechnique)
    {
        $dossierTechnique->update(['statut' => 'archive']);

        return back()->with('success', 'Dossier archivé avec succès.');
    }

    public function remettreEnBrouillon(DossierTechnique $dossierTechnique)
    {
        $dossierTechnique->update(['statut' => 'brouillon']);

        return back()->with('success', 'Dossier remis en brouillon.');
    }

    public function supprimerDocumentPrincipal(DossierTechnique $dossierTechnique)
    {
        if ($dossierTechnique->document_principal) {
            Storage::disk('public')->delete($dossierTechnique->document_principal);

            $dossierTechnique->update([
                'document_principal' => null,
            ]);
        }

        return back()->with('success', 'Document principal supprimé avec succès.');
    }

    public function supprimer(DossierTechnique $dossierTechnique)
    {
        if ($dossierTechnique->document_principal) {
            Storage::disk('public')->delete($dossierTechnique->document_principal);
        }

        $dossierTechnique->delete();

        return redirect()
            ->route('back.chambre-ingenieur.dossiers.tous')
            ->with('success', 'Dossier technique supprimé avec succès.');
    }
}