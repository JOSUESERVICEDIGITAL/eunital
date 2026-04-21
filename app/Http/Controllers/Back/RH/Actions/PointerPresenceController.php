<?php

namespace App\Http\Controllers\Back\RH\Actions;

use App\Http\Controllers\Controller;
use App\Models\RH\PresenceRh;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PointerPresenceController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'membre_equipe_id' => ['required', 'exists:membres_equipe,id'],
            'date_presence' => ['nullable', 'date'],
            'heure_arrivee' => ['nullable', 'date_format:H:i'],
            'heure_depart' => ['nullable', 'date_format:H:i', 'after:heure_arrivee'],
            'statut' => ['required', Rule::in(['present', 'absent', 'retard', 'mission', 'teletravail', 'conge'])],
            'observation' => ['nullable', 'string'],
        ]);

        $datePresence = $data['date_presence'] ?? Carbon::today()->toDateString();

        $presence = PresenceRh::where('membre_equipe_id', $data['membre_equipe_id'])
            ->whereDate('date_presence', $datePresence)
            ->first();

        if ($presence) {
            $presence->update([
                'heure_arrivee' => $data['heure_arrivee'] ?? $presence->heure_arrivee,
                'heure_depart' => $data['heure_depart'] ?? $presence->heure_depart,
                'statut' => $data['statut'],
                'observation' => $data['observation'] ?? $presence->observation,
            ]);

            return redirect()
                ->back()
                ->with('success', 'Le pointage a été mis à jour avec succès.');
        }

        PresenceRh::create([
            'membre_equipe_id' => $data['membre_equipe_id'],
            'date_presence' => $datePresence,
            'heure_arrivee' => $data['heure_arrivee'] ?? null,
            'heure_depart' => $data['heure_depart'] ?? null,
            'statut' => $data['statut'],
            'observation' => $data['observation'] ?? null,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Le pointage a été enregistré avec succès.');
    }
}