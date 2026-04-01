<?php

namespace App\Http\Controllers\Back\Utilisateur;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\EnregistrerRoleRequest;
use App\Http\Requests\ModifierRoleRequest;
use App\Http\Requests\AttribuerPermissionsRoleRequest;

class RoleController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LISTES
    |--------------------------------------------------------------------------
    */

    public function listeTous()
    {
        $roles = Role::withCount(['utilisateurs', 'permissions'])
            ->latest()
            ->paginate(12);

        return view('back.utilisateurs.roles.liste', compact('roles'));
    }

    public function listeActifs()
    {
        $roles = Role::withCount(['utilisateurs', 'permissions'])
            ->where('est_actif', true)
            ->latest()
            ->paginate(12);

        return view('back.utilisateurs.roles.actifs', compact('roles'));
    }

    public function listeInactifs()
    {
        $roles = Role::withCount(['utilisateurs', 'permissions'])
            ->where('est_actif', false)
            ->latest()
            ->paginate(12);

        return view('back.utilisateurs.roles.inactifs', compact('roles'));
    }

    /*
    |--------------------------------------------------------------------------
    | FORMULAIRES
    |--------------------------------------------------------------------------
    */

    public function formulaireCreation()
    {
        return view('back.utilisateurs.roles.creer');
    }

    public function formulaireEdition(Role $role)
    {
        return view('back.utilisateurs.roles.modifier', compact('role'));
    }

    public function formulairePermissions(Role $role)
    {
        $permissions = Permission::orderBy('groupe')->orderBy('nom')->get();
        $role->load('permissions');

        return view('back.utilisateurs.roles.permissions', compact('role', 'permissions'));
    }

    /*
    |--------------------------------------------------------------------------
    | ACTIONS PRINCIPALES
    |--------------------------------------------------------------------------
    */

    public function enregistrer(EnregistrerRoleRequest $request)
    {
        $donnees = $request->validated();

        $slugDeBase = Str::slug($donnees['nom']);
        $slugFinal = $slugDeBase;
        $compteur = 1;

        while (Role::where('slug', $slugFinal)->exists()) {
            $slugFinal = $slugDeBase . '-' . $compteur;
            $compteur++;
        }

        $role = Role::create([
            'nom' => $donnees['nom'],
            'slug' => $slugFinal,
            'description' => $donnees['description'] ?? null,
            'est_actif' => $request->boolean('est_actif', true),
        ]);

        return redirect()
            ->route('back.roles.details', $role)
            ->with('success', 'Rôle créé avec succès.');
    }

    public function details(Role $role)
    {
        $role->load(['permissions', 'utilisateurs']);

        return view('back.utilisateurs.roles.details', compact('role'));
    }

    public function mettreAJour(ModifierRoleRequest $request, Role $role)
    {
        $donnees = $request->validated();

        $slugFinal = $role->slug;

        if ($role->nom !== $donnees['nom']) {
            $slugDeBase = Str::slug($donnees['nom']);
            $slugFinal = $slugDeBase;
            $compteur = 1;

            while (
                Role::where('slug', $slugFinal)
                    ->where('id', '!=', $role->id)
                    ->exists()
            ) {
                $slugFinal = $slugDeBase . '-' . $compteur;
                $compteur++;
            }
        }

        $role->update([
            'nom' => $donnees['nom'],
            'slug' => $slugFinal,
            'description' => $donnees['description'] ?? null,
            'est_actif' => $request->boolean('est_actif', false),
        ]);

        return back()->with('success', 'Rôle mis à jour avec succès.');
    }

    /*
    |--------------------------------------------------------------------------
    | STATUTS
    |--------------------------------------------------------------------------
    */

    public function activer(Role $role)
    {
        $role->update([
            'est_actif' => true,
        ]);

        return back()->with('success', 'Rôle activé avec succès.');
    }

    public function desactiver(Role $role)
    {
        $role->update([
            'est_actif' => false,
        ]);

        return back()->with('success', 'Rôle désactivé avec succès.');
    }

    /*
    |--------------------------------------------------------------------------
    | PERMISSIONS
    |--------------------------------------------------------------------------
    */

    public function attribuerPermissions(AttribuerPermissionsRoleRequest $request, Role $role)
    {
        $role->permissions()->sync($request->permissions);

        return back()->with('success', 'Les permissions du rôle ont été mises à jour.');
    }

    public function retirerPermission(Role $role, Permission $permission)
    {
        $role->permissions()->detach($permission->id);

        return back()->with('success', 'Permission retirée du rôle avec succès.');
    }

    /*
    |--------------------------------------------------------------------------
    | SUPPRESSION
    |--------------------------------------------------------------------------
    */

    public function supprimer(Role $role)
    {
        if (in_array($role->slug, ['administrateur', 'auteur', 'responsable'])) {
            return back()->with('error', 'Impossible de supprimer un rôle système principal.');
        }

        if ($role->utilisateurs()->count() > 0) {
            return back()->with('error', 'Impossible de supprimer ce rôle car il est encore attribué à des utilisateurs.');
        }

        $role->permissions()->detach();
        $role->delete();

        return redirect()
            ->route('back.roles.tous')
            ->with('success', 'Rôle supprimé avec succès.');
    }
}