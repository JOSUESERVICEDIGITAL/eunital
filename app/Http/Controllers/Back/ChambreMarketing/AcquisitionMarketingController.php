<?php

namespace App\Http\Controllers\Back\ChambreMarketing;

use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\CampagneMarketing;
use App\Models\AcquisitionMarketing;
use App\Http\Requests\EnregistrerAcquisitionMarketingRequest;
use App\Http\Requests\ModifierAcquisitionMarketingRequest;

class AcquisitionMarketingController extends Controller
{
    public function listeToutes()
    {
        $acquisitions = AcquisitionMarketing::with(['auteur', 'campagne'])
            ->latest()
            ->paginate(12);

        return view('back.chambre-marketing.acquisitions.liste', compact('acquisitions'));
    }

    public function listeActives()
    {
        $acquisitions = AcquisitionMarketing::with(['auteur', 'campagne'])
            ->where('statut', 'active')
            ->latest()
            ->paginate(12);

        return view('back.chambre-marketing.acquisitions.actives', compact('acquisitions'));
    }

    public function listeOptimisation()
    {
        $acquisitions = AcquisitionMarketing::with(['auteur', 'campagne'])
            ->where('statut', 'optimisation')
            ->latest()
            ->paginate(12);

        return view('back.chambre-marketing.acquisitions.optimisation', compact('acquisitions'));
    }

    public function formulaireCreation()
    {
        $utilisateurs = User::orderBy('name')->get();
        $campagnes = CampagneMarketing::orderBy('titre')->get();

        return view('back.chambre-marketing.acquisitions.creer', compact('utilisateurs', 'campagnes'));
    }

    public function enregistrer(EnregistrerAcquisitionMarketingRequest $request)
    {
        $donnees = $request->validated();

        $slugBase = Str::slug($donnees['titre']);
        $slug = $slugBase;
        $compteur = 1;

        while (AcquisitionMarketing::where('slug', $slug)->exists()) {
            $slug = $slugBase . '-' . $compteur++;
        }

        $acquisition = AcquisitionMarketing::create([
            'auteur_id' => $donnees['auteur_id'] ?? auth()->id(),
            'campagne_marketing_id' => $donnees['campagne_marketing_id'] ?? null,
            'titre' => $donnees['titre'],
            'slug' => $slug,
            'source' => $donnees['source'] ?? null,
            'canal' => $donnees['canal'] ?? null,
            'visiteurs' => $donnees['visiteurs'] ?? 0,
            'leads' => $donnees['leads'] ?? 0,
            'cout_acquisition' => $donnees['cout_acquisition'] ?? 0,
            'taux_conversion' => $donnees['taux_conversion'] ?? null,
            'statut' => $donnees['statut'],
        ]);

        return redirect()
            ->route('back.chambre-marketing.acquisitions.details', $acquisition)
            ->with('success', 'Acquisition marketing enregistrée avec succès.');
    }

    public function details(AcquisitionMarketing $acquisitionMarketing)
    {
        $acquisitionMarketing->load(['auteur', 'campagne']);

        return view('back.chambre-marketing.acquisitions.details', compact('acquisitionMarketing'));
    }

    public function formulaireEdition(AcquisitionMarketing $acquisitionMarketing)
    {
        $utilisateurs = User::orderBy('name')->get();
        $campagnes = CampagneMarketing::orderBy('titre')->get();

        return view('back.chambre-marketing.acquisitions.modifier', compact('acquisitionMarketing', 'utilisateurs', 'campagnes'));
    }

    public function mettreAJour(ModifierAcquisitionMarketingRequest $request, AcquisitionMarketing $acquisitionMarketing)
    {
        $donnees = $request->validated();

        $slug = $acquisitionMarketing->slug;

        if ($acquisitionMarketing->titre !== $donnees['titre']) {
            $slugBase = Str::slug($donnees['titre']);
            $slug = $slugBase;
            $compteur = 1;

            while (
                AcquisitionMarketing::where('slug', $slug)
                    ->where('id', '!=', $acquisitionMarketing->id)
                    ->exists()
            ) {
                $slug = $slugBase . '-' . $compteur++;
            }
        }

        $acquisitionMarketing->update([
            'auteur_id' => $donnees['auteur_id'] ?? $acquisitionMarketing->auteur_id,
            'campagne_marketing_id' => $donnees['campagne_marketing_id'] ?? null,
            'titre' => $donnees['titre'],
            'slug' => $slug,
            'source' => $donnees['source'] ?? null,
            'canal' => $donnees['canal'] ?? null,
            'visiteurs' => $donnees['visiteurs'] ?? 0,
            'leads' => $donnees['leads'] ?? 0,
            'cout_acquisition' => $donnees['cout_acquisition'] ?? 0,
            'taux_conversion' => $donnees['taux_conversion'] ?? null,
            'statut' => $donnees['statut'],
        ]);

        return back()->with('success', 'Acquisition marketing mise à jour avec succès.');
    }

    public function activer(AcquisitionMarketing $acquisitionMarketing)
    {
        $acquisitionMarketing->update(['statut' => 'active']);

        return back()->with('success', 'Acquisition activée.');
    }

    public function optimiser(AcquisitionMarketing $acquisitionMarketing)
    {
        $acquisitionMarketing->update(['statut' => 'optimisation']);

        return back()->with('success', 'Acquisition passée en optimisation.');
    }

    public function stopper(AcquisitionMarketing $acquisitionMarketing)
    {
        $acquisitionMarketing->update(['statut' => 'stoppee']);

        return back()->with('success', 'Acquisition stoppée.');
    }

    public function archiver(AcquisitionMarketing $acquisitionMarketing)
    {
        $acquisitionMarketing->update(['statut' => 'archivee']);

        return back()->with('success', 'Acquisition archivée.');
    }

    public function supprimer(AcquisitionMarketing $acquisitionMarketing)
    {
        $acquisitionMarketing->delete();

        return redirect()
            ->route('back.chambre-marketing.acquisitions.toutes')
            ->with('success', 'Acquisition supprimée avec succès.');
    }
}
