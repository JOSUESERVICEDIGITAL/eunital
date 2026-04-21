<?php

namespace App\Http\Controllers\Back\RH;

use App\Http\Controllers\Controller;
use App\Http\Requests\RH\SanctionDisciplinaireRequest;
use App\Models\Departement;
use App\Models\MembreEquipe;
use App\Models\RH\SanctionDisciplinaire;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SanctionDisciplinaireController extends Controller
{
    public function index(Request $request): View
    {
        $query = SanctionDisciplinaire::query()
            ->with([
                'membreEquipe.departement',
                'membreEquipe.poste',
                'auteur',
            ]);

        if ($request->filled('search')) {
            $search = trim((string) $request->input('search'));

            $query->where(function ($q) use ($search) {
                $q->where('motif', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhereHas('membreEquipe', function ($subQ) use ($search) {
                        $subQ->where('nom', 'like', "%{$search}%")
                            ->orWhere('prenom', 'like', "%{$search}%")
                            ->orWhere('email_professionnel', 'like', "%{$search}%");
                    })
                    ->orWhereHas('auteur', function ($subQ) use ($search) {
                        $subQ->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
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

        if ($request->filled('auteur_id')) {
            $query->where('auteur_id', $request->integer('auteur_id'));
        }

        if ($request->filled('type_sanction')) {
            $query->where('type_sanction', $request->input('type_sanction'));
        }

        if ($request->filled('statut')) {
            $query->where('statut', $request->input('statut'));
        }

        if ($request->filled('date_sanction_debut')) {
            $query->whereDate('date_sanction', '>=', $request->input('date_sanction_debut'));
        }

        if ($request->filled('date_sanction_fin')) {
            $query->whereDate('date_sanction', '<=', $request->input('date_sanction_fin'));
        }

        $sanctions = $query
            ->latest('date_sanction')
            ->latest('created_at')
            ->paginate(15)
            ->withQueryString();

        return view('back.rh.sanctions.index', [
            'pageTitle' => 'Sanctions disciplinaires',
            'sanctions' => $sanctions,
            'membres' => MembreEquipe::orderBy('nom')->orderBy('prenom')->get(),
            'departements' => Departement::orderBy('nom')->get(),
            'auteurs' => User::orderBy('name')->get(),
            'typesSanction' => $this->typesSanction(),
            'statuts' => $this->statuts(),
            'filters' => $request->all(),
        ]);
    }

    public function create(): View
    {
        return view('back.rh.sanctions.create', [
            'pageTitle' => 'Nouvelle sanction disciplinaire',
            'membres' => MembreEquipe::with(['departement', 'poste'])
                ->orderBy('nom')
                ->orderBy('prenom')
                ->get(),
            'auteurs' => User::orderBy('name')->get(),
            'typesSanction' => $this->typesSanction(),
            'statuts' => $this->statuts(),
        ]);
    }

    public function store(SanctionDisciplinaireRequest $request): RedirectResponse
    {
        $sanction = SanctionDisciplinaire::create($request->validated());

        return redirect()
            ->route('rh.sanctions.show', $sanction)
            ->with('success', 'La sanction disciplinaire a été créée avec succès.');
    }

    public function show(SanctionDisciplinaire $sanctionDisciplinaire): View
    {
        $sanctionDisciplinaire->load([
            'membreEquipe.departement',
            'membreEquipe.poste',
            'auteur',
        ]);

        return view('back.rh.sanctions.show', [
            'pageTitle' => 'Détail de la sanction disciplinaire',
            'sanction' => $sanctionDisciplinaire,
            'resume' => $this->buildResume($sanctionDisciplinaire),
        ]);
    }

    public function edit(SanctionDisciplinaire $sanctionDisciplinaire): View
    {
        return view('back.rh.sanctions.edit', [
            'pageTitle' => 'Modifier la sanction disciplinaire',
            'sanction' => $sanctionDisciplinaire->load(['membreEquipe', 'auteur']),
            'membres' => MembreEquipe::with(['departement', 'poste'])
                ->orderBy('nom')
                ->orderBy('prenom')
                ->get(),
            'auteurs' => User::orderBy('name')->get(),
            'typesSanction' => $this->typesSanction(),
            'statuts' => $this->statuts(),
        ]);
    }

    public function update(SanctionDisciplinaireRequest $request, SanctionDisciplinaire $sanctionDisciplinaire): RedirectResponse
    {
        $sanctionDisciplinaire->update($request->validated());

        return redirect()
            ->route('rh.sanctions.show', $sanctionDisciplinaire)
            ->with('success', 'La sanction disciplinaire a été mise à jour avec succès.');
    }

    public function destroy(SanctionDisciplinaire $sanctionDisciplinaire): RedirectResponse
    {
        $sanctionDisciplinaire->delete();

        return redirect()
            ->route('rh.sanctions.index')
            ->with('success', 'La sanction disciplinaire a été supprimée avec succès.');
    }

    public function actives(Request $request): View
    {
        $sanctions = SanctionDisciplinaire::with([
                'membreEquipe.departement',
                'membreEquipe.poste',
                'auteur',
            ])
            ->where('statut', 'active')
            ->latest('date_sanction')
            ->paginate(15)
            ->withQueryString();

        return view('back.rh.sanctions.actives', [
            'pageTitle' => 'Sanctions actives',
            'sanctions' => $sanctions,
        ]);
    }

    public function levees(Request $request): View
    {
        $sanctions = SanctionDisciplinaire::with([
                'membreEquipe.departement',
                'membreEquipe.poste',
                'auteur',
            ])
            ->where('statut', 'levee')
            ->latest('date_sanction')
            ->paginate(15)
            ->withQueryString();

        return view('back.rh.sanctions.levees', [
            'pageTitle' => 'Sanctions levées',
            'sanctions' => $sanctions,
        ]);
    }

    public function archivees(Request $request): View
    {
        $sanctions = SanctionDisciplinaire::with([
                'membreEquipe.departement',
                'membreEquipe.poste',
                'auteur',
            ])
            ->where('statut', 'archivee')
            ->latest('updated_at')
            ->paginate(15)
            ->withQueryString();

        return view('back.rh.sanctions.archivees', [
            'pageTitle' => 'Sanctions archivées',
            'sanctions' => $sanctions,
        ]);
    }

    public function parEmploye(MembreEquipe $membreEquipe, Request $request): View
    {
        $query = SanctionDisciplinaire::with(['membreEquipe', 'auteur'])
            ->where('membre_equipe_id', $membreEquipe->id);

        if ($request->filled('statut')) {
            $query->where('statut', $request->input('statut'));
        }

        if ($request->filled('type_sanction')) {
            $query->where('type_sanction', $request->input('type_sanction'));
        }

        if ($request->filled('date_sanction_debut')) {
            $query->whereDate('date_sanction', '>=', $request->input('date_sanction_debut'));
        }

        if ($request->filled('date_sanction_fin')) {
            $query->whereDate('date_sanction', '<=', $request->input('date_sanction_fin'));
        }

        $sanctions = $query
            ->latest('date_sanction')
            ->paginate(15)
            ->withQueryString();

        $stats = [
            'total' => SanctionDisciplinaire::where('membre_equipe_id', $membreEquipe->id)->count(),
            'actives' => SanctionDisciplinaire::where('membre_equipe_id', $membreEquipe->id)->where('statut', 'active')->count(),
            'levees' => SanctionDisciplinaire::where('membre_equipe_id', $membreEquipe->id)->where('statut', 'levee')->count(),
            'archivees' => SanctionDisciplinaire::where('membre_equipe_id', $membreEquipe->id)->where('statut', 'archivee')->count(),
        ];

        return view('back.rh.sanctions.par-employe', [
            'pageTitle' => 'Sanctions par employé',
            'membre' => $membreEquipe->load(['departement', 'poste']),
            'sanctions' => $sanctions,
            'stats' => $stats,
            'typesSanction' => $this->typesSanction(),
            'statuts' => $this->statuts(),
        ]);
    }

    public function historique(Request $request): View
    {
        $query = SanctionDisciplinaire::query()
            ->with([
                'membreEquipe.departement',
                'membreEquipe.poste',
                'auteur',
            ])
            ->latest('updated_at');

        if ($request->filled('membre_equipe_id')) {
            $query->where('membre_equipe_id', $request->integer('membre_equipe_id'));
        }

        if ($request->filled('statut')) {
            $query->where('statut', $request->input('statut'));
        }

        if ($request->filled('type_sanction')) {
            $query->where('type_sanction', $request->input('type_sanction'));
        }

        $sanctions = $query
            ->paginate(20)
            ->withQueryString();

        return view('back.rh.sanctions.historique', [
            'pageTitle' => 'Historique des sanctions',
            'sanctions' => $sanctions,
            'membres' => MembreEquipe::orderBy('nom')->orderBy('prenom')->get(),
            'typesSanction' => $this->typesSanction(),
            'statuts' => $this->statuts(),
        ]);
    }

    private function buildResume(SanctionDisciplinaire $sanction): array
    {
        return [
            'motif' => $sanction->motif,
            'type_sanction' => $sanction->type_sanction,
            'statut' => $sanction->statut,
            'date_sanction' => $sanction->date_sanction,
            'employe' => optional($sanction->membreEquipe)->nom . ' ' . optional($sanction->membreEquipe)->prenom,
            'auteur' => optional($sanction->auteur)->name,
        ];
    }

    private function typesSanction(): array
    {
        return [
            'avertissement' => 'Avertissement',
            'blame' => 'Blâme',
            'mise_a_pied' => 'Mise à pied',
            'autre' => 'Autre',
        ];
    }

    private function statuts(): array
    {
        return [
            'active' => 'Active',
            'levee' => 'Levée',
            'archivee' => 'Archivée',
        ];
    }
}