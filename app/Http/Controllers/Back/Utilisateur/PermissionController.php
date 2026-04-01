<?php

namespace App\Http\Controllers\Back\Utilisateur;

use App\Models\Permission;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\EnregistrerPermissionRequest;
use App\Http\Requests\ModifierPermissionRequest;

class PermissionController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LISTES
    |--------------------------------------------------------------------------
    */

    public function listeToutes()
    {
        $permissions = Permission::withCount('roles')
            ->orderBy('groupe')
            ->orderBy('nom')
            ->paginate(20);

        return view('back.utilisateurs.permissions.liste', compact('permissions'));
    }

    public function listeParGroupe(string $groupe)
    {
        $permissions = Permission::withCount('roles')
            ->where('groupe', $groupe)
            ->orderBy('nom')
            ->paginate(20);

        return view('back.utilisateurs.permissions.par-groupe', compact('permissions', 'groupe'));
    }

    /*
    |--------------------------------------------------------------------------
    | FORMULAIRES
    |--------------------------------------------------------------------------
    */

    public function formulaireCreation()
    {
        $groupes = Permission::query()
            ->whereNotNull('groupe')
            ->distinct()
            ->orderBy('groupe')
            ->pluck('groupe');

        return view('back.utilisateurs.permissions.creer', compact('groupes'));
    }

    public function formulaireEdition(Permission $permission)
    {
        $groupes = Permission::query()
            ->whereNotNull('groupe')
            ->distinct()
            ->orderBy('groupe')
            ->pluck('groupe');

        return view('back.utilisateurs.permissions.modifier', compact('permission', 'groupes'));
    }

    /*
    |--------------------------------------------------------------------------
    | ACTIONS PRINCIPALES
    |--------------------------------------------------------------------------
    */

    public function enregistrer(EnregistrerPermissionRequest $request)
    {
        $donnees = $request->validated();

        $slugDeBase = Str::slug($donnees['nom']);
        $slugFinal = $slugDeBase;
        $compteur = 1;

        while (Permission::where('slug', $slugFinal)->exists()) {
            $slugFinal = $slugDeBase . '-' . $compteur;
            $compteur++;
        }

        $permission = Permission::create([
            'nom' => $donnees['nom'],
            'slug' => $slugFinal,
            'groupe' => $donnees['groupe'] ?? null,
            'description' => $donnees['description'] ?? null,
        ]);

        return redirect()
            ->route('back.permissions.details', $permission)
            ->with('success', 'Permission créée avec succès.');
    }

    public function details(Permission $permission)
    {
        $permission->load('roles');

        return view('back.utilisateurs.permissions.details', compact('permission'));
    }

    public function mettreAJour(ModifierPermissionRequest $request, Permission $permission)
    {
        $donnees = $request->validated();

        $slugFinal = $permission->slug;

        if ($permission->nom !== $donnees['nom']) {
            $slugDeBase = Str::slug($donnees['nom']);
            $slugFinal = $slugDeBase;
            $compteur = 1;

            while (
                Permission::where('slug', $slugFinal)
                    ->where('id', '!=', $permission->id)
                    ->exists()
            ) {
                $slugFinal = $slugDeBase . '-' . $compteur;
                $compteur++;
            }
        }

        $permission->update([
            'nom' => $donnees['nom'],
            'slug' => $slugFinal,
            'groupe' => $donnees['groupe'] ?? null,
            'description' => $donnees['description'] ?? null,
        ]);

        return back()->with('success', 'Permission mise à jour avec succès.');
    }

    /*
    |--------------------------------------------------------------------------
    | SUPPRESSION
    |--------------------------------------------------------------------------
    */

    public function supprimer(Permission $permission)
    {
        if ($permission->roles()->count() > 0) {
            return back()->with('error', 'Impossible de supprimer cette permission car elle est encore attribuée à un ou plusieurs rôles.');
        }

        $permission->delete();

        return redirect()
            ->route('back.permissions.toutes')
            ->with('success', 'Permission supprimée avec succès.');
    }
}
