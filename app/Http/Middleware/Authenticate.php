<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (! $request->expectsJson()) {
            // Récupérer l'URL de redirection depuis la session
            $intended = session('url.intended');

            if ($intended) {
                // Nettoyer la session après utilisation
                session()->forget('url.intended');
                return $intended;
            }

            return route('login');
        }

        return null;
    }
}
