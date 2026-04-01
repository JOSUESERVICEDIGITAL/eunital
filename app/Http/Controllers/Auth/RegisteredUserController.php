<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Afficher le formulaire d'inscription
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Traiter l'inscription
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Création utilisateur
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password, // hash automatique via casts()
            'statut_compte' => 'actif',
            'est_actif' => true,
        ]);

        // Attribution du rôle par défaut (auteur)
       $user->assignRole('auteur');

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('back.dashboard');
    }
}
