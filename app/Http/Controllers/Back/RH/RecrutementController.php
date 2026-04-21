<?php

namespace App\Http\Controllers\Back\RH;

use App\Http\Controllers\Controller;
use App\Http\Requests\RH\RecrutementRequest;
use App\Models\Departement;
use App\Models\Poste;
use App\Models\RH\Candidature;
use App\Models\RH\Recrutement;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RecrutementController extends Controller
{
    public function index(Request $request): View
    {
        $query = Recrutement::query()
            ->with([
                'departement',
                'poste',
                'responsable',
            ])
            ->withCount([
                'candidatures',
                'candidatures as candidatures_recues_count' => function ($q) {
                    $q->where('statut', 'recu');
                },
                'candidatures as candidatures_en_etude_count' => function ($q) {
                    $q->where('statut', 'en_etude');
                },
                'candidatures as candidatures_entretien_count' => function ($q) {
                    $q->where('statut', 'entretien');
                },
                'candidatures as candidatures_retenues_count' => function ($q) {
                    $q->where('statut', 'retenu');
                },
                'candidatures as candidatures_rejetees_count' => function ($q) {
                    $q->where('statut', 'rejete');
                },
            ]);

        if ($request->filled('search')) {
            $search = trim((string) $request->input('search'));

            $query->where(function ($q) use ($search) {
                $q->where('titre', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhereHas('departement', function ($subQ) use ($search) {
                        $subQ->where('nom', 'like', "%{$search}%");
                    })
                    ->orWhereHas('poste', function ($subQ) use ($search) {
                        $subQ->where('nom', 'like', "%{$search}%");
                    })
                    ->orWhereHas('responsable', function ($subQ) use ($search) {
                        $subQ->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('departement_id')) {
            $query->where('departement_id', $request->integer('departement_id'));
        }

        if ($request->filled('poste_id')) {
            $query->where('poste_id', $request->integer('poste_id'));
        }

        if ($request->filled('responsable_id')) {
            $query->where('responsable_id', $request->integer('responsable_id'));
        }

        if ($request->filled('type_contrat')) {
            $query->where('type_contrat', $request->input('type_contrat'));
        }

        if ($request->filled('statut')) {
            $query->where('statut', $request->input('statut'));
        }

        if ($request->filled('date_ouverture_debut')) {
            $query->whereDate('date_ouverture', '>=', $request->input('date_ouverture_debut'));
        }

        if ($request->filled('date_ouverture_fin')) {
            $query->whereDate('date_ouverture', '<=', $request->input('date_ouverture_fin'));
        }

        $recrutements = $query
            ->latest('created_at')
            ->paginate(15)
            ->withQueryString();

        return view('back.rh.recrutements.index', [
            'pageTitle' => 'Recrutements',
            'recrutements' => $recrutements,
            'departements' => Departement::orderBy('nom')->get(),
            'postes' => Poste::orderBy('nom')->get(),
            'responsables' => User::orderBy('name')->get(),
            'typesContrat' => $this->typesContrat(),
            'statuts' => $this->statuts(),
            'filters' => $request->all(),
        ]);
    }

    public function create(): View
    {
        return view('back.rh.recrutements.create', [
            'pageTitle' => 'Créer un recrutement',
            'departements' => Departement::orderBy('nom')->get(),
            'postes' => Poste::orderBy('nom')->get(),
            'responsables' => User::orderBy('name')->get(),
            'typesContrat' => $this->typesContrat(),
            'statuts' => $this->statuts(),
        ]);
    }

    public function store(RecrutementRequest $request): RedirectResponse
    {
        $recrutement = Recrutement::create($request->validated());

        return redirect()
            ->route('rh.recrutements.show', $recrutement)
            ->with('success', 'Le recrutement a été créé avec succès.');
    }

    public function show(Recrutement $recrutement): View
    {
        $recrutement->load([
            'departement',
            'poste',
            'responsable',
            'candidatures' => function ($q) {
                $q->latest();
            },
        ]);

        $stats = $this->buildPipelineStats($recrutement);

        return view('back.rh.recrutements.show', [
            'pageTitle' => 'Détail du recrutement',
            'recrutement' => $recrutement,
            'stats' => $stats,
        ]);
    }

    public function edit(Recrutement $recrutement): View
    {
        return view('back.rh.recrutements.edit', [
            'pageTitle' => 'Modifier le recrutement',
            'recrutement' => $recrutement,
            'departements' => Departement::orderBy('nom')->get(),
            'postes' => Poste::orderBy('nom')->get(),
            'responsables' => User::orderBy('name')->get(),
            'typesContrat' => $this->typesContrat(),
            'statuts' => $this->statuts(),
        ]);
    }

    public function update(RecrutementRequest $request, Recrutement $recrutement): RedirectResponse
    {
        $recrutement->update($request->validated());

        return redirect()
            ->route('rh.recrutements.show', $recrutement)
            ->with('success', 'Le recrutement a été mis à jour avec succès.');
    }

    public function destroy(Recrutement $recrutement): RedirectResponse
    {
        $recrutement->delete();

        return redirect()
            ->route('rh.recrutements.index')
            ->with('success', 'Le recrutement a été supprimé avec succès.');
    }

    public function ouvertes(Request $request): View
    {
        $recrutements = Recrutement::with(['departement', 'poste', 'responsable'])
            ->withCount('candidatures')
            ->where('statut', 'ouvert')
            ->latest('date_ouverture')
            ->paginate(15)
            ->withQueryString();

        return view('back.rh.recrutements.ouvertes', [
            'pageTitle' => 'Recrutements ouverts',
            'recrutements' => $recrutements,
        ]);
    }

    public function fermees(Request $request): View
    {
        $recrutements = Recrutement::with(['departement', 'poste', 'responsable'])
            ->withCount('candidatures')
            ->where('statut', 'ferme')
            ->latest('date_cloture')
            ->paginate(15)
            ->withQueryString();

        return view('back.rh.recrutements.fermees', [
            'pageTitle' => 'Recrutements fermés',
            'recrutements' => $recrutements,
        ]);
    }

    public function archivees(Request $request): View
    {
        $recrutements = Recrutement::with(['departement', 'poste', 'responsable'])
            ->withCount('candidatures')
            ->where('statut', 'archive')
            ->latest('updated_at')
            ->paginate(15)
            ->withQueryString();

        return view('back.rh.recrutements.archivees', [
            'pageTitle' => 'Recrutements archivés',
            'recrutements' => $recrutements,
        ]);
    }

    public function pipeline(Recrutement $recrutement): View
    {
        $recrutement->load(['departement', 'poste', 'responsable']);

        $groupes = [
            'recu' => Candidature::where('recrutement_id', $recrutement->id)->where('statut', 'recu')->latest()->get(),
            'en_etude' => Candidature::where('recrutement_id', $recrutement->id)->where('statut', 'en_etude')->latest()->get(),
            'entretien' => Candidature::where('recrutement_id', $recrutement->id)->where('statut', 'entretien')->latest()->get(),
            'retenu' => Candidature::where('recrutement_id', $recrutement->id)->where('statut', 'retenu')->latest()->get(),
            'rejete' => Candidature::where('recrutement_id', $recrutement->id)->where('statut', 'rejete')->latest()->get(),
        ];

        return view('back.rh.recrutements.pipeline', [
            'pageTitle' => 'Pipeline du recrutement',
            'recrutement' => $recrutement,
            'groupes' => $groupes,
            'stats' => $this->buildPipelineStats($recrutement),
        ]);
    }

    public function dashboard(Recrutement $recrutement): View
    {
        $recrutement->load(['departement', 'poste', 'responsable']);

        $stats = $this->buildPipelineStats($recrutement);

        $candidaturesRecentes = Candidature::where('recrutement_id', $recrutement->id)
            ->latest()
            ->take(10)
            ->get();

        return view('back.rh.recrutements.dashboard', [
            'pageTitle' => 'Dashboard du recrutement',
            'recrutement' => $recrutement,
            'stats' => $stats,
            'candidaturesRecentes' => $candidaturesRecentes,
        ]);
    }

    public function duDepartement(Departement $departement): View
    {
        $recrutements = Recrutement::with(['poste', 'responsable'])
            ->withCount('candidatures')
            ->where('departement_id', $departement->id)
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('back.rh.recrutements.du-departement', [
            'pageTitle' => 'Recrutements du département',
            'departement' => $departement,
            'recrutements' => $recrutements,
        ]);
    }

    private function buildPipelineStats(Recrutement $recrutement): array
    {
        $baseQuery = Candidature::query()->where('recrutement_id', $recrutement->id);

        $total = (clone $baseQuery)->count();
        $recu = (clone $baseQuery)->where('statut', 'recu')->count();
        $enEtude = (clone $baseQuery)->where('statut', 'en_etude')->count();
        $entretien = (clone $baseQuery)->where('statut', 'entretien')->count();
        $retenu = (clone $baseQuery)->where('statut', 'retenu')->count();
        $rejete = (clone $baseQuery)->where('statut', 'rejete')->count();

        $tauxRetention = $total > 0 ? round(($retenu / $total) * 100, 2) : 0;
        $tauxRejet = $total > 0 ? round(($rejete / $total) * 100, 2) : 0;

        return [
            'total' => $total,
            'recu' => $recu,
            'en_etude' => $enEtude,
            'entretien' => $entretien,
            'retenu' => $retenu,
            'rejete' => $rejete,
            'taux_retention' => $tauxRetention,
            'taux_rejet' => $tauxRejet,
        ];
    }

    private function typesContrat(): array
    {
        return [
            'cdi' => 'CDI',
            'cdd' => 'CDD',
            'stage' => 'Stage',
            'freelance' => 'Freelance',
            'consultance' => 'Consultance',
            'autre' => 'Autre',
        ];
    }

    private function statuts(): array
    {
        return [
            'brouillon' => 'Brouillon',
            'ouvert' => 'Ouvert',
            'en_cours' => 'En cours',
            'ferme' => 'Fermé',
            'archive' => 'Archivé',
        ];
    }
}