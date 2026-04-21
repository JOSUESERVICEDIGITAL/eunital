<?php

namespace App\Http\Controllers\Back\RH;

use App\Http\Controllers\Controller;
use App\Http\Requests\RH\CongeRhRequest;
use App\Models\Departement;
use App\Models\MembreEquipe;
use App\Models\RH\CongeRh;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CongeRhController extends Controller
{
    public function index(Request $request): View
    {
        $query = CongeRh::query()
            ->with([
                'membreEquipe.departement',
                'validateur',
            ]);

        if ($request->filled('search')) {
            $search = trim((string) $request->input('search'));

            $query->where(function ($q) use ($search) {
                $q->where('motif', 'like', "%{$search}%")
                    ->orWhereHas('membreEquipe', function ($subQ) use ($search) {
                        $subQ->where('nom', 'like', "%{$search}%")
                            ->orWhere('prenom', 'like', "%{$search}%")
                            ->orWhere('email_professionnel', 'like', "%{$search}%");
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

        if ($request->filled('type_conge')) {
            $query->where('type_conge', $request->input('type_conge'));
        }

        if ($request->filled('statut')) {
            $query->where('statut', $request->input('statut'));
        }

        if ($request->filled('date_debut')) {
            $query->whereDate('date_debut', '>=', $request->input('date_debut'));
        }

        if ($request->filled('date_fin')) {
            $query->whereDate('date_fin', '<=', $request->input('date_fin'));
        }

        $conges = $query
            ->latest('date_debut')
            ->paginate(15)
            ->withQueryString();

        return view('back.rh.conges.index', [
            'pageTitle' => 'Congés RH',
            'conges' => $conges,
            'membres' => MembreEquipe::orderBy('nom')->orderBy('prenom')->get(),
            'departements' => Departement::orderBy('nom')->get(),
            'typesConge' => $this->typesConge(),
            'statuts' => $this->statuts(),
            'filters' => $request->all(),
        ]);
    }

    public function create(): View
    {
        return view('back.rh.conges.create', [
            'pageTitle' => 'Nouvelle demande de congé',
            'membres' => MembreEquipe::orderBy('nom')->orderBy('prenom')->get(),
            'validateurs' => User::orderBy('name')->get(),
            'typesConge' => $this->typesConge(),
            'statuts' => $this->statuts(),
        ]);
    }

    public function store(CongeRhRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if (empty($data['nombre_jours']) && !empty($data['date_debut']) && !empty($data['date_fin'])) {
            $data['nombre_jours'] = Carbon::parse($data['date_debut'])
                ->diffInDays(Carbon::parse($data['date_fin'])) + 1;
        }

        $conge = CongeRh::create($data);

        return redirect()
            ->route('rh.conges.show', $conge)
            ->with('success', 'La demande de congé a été créée avec succès.');
    }

    public function show(CongeRh $congeRh): View
    {
        $congeRh->load([
            'membreEquipe.departement',
            'validateur',
        ]);

        return view('back.rh.conges.show', [
            'pageTitle' => 'Détail du congé',
            'conge' => $congeRh,
        ]);
    }

    public function edit(CongeRh $congeRh): View
    {
        return view('back.rh.conges.edit', [
            'pageTitle' => 'Modifier le congé',
            'conge' => $congeRh->load(['membreEquipe', 'validateur']),
            'membres' => MembreEquipe::orderBy('nom')->orderBy('prenom')->get(),
            'validateurs' => User::orderBy('name')->get(),
            'typesConge' => $this->typesConge(),
            'statuts' => $this->statuts(),
        ]);
    }

    public function update(CongeRhRequest $request, CongeRh $congeRh): RedirectResponse
    {
        $data = $request->validated();

        if (
            (
                isset($data['date_debut']) ||
                isset($data['date_fin'])
            ) &&
            !isset($data['nombre_jours'])
        ) {
            $dateDebut = $data['date_debut'] ?? $congeRh->date_debut?->toDateString();
            $dateFin = $data['date_fin'] ?? $congeRh->date_fin?->toDateString();

            if ($dateDebut && $dateFin) {
                $data['nombre_jours'] = Carbon::parse($dateDebut)
                    ->diffInDays(Carbon::parse($dateFin)) + 1;
            }
        }

        $congeRh->update($data);

        return redirect()
            ->route('rh.conges.show', $congeRh)
            ->with('success', 'Le congé a été mis à jour avec succès.');
    }

    public function destroy(CongeRh $congeRh): RedirectResponse
    {
        $congeRh->delete();

        return redirect()
            ->route('rh.conges.index')
            ->with('success', 'Le congé a été supprimé avec succès.');
    }

    public function enAttente(Request $request): View
    {
        $conges = CongeRh::with(['membreEquipe.departement', 'validateur'])
            ->where('statut', 'en_attente')
            ->latest('date_debut')
            ->paginate(15)
            ->withQueryString();

        return view('back.rh.conges.en-attente', [
            'pageTitle' => 'Congés en attente',
            'conges' => $conges,
        ]);
    }

    public function valides(Request $request): View
    {
        $conges = CongeRh::with(['membreEquipe.departement', 'validateur'])
            ->where('statut', 'valide')
            ->latest('date_debut')
            ->paginate(15)
            ->withQueryString();

        return view('back.rh.conges.valides', [
            'pageTitle' => 'Congés validés',
            'conges' => $conges,
        ]);
    }

    public function refuses(Request $request): View
    {
        $conges = CongeRh::with(['membreEquipe.departement', 'validateur'])
            ->where('statut', 'refuse')
            ->latest('date_debut')
            ->paginate(15)
            ->withQueryString();

        return view('back.rh.conges.refuses', [
            'pageTitle' => 'Congés refusés',
            'conges' => $conges,
        ]);
    }

    public function annules(Request $request): View
    {
        $conges = CongeRh::with(['membreEquipe.departement', 'validateur'])
            ->where('statut', 'annule')
            ->latest('date_debut')
            ->paginate(15)
            ->withQueryString();

        return view('back.rh.conges.annules', [
            'pageTitle' => 'Congés annulés',
            'conges' => $conges,
        ]);
    }

    public function parEmploye(MembreEquipe $membreEquipe): View
    {
        $conges = CongeRh::with(['validateur'])
            ->where('membre_equipe_id', $membreEquipe->id)
            ->latest('date_debut')
            ->paginate(15)
            ->withQueryString();

        return view('back.rh.conges.par-employe', [
            'pageTitle' => 'Congés par employé',
            'membre' => $membreEquipe->load('departement'),
            'conges' => $conges,
        ]);
    }

    public function calendrier(Request $request): View
    {
        $dateReference = $request->filled('mois')
            ? Carbon::parse($request->input('mois') . '-01')
            : Carbon::today()->startOfMonth();

        $debut = $dateReference->copy()->startOfMonth();
        $fin = $dateReference->copy()->endOfMonth();

        $conges = CongeRh::with(['membreEquipe.departement'])
            ->where(function ($q) use ($debut, $fin) {
                $q->whereBetween('date_debut', [$debut->toDateString(), $fin->toDateString()])
                    ->orWhereBetween('date_fin', [$debut->toDateString(), $fin->toDateString()])
                    ->orWhere(function ($subQ) use ($debut, $fin) {
                        $subQ->whereDate('date_debut', '<=', $debut->toDateString())
                            ->whereDate('date_fin', '>=', $fin->toDateString());
                    });
            })
            ->orderBy('date_debut')
            ->get();

        return view('back.rh.conges.calendrier', [
            'pageTitle' => 'Calendrier des congés',
            'conges' => $conges,
            'moisCourant' => $dateReference,
            'moisPrecedent' => $dateReference->copy()->subMonth()->format('Y-m'),
            'moisSuivant' => $dateReference->copy()->addMonth()->format('Y-m'),
        ]);
    }

    public function solde(Request $request, ?MembreEquipe $membreEquipe = null): View
    {
        if ($membreEquipe) {
            $conges = CongeRh::where('membre_equipe_id', $membreEquipe->id)
                ->where('statut', 'valide')
                ->get();

            $joursPris = $conges->sum(function ($conge) {
                return $conge->nombre_jours ?? (
                    $conge->date_debut && $conge->date_fin
                        ? Carbon::parse($conge->date_debut)->diffInDays(Carbon::parse($conge->date_fin)) + 1
                        : 0
                );
            });

            $soldeInitial = 30;
            $soldeRestant = max($soldeInitial - $joursPris, 0);

            return view('back.rh.conges.solde-employe', [
                'pageTitle' => 'Solde de congés',
                'membre' => $membreEquipe->load('departement'),
                'joursPris' => $joursPris,
                'soldeInitial' => $soldeInitial,
                'soldeRestant' => $soldeRestant,
                'conges' => $conges,
            ]);
        }

        $membres = MembreEquipe::with('departement')
            ->orderBy('nom')
            ->orderBy('prenom')
            ->get();

        $soldes = $membres->map(function ($membre) {
            $conges = CongeRh::where('membre_equipe_id', $membre->id)
                ->where('statut', 'valide')
                ->get();

            $joursPris = $conges->sum(function ($conge) {
                return $conge->nombre_jours ?? (
                    $conge->date_debut && $conge->date_fin
                        ? Carbon::parse($conge->date_debut)->diffInDays(Carbon::parse($conge->date_fin)) + 1
                        : 0
                );
            });

            $soldeInitial = 30;
            $soldeRestant = max($soldeInitial - $joursPris, 0);

            return [
                'membre' => $membre,
                'jours_pris' => $joursPris,
                'solde_initial' => $soldeInitial,
                'solde_restant' => $soldeRestant,
            ];
        });

        return view('back.rh.conges.solde-global', [
            'pageTitle' => 'Soldes de congés',
            'soldes' => $soldes,
        ]);
    }

    public function historique(Request $request): View
    {
        $query = CongeRh::query()
            ->with(['membreEquipe.departement', 'validateur'])
            ->latest('updated_at');

        if ($request->filled('membre_equipe_id')) {
            $query->where('membre_equipe_id', $request->integer('membre_equipe_id'));
        }

        if ($request->filled('statut')) {
            $query->where('statut', $request->input('statut'));
        }

        $conges = $query
            ->paginate(20)
            ->withQueryString();

        return view('back.rh.conges.historique', [
            'pageTitle' => 'Historique des congés',
            'conges' => $conges,
            'membres' => MembreEquipe::orderBy('nom')->orderBy('prenom')->get(),
            'statuts' => $this->statuts(),
        ]);
    }

    private function typesConge(): array
    {
        return [
            'annuel' => 'Congé annuel',
            'maladie' => 'Congé maladie',
            'maternite' => 'Congé maternité',
            'paternite' => 'Congé paternité',
            'exceptionnel' => 'Congé exceptionnel',
            'sans_solde' => 'Congé sans solde',
        ];
    }

    private function statuts(): array
    {
        return [
            'en_attente' => 'En attente',
            'valide' => 'Validé',
            'refuse' => 'Refusé',
            'annule' => 'Annulé',
        ];
    }
}