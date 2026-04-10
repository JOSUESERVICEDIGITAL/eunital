<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
        ]);

        // Configurer la taille maximale des requêtes via le groupe web
        $middleware->web(append: [
            \App\Http\Middleware\ValidatePostSizeCustom::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (Illuminate\Http\Exceptions\PostTooLargeException $e, $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'error' => 'Le fichier est trop volumineux. Taille maximale: 1000 Mo'
                ], 413);
            }

            return back()->with('error', 'Le fichier est trop volumineux. Taille maximale: 1000 Mo');
        });
    })->create();
