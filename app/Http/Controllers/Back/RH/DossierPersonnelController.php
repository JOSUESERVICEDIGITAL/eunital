<?php

namespace App\Http\Controllers\Back\RH;

use App\Http\Controllers\Controller;
use App\Http\Requests\RH\DossierPersonnelRequest;
use App\Models\Departement;
use App\Models\MembreEquipe;
use App\Models\Poste;
use App\Models\RH\DossierPersonnel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DossierPersonnelController extends Controller
{
    public function index(Request $request): View
    {
        $query = DossierPersonnel::query()
            ->with([
                'membreEquipe.departement',
                'membreEquipe.poste',
            ]);

        if ($request->filled('search')) {
            $search = trim((string) $request->input('search'));

            $query->where(function ($q) use ($search) {
                $q->where('matricule', 'like', "%{$search}%")
                    ->orWhere('numero_cnss', 'like', "%{$search}%")
                    ->orWhere('numero_piece_identite', 'like', "%{$search}%")
                    ->orWhereHas('membreEquipe', function ($subQ) use ($search) {
                        $subQ->where('nom', 'like', "%{$search}%")
                            ->orWhere('prenom', 'like', "%{$search}%")
                            ->orWhere('email_professionnel', 'like', "%{$search}%")
                            ->orWhere('telephone', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('departement_id')) {
            $departementId = $request->integer('departement_id');

            $query->whereHas('membreEquipe', function ($q) use ($departementId) {
                $q->where('departement_id', $departementId);
            });
        }

        if ($request->filled('poste_id')) {
            $posteId = $request->integer('poste_id');

            $query->whereHas('membreEquipe', function ($q) use ($posteId) {
                $q->where('poste_id', $posteId);
            });
        }

        if ($request->filled('statut_professionnel')) {
            $query->where('statut_professionnel', $request->input('statut_professionnel'));
        }

        if ($request->filled('date_embauche_debut')) {
            $query->whereDate('date_embauche', '>=', $request->input('date_embauche_debut'));
        }

        if ($request->filled('date_embauche_fin')) {
            $query->whereDate('date_embauche', '<=', $request->input('date_embauche_fin'));
        }

        $dossiers = $query
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('back.rh.dossiers-personnel.index', [
            'pageTitle' => 'Dossiers du personnel',
            'dossiers' => $dossiers,
            'departements' => Departement::orderBy('nom')->get(),
            'postes' => Poste::orderBy('nom')->get(),
            'filters' => $request->all(),
        ]);
    }

    public function create(): View
    {
        return view('back.rh.dossiers-personnel.create', [
            'pageTitle' => 'Créer un dossier du personnel',
            'membres' => MembreEquipe::orderBy('nom')->orderBy('prenom')->get(),
            'departements' => Departement::orderBy('nom')->get(),
            'postes' => Poste::orderBy('nom')->get(),
            'statutsProfessionnels' => $this->statutsProfessionnels(),
        ]);
    }

    public function store(DossierPersonnelRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $dossier = DossierPersonnel::create($data);

        return redirect()
            ->route('rh.dossiers-personnel.show', $dossier)
            ->with('success', 'Le dossier du personnel a été créé avec succès.');
    }

    public function show(DossierPersonnel $dossierPersonnel): View
    {
        $dossierPersonnel->load([
            'membreEquipe.departement',
            'membreEquipe.poste',
            'presences' => function ($q) {
                $q->latest('date_presence')->take(10);
            },
            'conges' => function ($q) {
                $q->latest('date_debut')->take(10);
            },
            'evaluations' => function ($q) {
                $q->latest('date_evaluation')->take(10);
            },
            'sanctions' => function ($q) {
                $q->latest('date_sanction')->take(10);
            },
            'signalementsBienEtre' => function ($q) {
                $q->latest()->take(10);
            },
        ]);

        return view('back.rh.dossiers-personnel.show', [
            'pageTitle' => 'Détail du dossier du personnel',
            'dossier' => $dossierPersonnel,
        ]);
    }

    public function edit(DossierPersonnel $dossierPersonnel): View
    {
        return view('back.rh.dossiers-personnel.edit', [
            'pageTitle' => 'Modifier le dossier du personnel',
            'dossier' => $dossierPersonnel->load('membreEquipe'),
            'membres' => MembreEquipe::orderBy('nom')->orderBy('prenom')->get(),
            'departements' => Departement::orderBy('nom')->get(),
            'postes' => Poste::orderBy('nom')->get(),
            'statutsProfessionnels' => $this->statutsProfessionnels(),
        ]);
    }

    public function update(DossierPersonnelRequest $request, DossierPersonnel $dossierPersonnel): RedirectResponse
    {
        $dossierPersonnel->update($request->validated());

        return redirect()
            ->route('rh.dossiers-personnel.show', $dossierPersonnel)
            ->with('success', 'Le dossier du personnel a été mis à jour avec succès.');
    }

    public function destroy(DossierPersonnel $dossierPersonnel): RedirectResponse
    {
        $dossierPersonnel->delete();

        return redirect()
            ->route('rh.dossiers-personnel.index')
            ->with('success', 'Le dossier du personnel a été supprimé avec succès.');
    }

    public function documents(DossierPersonnel $dossierPersonnel): View
    {
        return view('back.rh.dossiers-personnel.documents', [
            'pageTitle' => 'Documents du dossier du personnel',
            'dossier' => $dossierPersonnel->load('membreEquipe'),
            'documents' => $dossierPersonnel->documents ?? [],
        ]);
    }

    public function historique(DossierPersonnel $dossierPersonnel): View
    {
        $dossierPersonnel->load([
            'membreEquipe.departement',
            'membreEquipe.poste',
            'presences' => fn ($q) => $q->latest('date_presence'),
            'conges' => fn ($q) => $q->latest('date_debut'),
            'evaluations' => fn ($q) => $q->latest('date_evaluation'),
            'sanctions' => fn ($q) => $q->latest('date_sanction'),
            'signalementsBienEtre' => fn ($q) => $q->latest(),
        ]);

        return view('back.rh.dossiers-personnel.historique', [
            'pageTitle' => 'Historique du dossier du personnel',
            'dossier' => $dossierPersonnel,
        ]);
    }

    public function contrats(DossierPersonnel $dossierPersonnel): View
    {
        $membre = $dossierPersonnel->membreEquipe;

        return view('back.rh.dossiers-personnel.contrats', [
            'pageTitle' => 'Contrats du personnel',
            'dossier' => $dossierPersonnel->load('membreEquipe'),
            'contrats' => collect(), // à brancher plus tard sur le module juridique/contrats RH
            'membre' => $membre,
        ]);
    }

    public function evaluations(DossierPersonnel $dossierPersonnel): View
    {
        return view('back.rh.dossiers-personnel.evaluations', [
            'pageTitle' => 'Évaluations du personnel',
            'dossier' => $dossierPersonnel->load('membreEquipe', 'evaluations.evaluateur'),
            'evaluations' => $dossierPersonnel->evaluations()->latest('date_evaluation')->paginate(15),
        ]);
    }

    public function presences(DossierPersonnel $dossierPersonnel): View
    {
        return view('back.rh.dossiers-personnel.presences', [
            'pageTitle' => 'Présences du personnel',
            'dossier' => $dossierPersonnel->load('membreEquipe'),
            'presences' => $dossierPersonnel->presences()->latest('date_presence')->paginate(15),
        ]);
    }

    public function conges(DossierPersonnel $dossierPersonnel): View
    {
        return view('back.rh.dossiers-personnel.conges', [
            'pageTitle' => 'Congés du personnel',
            'dossier' => $dossierPersonnel->load('membreEquipe'),
            'conges' => $dossierPersonnel->conges()->latest('date_debut')->paginate(15),
        ]);
    }

    public function sanctions(DossierPersonnel $dossierPersonnel): View
    {
        return view('back.rh.dossiers-personnel.sanctions', [
            'pageTitle' => 'Sanctions du personnel',
            'dossier' => $dossierPersonnel->load('membreEquipe'),
            'sanctions' => $dossierPersonnel->sanctions()->latest('date_sanction')->paginate(15),
        ]);
    }

    public function exportPdf(DossierPersonnel $dossierPersonnel): RedirectResponse
    {
        return redirect()
            ->route('rh.dossiers-personnel.show', $dossierPersonnel)
            ->with('info', 'La génération PDF sera branchée dans une prochaine étape.');
    }

    public function timeline(DossierPersonnel $dossierPersonnel): View
    {
        $dossierPersonnel->load([
            'membreEquipe',
            'presences' => fn ($q) => $q->latest('date_presence')->take(20),
            'conges' => fn ($q) => $q->latest('date_debut')->take(20),
            'evaluations' => fn ($q) => $q->latest('date_evaluation')->take(20),
            'sanctions' => fn ($q) => $q->latest('date_sanction')->take(20),
            'signalementsBienEtre' => fn ($q) => $q->latest()->take(20),
        ]);

        $timeline = collect();

        foreach ($dossierPersonnel->presences as $presence) {
            $timeline->push([
                'type' => 'presence',
                'date' => $presence->date_presence,
                'titre' => 'Présence enregistrée',
                'description' => 'Statut : ' . $presence->statut,
            ]);
        }

        foreach ($dossierPersonnel->conges as $conge) {
            $timeline->push([
                'type' => 'conge',
                'date' => $conge->date_debut,
                'titre' => 'Congé',
                'description' => 'Statut : ' . $conge->statut,
            ]);
        }

        foreach ($dossierPersonnel->evaluations as $evaluation) {
            $timeline->push([
                'type' => 'evaluation',
                'date' => $evaluation->date_evaluation,
                'titre' => 'Évaluation',
                'description' => 'Statut : ' . $evaluation->statut,
            ]);
        }

        foreach ($dossierPersonnel->sanctions as $sanction) {
            $timeline->push([
                'type' => 'sanction',
                'date' => $sanction->date_sanction,
                'titre' => 'Sanction disciplinaire',
                'description' => $sanction->motif,
            ]);
        }

        foreach ($dossierPersonnel->signalementsBienEtre as $signalement) {
            $timeline->push([
                'type' => 'bien_etre',
                'date' => $signalement->created_at,
                'titre' => 'Bien-être au travail',
                'description' => $signalement->titre,
            ]);
        }

        $timeline = $timeline
            ->sortByDesc('date')
            ->values();

        return view('back.rh.dossiers-personnel.timeline', [
            'pageTitle' => 'Timeline du personnel',
            'dossier' => $dossierPersonnel->load('membreEquipe'),
            'timeline' => $timeline,
        ]);
    }

    private function statutsProfessionnels(): array
    {
        return [
            'en_poste' => 'En poste',
            'suspendu' => 'Suspendu',
            'demission' => 'Démission',
            'licencie' => 'Licencié',
            'archive' => 'Archivé',
        ];
    }
}
