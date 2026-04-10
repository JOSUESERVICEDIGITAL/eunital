<?php

namespace App\Http\Controllers\Back\Utilisateur;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttribuerRoleUtilisateurRequest;
use App\Http\Requests\AttribuerPermissionsRoleRequest;

class AttributionRoleController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | RÔLES D'UN UTILISATEUR
    |--------------------------------------------------------------------------
    */

    public function formulaireAttributionUtilisateur(User $utilisateur)
    {
        $roles = Role::where('est_actif', true)
            ->orderBy('name')
            ->get();

        $utilisateur->load('roles');

        return view('back.utilisateurs.attributions.roles-utilisateur', compact('utilisateur', 'roles'));
    }

    public function attribuerRolesUtilisateur(AttribuerRoleUtilisateurRequest $request, User $utilisateur)
    {
        $utilisateur->roles()->sync($request->roles);

        return back()->with('success', 'Les rôles de l’utilisateur ont été mis à jour avec succès.');
    }

    public function retirerRoleUtilisateur(User $utilisateur, Role $role)
    {
        if ($utilisateur->roles()->count() <= 1) {
            return back()->with('error', 'Impossible de retirer le dernier rôle de cet utilisateur.');
        }

        $utilisateur->roles()->detach($role->id);

        return back()->with('success', 'Le rôle a été retiré de l’utilisateur avec succès.');
    }

    /*
    |--------------------------------------------------------------------------
    | PERMISSIONS D'UN RÔLE
    |--------------------------------------------------------------------------
    */

    public function formulairePermissionsRole(Role $role)
    {
        $permissions = Permission::orderBy('groupe')
            ->orderBy('nom')
            ->get();

        $role->load('permissions');

        return view('back.utilisateurs.attributions.permissions-role', compact('role', 'permissions'));
    }

    public function attribuerPermissionsRole(AttribuerPermissionsRoleRequest $request, Role $role)
    {
        $role->permissions()->sync($request->permissions);

        return back()->with('success', 'Les permissions du rôle ont été mises à jour avec succès.');
    }

    public function retirerPermissionRole(Role $role, Permission $permission)
    {
        $role->permissions()->detach($permission->id);

        return back()->with('success', 'La permission a été retirée du rôle avec succès.');
    }
}
