<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Vérifier si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Vérifier si l'utilisateur est admin (vérification simple)
        // Supposons que vous avez une colonne 'is_admin' dans la table users
        if (!Auth::user()->is_admin) {
            abort(403, 'Accès non autorisé.');
        }

        return $next($request);
    }
}
