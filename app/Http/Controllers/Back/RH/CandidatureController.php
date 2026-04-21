<?php

namespace App\Http\Controllers\Back\RH;

use App\Http\Controllers\Controller;
use App\Http\Requests\RH\CandidatureRequest;
use App\Models\Departement;
use App\Models\RH\Candidature;
use App\Models\RH\Recrutement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CandidatureController extends Controller
{
    public function index(Request $request): View
    {
        $query = Candidature::query()
            ->with([
                'recrutement.departement',
                'recrutement.poste',
                'recrutement.responsable',
            ]);

        if ($request->filled('search')) {
            $search = trim((string) $request->input('search'));

            $query->where(function ($q) use ($search) {
                $q->where('nom', 'like', "%{$search}%")
                    ->orWhere('prenom', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('telephone', 'like', "%{$search}%")
                    ->orWhere('observation', 'like', "%{$search}%")
                    ->orWhereHas('recrutement', function ($subQ) use ($search) {
                        $subQ->where('titre', 'like', "%{$search}%")
                            ->orWhere('slug', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('recrutement_id')) {
            $query->where('recrutement_id', $request->integer('recrutement_id'));
        }

        if ($request->filled('departement_id')) {
            $departementId = $request->integer('departement_id');

            $query->whereHas('recrutement', function ($q) use ($departementId) {
                $q->where('departement_id', $departementId);
            });
        }

        if ($request->filled('statut')) {
            $query->where('statut', $request->input('statut'));
        }

        if ($request->filled('date_candidature_debut')) {
            $query->whereDate('date_candidature', '>=', $request->input('date_candidature_debut'));
        }

        if ($request->filled('date_candidature_fin')) {
            $query->whereDate('date_candidature', '<=', $request->input('date_candidature_fin'));
        }

        $candidatures = $query
            ->latest('created_at')
            ->paginate(15)
            ->withQueryString();

        return view('back.rh.candidatures.index', [
            'pageTitle' => 'Candidatures',
            'candidatures' => $candidatures,
            'recrutements' => Recrutement::orderBy('titre')->get(),
            'departements' => Departement::orderBy('nom')->get(),
            'statuts' => $this->statuts(),
            'filters' => $request->all(),
        ]);
    }

    public function create(): View
    {
        return view('back.rh.candidatures.create', [
            'pageTitle' => 'Créer une candidature',
            'recrutements' => Recrutement::with(['departement', 'poste'])
                ->orderBy('titre')
                ->get(),
            'statuts' => $this->statuts(),
        ]);
    }

    public function store(CandidatureRequest $request): RedirectResponse
    {
        $candidature = Candidature::create($request->validated());

        return redirect()
            ->route('rh.candidatures.show', $candidature)
            ->with('success', 'La candidature a été créée avec succès.');
    }

    public function show(Candidature $candidature): View
    {
        $candidature->load([
            'recrutement.departement',
            'recrutement.poste',
            'recrutement.responsable',
        ]);

        return view('back.rh.candidatures.show', [
            'pageTitle' => 'Détail de la candidature',
            'candidature' => $candidature,
        ]);
    }

    public function edit(Candidature $candidature): View
    {
        return view('back.rh.candidatures.edit', [
            'pageTitle' => 'Modifier la candidature',
            'candidature' => $candidature->load('recrutement'),
            'recrutements' => Recrutement::with(['departement', 'poste'])
                ->orderBy('titre')
                ->get(),
            'statuts' => $this->statuts(),
        ]);
    }

    public function update(CandidatureRequest $request, Candidature $candidature): RedirectResponse
    {
        $candidature->update($request->validated());

        return redirect()
            ->route('rh.candidatures.show', $candidature)
            ->with('success', 'La candidature a été mise à jour avec succès.');
    }

    public function destroy(Candidature $candidature): RedirectResponse
    {
        $candidature->delete();

        return redirect()
            ->route('rh.candidatures.index')
            ->with('success', 'La candidature a été supprimée avec succès.');
    }

    public function parRecrutement(Recrutement $recrutement, Request $request): View
    {
        $query = Candidature::with('recrutement')
            ->where('recrutement_id', $recrutement->id);

        if ($request->filled('statut')) {
            $query->where('statut', $request->input('statut'));
        }

        $candidatures = $query
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('back.rh.candidatures.par-recrutement', [
            'pageTitle' => 'Candidatures par recrutement',
            'recrutement' => $recrutement->load(['departement', 'poste']),
            'candidatures' => $candidatures,
            'statuts' => $this->statuts(),
        ]);
    }

    public function enEtude(Request $request): View
    {
        $candidatures = Candidature::with([
                'recrutement.departement',
                'recrutement.poste',
            ])
            ->whereIn('statut', ['recu', 'en_etude'])
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('back.rh.candidatures.en-etude', [
            'pageTitle' => 'Candidatures en étude',
            'candidatures' => $candidatures,
        ]);
    }

    public function entretiens(Request $request): View
    {
        $candidatures = Candidature::with([
                'recrutement.departement',
                'recrutement.poste',
            ])
            ->where('statut', 'entretien')
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('back.rh.candidatures.entretiens', [
            'pageTitle' => 'Candidatures en entretien',
            'candidatures' => $candidatures,
        ]);
    }

    public function retenues(Request $request): View
    {
        $candidatures = Candidature::with([
                'recrutement.departement',
                'recrutement.poste',
            ])
            ->where('statut', 'retenu')
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('back.rh.candidatures.retenues', [
            'pageTitle' => 'Candidatures retenues',
            'candidatures' => $candidatures,
        ]);
    }

    public function rejetees(Request $request): View
    {
        $candidatures = Candidature::with([
                'recrutement.departement',
                'recrutement.poste',
            ])
            ->where('statut', 'rejete')
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('back.rh.candidatures.rejetees', [
            'pageTitle' => 'Candidatures rejetées',
            'candidatures' => $candidatures,
        ]);
    }

    public function historique(Candidature $candidature): View
    {
        $candidature->load([
            'recrutement.departement',
            'recrutement.poste',
            'recrutement.responsable',
        ]);

        $timeline = collect([
            [
                'type' => 'creation',
                'date' => $candidature->created_at,
                'titre' => 'Candidature créée',
                'description' => 'Création initiale de la candidature.',
            ],
            [
                'type' => 'statut',
                'date' => $candidature->updated_at,
                'titre' => 'Statut actuel',
                'description' => 'Statut : ' . $candidature->statut,
            ],
        ])->sortByDesc('date')->values();

        return view('back.rh.candidatures.historique', [
            'pageTitle' => 'Historique de la candidature',
            'candidature' => $candidature,
            'timeline' => $timeline,
        ]);
    }

    public function telechargerCv(Candidature $candidature): RedirectResponse|StreamedResponse
    {
        if (!$candidature->cv) {
            return redirect()
                ->route('rh.candidatures.show', $candidature)
                ->with('error', 'Aucun CV n’est associé à cette candidature.');
        }

        if (!Storage::exists($candidature->cv)) {
            return redirect()
                ->route('rh.candidatures.show', $candidature)
                ->with('error', 'Le fichier CV est introuvable.');
        }

        return Storage::download($candidature->cv);
    }

    private function statuts(): array
    {
        return [
            'recu' => 'Reçu',
            'en_etude' => 'En étude',
            'entretien' => 'Entretien',
            'retenu' => 'Retenu',
            'rejete' => 'Rejeté',
        ];
    }
}