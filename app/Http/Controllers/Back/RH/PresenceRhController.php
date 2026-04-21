<?php

namespace App\Http\Controllers\Back\RH;

use App\Http\Controllers\Controller;
use App\Http\Requests\RH\PresenceRhRequest;
use App\Models\Departement;
use App\Models\MembreEquipe;
use App\Models\RH\PresenceRh;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PresenceRhController extends Controller
{
    public function index(Request $request): View
    {
        $query = PresenceRh::query()
            ->with([
                'membreEquipe.departement',
                'membreEquipe.poste',
            ]);

        if ($request->filled('search')) {
            $search = trim((string) $request->input('search'));

            $query->where(function ($q) use ($search) {
                $q->where('observation', 'like', "%{$search}%")
                    ->orWhereHas('membreEquipe', function ($subQ) use ($search) {
                        $subQ->where('nom', 'like', "%{$search}%")
                            ->orWhere('prenom', 'like', "%{$search}%")
                            ->orWhere('email_professionnel', 'like', "%{$search}%")
                            ->orWhere('telephone', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('membre_equipe_id')) {
            $query->where('membre_equipe_id', $request->integer('membre_equipe_id'));
        }

        if ($request->filled('departement_id')) {
            $departementId = $request->integer('departement_id');

            $query->whereHas('membreEquipe', function ($q) use ($departementId) {
                $q->where('departement_id', $departementId);
            });
        }

        if ($request->filled('statut')) {
            $query->where('statut', $request->input('statut'));
        }

        if ($request->filled('date_presence_debut')) {
            $query->whereDate('date_presence', '>=', $request->input('date_presence_debut'));
        }

        if ($request->filled('date_presence_fin')) {
            $query->whereDate('date_presence', '<=', $request->input('date_presence_fin'));
        }

        $presences = $query
            ->latest('date_presence')
            ->latest('created_at')
            ->paginate(20)
            ->withQueryString();

        return view('back.rh.presences.index', [
            'pageTitle' => 'Présences RH',
            'presences' => $presences,
            'membres' => MembreEquipe::orderBy('nom')->orderBy('prenom')->get(),
            'departements' => Departement::orderBy('nom')->get(),
            'statuts' => $this->statuts(),
            'filters' => $request->all(),
        ]);
    }

    public function show(PresenceRh $presenceRh): View
    {
        $presenceRh->load([
            'membreEquipe.departement',
            'membreEquipe.poste',
        ]);

        return view('back.rh.presences.show', [
            'pageTitle' => 'Détail de la présence',
            'presence' => $presenceRh,
        ]);
    }

    public function create(): View
    {
        return view('back.rh.presences.create', [
            'pageTitle' => 'Nouvelle présence',
            'membres' => MembreEquipe::orderBy('nom')->orderBy('prenom')->get(),
            'statuts' => $this->statuts(),
        ]);
    }

    public function store(PresenceRhRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $presenceExistante = PresenceRh::where('membre_equipe_id', $data['membre_equipe_id'])
            ->whereDate('date_presence', $data['date_presence'])
            ->first();

        if ($presenceExistante) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Une présence existe déjà pour cet employé à cette date.');
        }

        $presence = PresenceRh::create($data);

        return redirect()
            ->route('rh.presences.show', $presence)
            ->with('success', 'La présence a été créée avec succès.');
    }

    public function edit(PresenceRh $presenceRh): View
    {
        return view('back.rh.presences.edit', [
            'pageTitle' => 'Modifier la présence',
            'presence' => $presenceRh->load('membreEquipe'),
            'membres' => MembreEquipe::orderBy('nom')->orderBy('prenom')->get(),
            'statuts' => $this->statuts(),
        ]);
    }

    public function update(PresenceRhRequest $request, PresenceRh $presenceRh): RedirectResponse
    {
        $data = $request->validated();

        $presenceExistante = PresenceRh::where('membre_equipe_id', $data['membre_equipe_id'])
            ->whereDate('date_presence', $data['date_presence'])
            ->where('id', '!=', $presenceRh->id)
            ->first();

        if ($presenceExistante) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Une autre présence existe déjà pour cet employé à cette date.');
        }

        $presenceRh->update($data);

        return redirect()
            ->route('rh.presences.show', $presenceRh)
            ->with('success', 'La présence a été mise à jour avec succès.');
    }

    public function destroy(PresenceRh $presenceRh): RedirectResponse
    {
        $presenceRh->delete();

        return redirect()
            ->route('rh.presences.index')
            ->with('success', 'La présence a été supprimée avec succès.');
    }

    public function journalier(Request $request): View
    {
        $date = $request->filled('date')
            ? Carbon::parse($request->input('date'))
            : Carbon::today();

        $presences = PresenceRh::with([
                'membreEquipe.departement',
                'membreEquipe.poste',
            ])
            ->whereDate('date_presence', $date->toDateString())
            ->orderBy('statut')
            ->orderBy('heure_arrivee')
            ->paginate(30)
            ->withQueryString();

        $stats = [
            'total' => PresenceRh::whereDate('date_presence', $date)->count(),
            'present' => PresenceRh::whereDate('date_presence', $date)->where('statut', 'present')->count(),
            'absent' => PresenceRh::whereDate('date_presence', $date)->where('statut', 'absent')->count(),
            'retard' => PresenceRh::whereDate('date_presence', $date)->where('statut', 'retard')->count(),
            'mission' => PresenceRh::whereDate('date_presence', $date)->where('statut', 'mission')->count(),
            'teletravail' => PresenceRh::whereDate('date_presence', $date)->where('statut', 'teletravail')->count(),
            'conge' => PresenceRh::whereDate('date_presence', $date)->where('statut', 'conge')->count(),
        ];

        return view('back.rh.presences.journalier', [
            'pageTitle' => 'Présences journalières',
            'dateReference' => $date,
            'presences' => $presences,
            'stats' => $stats,
        ]);
    }

    public function hebdomadaire(Request $request): View
    {
        $date = $request->filled('date')
            ? Carbon::parse($request->input('date'))
            : Carbon::today();

        $debutSemaine = $date->copy()->startOfWeek();
        $finSemaine = $date->copy()->endOfWeek();

        $presences = PresenceRh::with([
                'membreEquipe.departement',
                'membreEquipe.poste',
            ])
            ->whereBetween('date_presence', [$debutSemaine->toDateString(), $finSemaine->toDateString()])
            ->orderBy('date_presence')
            ->orderBy('heure_arrivee')
            ->paginate(50)
            ->withQueryString();

        $statsParStatut = PresenceRh::whereBetween('date_presence', [$debutSemaine->toDateString(), $finSemaine->toDateString()])
            ->selectRaw('statut, COUNT(*) as total')
            ->groupBy('statut')
            ->pluck('total', 'statut');

        return view('back.rh.presences.hebdomadaire', [
            'pageTitle' => 'Présences hebdomadaires',
            'dateReference' => $date,
            'debutSemaine' => $debutSemaine,
            'finSemaine' => $finSemaine,
            'presences' => $presences,
            'statsParStatut' => $statsParStatut,
        ]);
    }

    public function mensuel(Request $request): View
    {
        $date = $request->filled('mois')
            ? Carbon::parse($request->input('mois') . '-01')
            : Carbon::today()->startOfMonth();

        $debutMois = $date->copy()->startOfMonth();
        $finMois = $date->copy()->endOfMonth();

        $presences = PresenceRh::with([
                'membreEquipe.departement',
                'membreEquipe.poste',
            ])
            ->whereBetween('date_presence', [$debutMois->toDateString(), $finMois->toDateString()])
            ->orderBy('date_presence')
            ->paginate(50)
            ->withQueryString();

        $statsParStatut = PresenceRh::whereBetween('date_presence', [$debutMois->toDateString(), $finMois->toDateString()])
            ->selectRaw('statut, COUNT(*) as total')
            ->groupBy('statut')
            ->pluck('total', 'statut');

        return view('back.rh.presences.mensuel', [
            'pageTitle' => 'Présences mensuelles',
            'dateReference' => $date,
            'debutMois' => $debutMois,
            'finMois' => $finMois,
            'presences' => $presences,
            'statsParStatut' => $statsParStatut,
            'moisPrecedent' => $date->copy()->subMonth()->format('Y-m'),
            'moisSuivant' => $date->copy()->addMonth()->format('Y-m'),
        ]);
    }

    public function retards(Request $request): View
    {
        $query = PresenceRh::with([
                'membreEquipe.departement',
                'membreEquipe.poste',
            ])
            ->where('statut', 'retard');

        if ($request->filled('date_presence_debut')) {
            $query->whereDate('date_presence', '>=', $request->input('date_presence_debut'));
        }

        if ($request->filled('date_presence_fin')) {
            $query->whereDate('date_presence', '<=', $request->input('date_presence_fin'));
        }

        $presences = $query
            ->latest('date_presence')
            ->paginate(20)
            ->withQueryString();

        return view('back.rh.presences.retards', [
            'pageTitle' => 'Retards',
            'presences' => $presences,
        ]);
    }

    public function absences(Request $request): View
    {
        $query = PresenceRh::with([
                'membreEquipe.departement',
                'membreEquipe.poste',
            ])
            ->where('statut', 'absent');

        if ($request->filled('date_presence_debut')) {
            $query->whereDate('date_presence', '>=', $request->input('date_presence_debut'));
        }

        if ($request->filled('date_presence_fin')) {
            $query->whereDate('date_presence', '<=', $request->input('date_presence_fin'));
        }

        $presences = $query
            ->latest('date_presence')
            ->paginate(20)
            ->withQueryString();

        return view('back.rh.presences.absences', [
            'pageTitle' => 'Absences',
            'presences' => $presences,
        ]);
    }

    public function parEmploye(MembreEquipe $membreEquipe, Request $request): View
    {
        $query = PresenceRh::with('membreEquipe')
            ->where('membre_equipe_id', $membreEquipe->id);

        if ($request->filled('statut')) {
            $query->where('statut', $request->input('statut'));
        }

        if ($request->filled('date_presence_debut')) {
            $query->whereDate('date_presence', '>=', $request->input('date_presence_debut'));
        }

        if ($request->filled('date_presence_fin')) {
            $query->whereDate('date_presence', '<=', $request->input('date_presence_fin'));
        }

        $presences = $query
            ->latest('date_presence')
            ->paginate(20)
            ->withQueryString();

        $stats = [
            'total' => PresenceRh::where('membre_equipe_id', $membreEquipe->id)->count(),
            'present' => PresenceRh::where('membre_equipe_id', $membreEquipe->id)->where('statut', 'present')->count(),
            'absent' => PresenceRh::where('membre_equipe_id', $membreEquipe->id)->where('statut', 'absent')->count(),
            'retard' => PresenceRh::where('membre_equipe_id', $membreEquipe->id)->where('statut', 'retard')->count(),
            'teletravail' => PresenceRh::where('membre_equipe_id', $membreEquipe->id)->where('statut', 'teletravail')->count(),
        ];

        return view('back.rh.presences.par-employe', [
            'pageTitle' => 'Présences par employé',
            'membre' => $membreEquipe->load(['departement', 'poste']),
            'presences' => $presences,
            'stats' => $stats,
            'statuts' => $this->statuts(),
        ]);
    }

    public function calendrier(Request $request): View
    {
        $date = $request->filled('mois')
            ? Carbon::parse($request->input('mois') . '-01')
            : Carbon::today()->startOfMonth();

        $debut = $date->copy()->startOfMonth();
        $fin = $date->copy()->endOfMonth();

        $presences = PresenceRh::with([
                'membreEquipe.departement',
                'membreEquipe.poste',
            ])
            ->whereBetween('date_presence', [$debut->toDateString(), $fin->toDateString()])
            ->orderBy('date_presence')
            ->get()
            ->groupBy(fn ($item) => Carbon::parse($item->date_presence)->format('Y-m-d'));

        return view('back.rh.presences.calendrier', [
            'pageTitle' => 'Calendrier des présences',
            'presencesParJour' => $presences,
            'moisCourant' => $date,
            'moisPrecedent' => $date->copy()->subMonth()->format('Y-m'),
            'moisSuivant' => $date->copy()->addMonth()->format('Y-m'),
        ]);
    }

    public function rapport(Request $request): View
    {
        $dateDebut = $request->filled('date_debut')
            ? Carbon::parse($request->input('date_debut'))
            : Carbon::today()->startOfMonth();

        $dateFin = $request->filled('date_fin')
            ? Carbon::parse($request->input('date_fin'))
            : Carbon::today()->endOfMonth();

        $baseQuery = PresenceRh::whereBetween('date_presence', [
            $dateDebut->toDateString(),
            $dateFin->toDateString(),
        ]);

        $stats = [
            'total' => (clone $baseQuery)->count(),
            'present' => (clone $baseQuery)->where('statut', 'present')->count(),
            'absent' => (clone $baseQuery)->where('statut', 'absent')->count(),
            'retard' => (clone $baseQuery)->where('statut', 'retard')->count(),
            'mission' => (clone $baseQuery)->where('statut', 'mission')->count(),
            'teletravail' => (clone $baseQuery)->where('statut', 'teletravail')->count(),
            'conge' => (clone $baseQuery)->where('statut', 'conge')->count(),
        ];

        $statsParDepartement = PresenceRh::query()
            ->join('membres_equipe', 'presences_rh.membre_equipe_id', '=', 'membres_equipe.id')
            ->join('departements', 'membres_equipe.departement_id', '=', 'departements.id')
            ->whereBetween('presences_rh.date_presence', [$dateDebut->toDateString(), $dateFin->toDateString()])
            ->selectRaw('departements.nom as departement, COUNT(presences_rh.id) as total')
            ->groupBy('departements.nom')
            ->orderByDesc('total')
            ->get();

        $tauxPresence = $stats['total'] > 0
            ? round((($stats['present'] + $stats['retard']) / $stats['total']) * 100, 2)
            : 0;

        return view('back.rh.presences.rapport', [
            'pageTitle' => 'Rapport des présences',
            'dateDebut' => $dateDebut,
            'dateFin' => $dateFin,
            'stats' => $stats,
            'statsParDepartement' => $statsParDepartement,
            'tauxPresence' => $tauxPresence,
        ]);
    }

    private function statuts(): array
    {
        return [
            'present' => 'Présent',
            'absent' => 'Absent',
            'retard' => 'Retard',
            'mission' => 'Mission',
            'teletravail' => 'Télétravail',
            'conge' => 'Congé',
        ];
    }
}