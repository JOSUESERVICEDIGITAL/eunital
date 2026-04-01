<?php

namespace App\Http\Controllers\Back\Utilisateur;

use App\Http\Controllers\Controller;
use App\Http\Requests\EnregistrerUtilisateurRequest;
use App\Http\Requests\ModifierUtilisateurRequest;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Storage;

class UtilisateurController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LISTES INTELLIGENTES
    |--------------------------------------------------------------------------
    */

    public function listeTous()
    {
        $utilisateurs = User::with('roles')
            ->latest()
            ->paginate(12);

        return view('back.utilisateurs.utilisateurs.liste', compact('utilisateurs'));
    }

    public function listeAdministrateurs()
    {
        $utilisateurs = User::whereHas('roles', function ($q) {
            $q->where('slug', 'administrateur');
        })->with('roles')->paginate(12);

        return view('back.utilisateurs.utilisateurs.liste', compact('utilisateurs'));
    }

    public function listeAuteurs()
    {
        $utilisateurs = User::whereHas('roles', function ($q) {
            $q->where('slug', 'auteur');
        })->with('roles')->paginate(12);

        return view('back.utilisateurs.utilisateurs.liste', compact('utilisateurs'));
    }

    public function listeResponsables()
    {
        $utilisateurs = User::whereHas('roles', function ($q) {
            $q->where('slug', 'responsable');
        })->with('roles')->paginate(12);

        return view('back.utilisateurs.utilisateurs.liste', compact('utilisateurs'));
    }

    public function listeDesactives()
    {
        $utilisateurs = User::where('est_actif', false)
            ->with('roles')
            ->paginate(12);

        return view('back.utilisateurs.utilisateurs.liste', compact('utilisateurs'));
    }

    /*
    |--------------------------------------------------------------------------
    | FORMULAIRES
    |--------------------------------------------------------------------------
    */

    public function formulaireCreation()
    {
        $roles = Role::where('est_actif', true)->get();

        return view('back.utilisateurs.creer', compact('roles'));
    }

    public function formulaireEdition(User $utilisateur)
    {
        $roles = Role::all();

        return view('back.utilisateurs.utilisateurs.modifier', compact('utilisateur', 'roles'));
    }

    /*
    |--------------------------------------------------------------------------
    | ACTIONS MÉTIER
    |--------------------------------------------------------------------------
    */

    public function enregistrer(EnregistrerUtilisateurRequest $request)
    {
        $data = $request->validated();

        // gestion photo
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('utilisateurs', 'public');
        }

        $utilisateur = User::create($data);

        // attribution des rôles
        if (!empty($data['roles'])) {
            $utilisateur->roles()->attach($data['roles']);
        }

        return redirect()
            ->route('back.utilisateurs.details', $utilisateur)
            ->with('success', 'Utilisateur créé avec succès.');
    }

    public function mettreAJour(ModifierUtilisateurRequest $request, User $utilisateur)
    {
        $data = $request->validated();

        // mot de passe optionnel
        if (empty($data['password'])) {
            unset($data['password']);
        }

        // photo
        if ($request->hasFile('photo')) {
            if ($utilisateur->photo) {
                Storage::disk('public')->delete($utilisateur->photo);
            }

            $data['photo'] = $request->file('photo')->store('utilisateurs', 'public');
        }

        $utilisateur->update($data);

        // synchronisation des rôles
        if (isset($data['roles'])) {
            $utilisateur->roles()->sync($data['roles']);
        }

        return back()->with('success', 'Utilisateur mis à jour.');
    }

    /*
    |--------------------------------------------------------------------------
    | ACTIONS STATUT
    |--------------------------------------------------------------------------
    */

    public function activer(User $utilisateur)
    {
        $utilisateur->update([
            'est_actif' => true,
            'statut_compte' => 'actif',
        ]);

        return back()->with('success', 'Utilisateur activé.');
    }

    public function desactiver(User $utilisateur)
    {
        $utilisateur->update([
            'est_actif' => false,
            'statut_compte' => 'inactif',
        ]);

        return back()->with('success', 'Utilisateur désactivé.');
    }

    public function suspendre(User $utilisateur)
    {
        $utilisateur->update([
            'statut_compte' => 'suspendu',
            'est_actif' => false,
        ]);

        return back()->with('warning', 'Utilisateur suspendu.');
    }

    public function retablir(User $utilisateur)
    {
        $utilisateur->update([
            'statut_compte' => 'actif',
            'est_actif' => true,
        ]);

        return back()->with('success', 'Compte rétabli.');
    }

    /*
    |--------------------------------------------------------------------------
    | ACTIONS AVANCÉES
    |--------------------------------------------------------------------------
    */

    public function details(User $utilisateur)
    {
        $utilisateur->load('roles');

        return view('back.utilisateurs.utilisateurs.details', compact('utilisateur'));
    }

    public function changerRoles(User $utilisateur)
    {
        $roles = Role::all();

        return view('back.utilisateurs.utilisateurs.roles', compact('utilisateur', 'roles'));
    }

    public function synchroniserRoles(EnregistrerUtilisateurRequest $request, User $utilisateur)
    {
        $utilisateur->roles()->sync($request->roles);

        return back()->with('success', 'Rôles mis à jour.');
    }

    public function supprimer(User $utilisateur)
    {
        // sécurité : empêcher suppression admin principal
        if ($utilisateur->estAdministrateur()) {
            return back()->with('error', 'Impossible de supprimer un administrateur.');
        }

        if ($utilisateur->photo) {
            Storage::disk('public')->delete($utilisateur->photo);
        }

        $utilisateur->roles()->detach();
        $utilisateur->delete();

        return redirect()->route('back.utilisateurs.tous')
            ->with('success', 'Utilisateur supprimé.');
    }
}
