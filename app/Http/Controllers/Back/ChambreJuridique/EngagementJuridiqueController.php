<?php

namespace App\Http\Controllers\Back\ChambreJuridique;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEngagementJuridiqueRequest;
use App\Http\Requests\UpdateEngagementJuridiqueRequest;
use App\Models\ClientStudio;
use App\Models\EngagementJuridique;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class EngagementJuridiqueController extends Controller
{
    public function listeToutes()
    {
        $engagements = EngagementJuridique::with(['client', 'user', 'validateur'])
            ->latest()
            ->paginate(12);

        return view('back.chambre-juridique.engagements.liste', compact('engagements'));
    }

    public function listeEnAttente()
    {
        $engagements = EngagementJuridique::with(['client', 'user', 'validateur'])
            ->where('statut', 'en_attente')
            ->latest()
            ->paginate(12);

        return view('back.chambre-juridique.engagements.en-attente', compact('engagements'));
    }

    public function listeValides()
    {
        $engagements = EngagementJuridique::with(['client', 'user', 'validateur'])
            ->where('statut', 'valide')
            ->latest()
            ->paginate(12);

        return view('back.chambre-juridique.engagements.valides', compact('engagements'));
    }

    public function listeRejetes()
    {
        $engagements = EngagementJuridique::with(['client', 'user', 'validateur'])
            ->where('statut', 'rejete')
            ->latest()
            ->paginate(12);

        return view('back.chambre-juridique.engagements.rejetes', compact('engagements'));
    }

    public function formulaireCreation()
    {
        $clients = ClientStudio::orderBy('nom')->get();
        $users = User::orderBy('name')->get();

        return view('back.chambre-juridique.engagements.creer', compact('clients', 'users'));
    }

    public function enregistrer(StoreEngagementJuridiqueRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('fichier_formulaire')) {
            $data['fichier_formulaire'] = $request->file('fichier_formulaire')->store('juridique/engagements/formulaires', 'public');
        }

        if ($request->hasFile('fichier_contrat')) {
            $data['fichier_contrat'] = $request->file('fichier_contrat')->store('juridique/engagements/contrats', 'public');
        }

        $engagement = EngagementJuridique::create($data);

        return redirect()
            ->route('back.chambre-juridique.engagements.details', $engagement)
            ->with('success', 'Engagement juridique créé avec succès.');
    }

    public function details(EngagementJuridique $engagementJuridique)
    {
        $engagementJuridique->load(['client', 'user', 'validateur', 'piecesJointes']);

        return view('back.chambre-juridique.engagements.details', [
            'engagement' => $engagementJuridique
        ]);
    }

    public function formulaireEdition(EngagementJuridique $engagementJuridique)
    {
        $clients = ClientStudio::orderBy('nom')->get();
        $users = User::orderBy('name')->get();

        return view('back.chambre-juridique.engagements.modifier', [
            'engagement' => $engagementJuridique,
            'clients' => $clients,
            'users' => $users,
        ]);
    }

    public function mettreAJour(UpdateEngagementJuridiqueRequest $request, EngagementJuridique $engagementJuridique)
    {
        $data = $request->validated();

        if ($request->hasFile('fichier_formulaire')) {
            if ($engagementJuridique->fichier_formulaire && Storage::disk('public')->exists($engagementJuridique->fichier_formulaire)) {
                Storage::disk('public')->delete($engagementJuridique->fichier_formulaire);
            }

            $data['fichier_formulaire'] = $request->file('fichier_formulaire')->store('juridique/engagements/formulaires', 'public');
        }

        if ($request->hasFile('fichier_contrat')) {
            if ($engagementJuridique->fichier_contrat && Storage::disk('public')->exists($engagementJuridique->fichier_contrat)) {
                Storage::disk('public')->delete($engagementJuridique->fichier_contrat);
            }

            $data['fichier_contrat'] = $request->file('fichier_contrat')->store('juridique/engagements/contrats', 'public');
        }

        $engagementJuridique->update($data);

        return redirect()
            ->route('back.chambre-juridique.engagements.details', $engagementJuridique)
            ->with('success', 'Engagement mis à jour avec succès.');
    }

    public function valider(EngagementJuridique $engagementJuridique)
    {
        $engagementJuridique->update([
            'statut' => 'valide',
            'valide_par' => auth()->id(),
            'date_validation' => now(),
        ]);

        return back()->with('success', 'Engagement validé avec succès.');
    }

    public function rejeter(EngagementJuridique $engagementJuridique)
    {
        $engagementJuridique->update([
            'statut' => 'rejete',
            'valide_par' => auth()->id(),
            'date_validation' => now(),
        ]);

        return back()->with('success', 'Engagement rejeté.');
    }

    public function archiver(EngagementJuridique $engagementJuridique)
    {
        $engagementJuridique->update([
            'statut' => 'archive',
        ]);

        return back()->with('success', 'Engagement archivé.');
    }

    public function supprimer(EngagementJuridique $engagementJuridique)
    {
        if ($engagementJuridique->fichier_formulaire && Storage::disk('public')->exists($engagementJuridique->fichier_formulaire)) {
            Storage::disk('public')->delete($engagementJuridique->fichier_formulaire);
        }

        if ($engagementJuridique->fichier_contrat && Storage::disk('public')->exists($engagementJuridique->fichier_contrat)) {
            Storage::disk('public')->delete($engagementJuridique->fichier_contrat);
        }

        $engagementJuridique->delete();

        return redirect()
            ->route('back.chambre-juridique.engagements.toutes')
            ->with('success', 'Engagement supprimé avec succès.');
    }
}
