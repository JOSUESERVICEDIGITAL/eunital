<?php

namespace App\Http\Controllers\Back\Equipe;

use App\Models\User;
use App\Models\Poste;
use App\Models\Departement;
use App\Models\MembreEquipe;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\EnregistrerMembreEquipeRequest;
use App\Http\Requests\ModifierMembreEquipeRequest;



class MembreEquipeController extends Controller
{
    public function listeTous()
    {
        $membres = MembreEquipe::with(['utilisateur', 'departement', 'poste', 'responsable'])
            ->orderBy('ordre_organigramme')
            ->latest()
            ->paginate(12);

        return view('back.equipe.membres.liste', compact('membres'));
    }

    public function listeActifs()
    {
        $membres = MembreEquipe::with(['utilisateur', 'departement', 'poste', 'responsable'])
            ->where('statut', 'actif')
            ->orderBy('ordre_organigramme')
            ->paginate(12);

        return view('back.equipe.membres.actifs', compact('membres'));
    }

    public function listeInactifs()
    {
        $membres = MembreEquipe::with(['utilisateur', 'departement', 'poste', 'responsable'])
            ->where('statut', 'inactif')
            ->orderBy('ordre_organigramme')
            ->paginate(12);

        return view('back.equipe.membres.inactifs', compact('membres'));
    }

    public function listeEnPause()
    {
        $membres = MembreEquipe::with(['utilisateur', 'departement', 'poste', 'responsable'])
            ->where('statut', 'en_pause')
            ->orderBy('ordre_organigramme')
            ->paginate(12);

        return view('back.equipe.membres.en-pause', compact('membres'));
    }

    public function listeParDepartement(Departement $departement)
    {
        $membres = MembreEquipe::with(['utilisateur', 'departement', 'poste', 'responsable'])
            ->where('departement_id', $departement->id)
            ->orderBy('ordre_organigramme')
            ->paginate(12);

        return view('back.equipe.membres.par-departement', compact('membres', 'departement'));
    }

    public function organigramme()
    {
        $membres = MembreEquipe::with(['departement', 'poste', 'responsable', 'subordonnes'])
            ->where('est_visible_organigramme', true)
            ->orderBy('ordre_organigramme')
            ->get();

        return view('back.equipe.membres.organigramme', compact('membres'));
    }

    public function formulaireCreation()
    {
        $utilisateurs = User::orderBy('name')->get();
        $departements = Departement::where('est_actif', true)->orderBy('nom')->get();
        $postes = Poste::where('est_actif', true)->orderBy('nom')->get();
        $responsables = MembreEquipe::orderBy('nom')->orderBy('prenom')->get();

        return view('back.equipe.membres.creer', compact(
            'utilisateurs',
            'departements',
            'postes',
            'responsables'
        ));
    }

    public function enregistrer(EnregistrerMembreEquipeRequest $request)
    {
        $donnees = $request->validated();

        if ($request->hasFile('photo')) {
            $donnees['photo'] = $request->file('photo')->store('equipe/membres', 'public');
        }

        $membreEquipe = MembreEquipe::create([
            'user_id' => $donnees['user_id'] ?? null,
            'departement_id' => $donnees['departement_id'] ?? null,
            'poste_id' => $donnees['poste_id'] ?? null,
            'responsable_id' => $donnees['responsable_id'] ?? null,
            'nom' => $donnees['nom'],
            'prenom' => $donnees['prenom'] ?? null,
            'email_professionnel' => $donnees['email_professionnel'] ?? null,
            'telephone' => $donnees['telephone'] ?? null,
            'photo' => $donnees['photo'] ?? null,
            'bio' => $donnees['bio'] ?? null,
            'date_integration' => $donnees['date_integration'] ?? null,
            'statut' => $donnees['statut'],
            'ordre_organigramme' => $donnees['ordre_organigramme'] ?? null,
            'est_visible_organigramme' => $request->boolean('est_visible_organigramme', true),
        ]);

        return redirect()
            ->route('back.equipe.membres.details', $membreEquipe)
            ->with('success', 'Membre de l’équipe créé avec succès.');
    }

    public function details(MembreEquipe $membreEquipe)
    {
        $membreEquipe->load([
            'utilisateur',
            'departement',
            'poste',
            'responsable',
            'subordonnes',
            'messagesEnvoyes',
            'messagesRecus',
        ]);

        return view('back.equipe.membres.details', compact('membreEquipe'));
    }

    public function formulaireEdition(MembreEquipe $membreEquipe)
    {
        $utilisateurs = User::orderBy('name')->get();
        $departements = Departement::orderBy('nom')->get();
        $postes = Poste::orderBy('nom')->get();
        $responsables = MembreEquipe::where('id', '!=', $membreEquipe->id)
            ->orderBy('nom')
            ->orderBy('prenom')
            ->get();

        return view('back.equipe.membres.modifier', compact(
            'membreEquipe',
            'utilisateurs',
            'departements',
            'postes',
            'responsables'
        ));
    }

    public function mettreAJour(ModifierMembreEquipeRequest $request, MembreEquipe $membreEquipe)
    {
        $donnees = $request->validated();

        if ($request->hasFile('photo')) {
            if ($membreEquipe->photo) {
                Storage::disk('public')->delete($membreEquipe->photo);
            }

            $donnees['photo'] = $request->file('photo')->store('equipe/membres', 'public');
        }

        $membreEquipe->update([
            'user_id' => $donnees['user_id'] ?? null,
            'departement_id' => $donnees['departement_id'] ?? null,
            'poste_id' => $donnees['poste_id'] ?? null,
            'responsable_id' => $donnees['responsable_id'] ?? null,
            'nom' => $donnees['nom'],
            'prenom' => $donnees['prenom'] ?? null,
            'email_professionnel' => $donnees['email_professionnel'] ?? null,
            'telephone' => $donnees['telephone'] ?? null,
            'photo' => $donnees['photo'] ?? $membreEquipe->photo,
            'bio' => $donnees['bio'] ?? null,
            'date_integration' => $donnees['date_integration'] ?? null,
            'statut' => $donnees['statut'],
            'ordre_organigramme' => $donnees['ordre_organigramme'] ?? null,
            'est_visible_organigramme' => $request->boolean('est_visible_organigramme', false),
        ]);

        return back()->with('success', 'Membre de l’équipe mis à jour avec succès.');
    }

    public function activer(MembreEquipe $membreEquipe)
    {
        $membreEquipe->update([
            'statut' => 'actif',
        ]);

        return back()->with('success', 'Le membre a été activé.');
    }

    public function desactiver(MembreEquipe $membreEquipe)
    {
        $membreEquipe->update([
            'statut' => 'inactif',
        ]);

        return back()->with('success', 'Le membre a été désactivé.');
    }

    public function mettreEnPause(MembreEquipe $membreEquipe)
    {
        $membreEquipe->update([
            'statut' => 'en_pause',
        ]);

        return back()->with('success', 'Le membre a été mis en pause.');
    }

    public function afficherDansOrganigramme(MembreEquipe $membreEquipe)
    {
        $membreEquipe->update([
            'est_visible_organigramme' => true,
        ]);

        return back()->with('success', 'Le membre est maintenant visible dans l’organigramme.');
    }

    public function masquerDeOrganigramme(MembreEquipe $membreEquipe)
    {
        $membreEquipe->update([
            'est_visible_organigramme' => false,
        ]);

        return back()->with('success', 'Le membre a été masqué de l’organigramme.');
    }

    public function supprimerPhoto(MembreEquipe $membreEquipe)
    {
        if ($membreEquipe->photo) {
            Storage::disk('public')->delete($membreEquipe->photo);

            $membreEquipe->update([
                'photo' => null,
            ]);
        }

        return back()->with('success', 'La photo du membre a été supprimée.');
    }

    public function supprimer(MembreEquipe $membreEquipe)
    {
        if ($membreEquipe->photo) {
            Storage::disk('public')->delete($membreEquipe->photo);
        }

        $membreEquipe->delete();

        return redirect()
            ->route('back.equipe.membres.tous')
            ->with('success', 'Membre de l’équipe supprimé avec succès.');
    }
}
