<?php

use App\Http\Controllers\Back\RH\Actions\AnnulerCongeController;
use App\Http\Controllers\Back\RH\Actions\ArchiverEvaluationController;
use App\Http\Controllers\Back\RH\Actions\ArchiverRecrutementController;
use App\Http\Controllers\Back\RH\Actions\ChangerStatutCandidatureController;
use App\Http\Controllers\Back\RH\Actions\CloturerBienEtreController;
use App\Http\Controllers\Back\RH\Actions\FermerRecrutementController;
use App\Http\Controllers\Back\RH\Actions\LeverSanctionController;
use App\Http\Controllers\Back\RH\Actions\OuvrirRecrutementController;
use App\Http\Controllers\Back\RH\Actions\PointerPresenceController;
use App\Http\Controllers\Back\RH\Actions\RefuserCongeController;
use App\Http\Controllers\Back\RH\Actions\RejeterCandidatureController;
use App\Http\Controllers\Back\RH\Actions\RetenirCandidatureController;
use App\Http\Controllers\Back\RH\Actions\ValiderCongeController;
use App\Http\Controllers\Back\RH\Actions\ValiderEvaluationController;
use App\Http\Controllers\Back\RH\BienEtreTravailController;
use App\Http\Controllers\Back\RH\CandidatureController;
use App\Http\Controllers\Back\RH\CongeRhController;
use App\Http\Controllers\Back\RH\DashboardRhController;
use App\Http\Controllers\Back\RH\DossierPersonnelController;
use App\Http\Controllers\Back\RH\EvaluationRhController;
use App\Http\Controllers\Back\RH\PresenceRhController;
use App\Http\Controllers\Back\RH\RecrutementController;
use App\Http\Controllers\Back\RH\SanctionDisciplinaireController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth'])
    ->prefix('rh')
    ->name('rh.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Dashboard RH
        |--------------------------------------------------------------------------
        */
        Route::get('/dashboard', [DashboardRhController::class, 'index'])->name('dashboard');
        Route::get('/dashboard/statistiques', [DashboardRhController::class, 'statistiques'])->name('dashboard.statistiques');
        Route::get('/dashboard/alertes', [DashboardRhController::class, 'alertes'])->name('dashboard.alertes');
        Route::get('/dashboard/activites-recentes', [DashboardRhController::class, 'activitesRecentes'])->name('dashboard.activites');
        Route::get('/dashboard/indicateurs', [DashboardRhController::class, 'indicateurs'])->name('dashboard.indicateurs');
        Route::get('/dashboard/widgets', [DashboardRhController::class, 'widgets'])->name('dashboard.widgets');

        /*
        |--------------------------------------------------------------------------
        | Dossiers du personnel
        |--------------------------------------------------------------------------
        */
        Route::get('/dossiers-personnel', [DossierPersonnelController::class, 'index'])->name('dossiers-personnel.index');
        Route::get('/dossiers-personnel/create', [DossierPersonnelController::class, 'create'])->name('dossiers-personnel.create');
        Route::post('/dossiers-personnel', [DossierPersonnelController::class, 'store'])->name('dossiers-personnel.store');
        Route::get('/dossiers-personnel/{dossierPersonnel}', [DossierPersonnelController::class, 'show'])->name('dossiers-personnel.show');
        Route::get('/dossiers-personnel/{dossierPersonnel}/edit', [DossierPersonnelController::class, 'edit'])->name('dossiers-personnel.edit');
        Route::put('/dossiers-personnel/{dossierPersonnel}', [DossierPersonnelController::class, 'update'])->name('dossiers-personnel.update');
        Route::delete('/dossiers-personnel/{dossierPersonnel}', [DossierPersonnelController::class, 'destroy'])->name('dossiers-personnel.destroy');

        Route::get('/dossiers-personnel/{dossierPersonnel}/documents', [DossierPersonnelController::class, 'documents'])->name('dossiers-personnel.documents');
        Route::get('/dossiers-personnel/{dossierPersonnel}/historique', [DossierPersonnelController::class, 'historique'])->name('dossiers-personnel.historique');
        Route::get('/dossiers-personnel/{dossierPersonnel}/contrats', [DossierPersonnelController::class, 'contrats'])->name('dossiers-personnel.contrats');
        Route::get('/dossiers-personnel/{dossierPersonnel}/evaluations', [DossierPersonnelController::class, 'evaluations'])->name('dossiers-personnel.evaluations');
        Route::get('/dossiers-personnel/{dossierPersonnel}/presences', [DossierPersonnelController::class, 'presences'])->name('dossiers-personnel.presences');
        Route::get('/dossiers-personnel/{dossierPersonnel}/conges', [DossierPersonnelController::class, 'conges'])->name('dossiers-personnel.conges');
        Route::get('/dossiers-personnel/{dossierPersonnel}/sanctions', [DossierPersonnelController::class, 'sanctions'])->name('dossiers-personnel.sanctions');
        Route::get('/dossiers-personnel/{dossierPersonnel}/export-pdf', [DossierPersonnelController::class, 'exportPdf'])->name('dossiers-personnel.export-pdf');
        Route::get('/dossiers-personnel/{dossierPersonnel}/timeline', [DossierPersonnelController::class, 'timeline'])->name('dossiers-personnel.timeline');

        /*
        |--------------------------------------------------------------------------
        | Congés RH
        |--------------------------------------------------------------------------
        */
        Route::get('/conges', [CongeRhController::class, 'index'])->name('conges.index');
        Route::get('/conges/create', [CongeRhController::class, 'create'])->name('conges.create');
        Route::post('/conges', [CongeRhController::class, 'store'])->name('conges.store');
        Route::get('/conges/{congeRh}', [CongeRhController::class, 'show'])->name('conges.show');
        Route::get('/conges/{congeRh}/edit', [CongeRhController::class, 'edit'])->name('conges.edit');
        Route::put('/conges/{congeRh}', [CongeRhController::class, 'update'])->name('conges.update');
        Route::delete('/conges/{congeRh}', [CongeRhController::class, 'destroy'])->name('conges.destroy');

        Route::get('/conges-en-attente', [CongeRhController::class, 'enAttente'])->name('conges.en-attente');
        Route::get('/conges-valides', [CongeRhController::class, 'valides'])->name('conges.valides');
        Route::get('/conges-refuses', [CongeRhController::class, 'refuses'])->name('conges.refuses');
        Route::get('/conges-annules', [CongeRhController::class, 'annules'])->name('conges.annules');
        Route::get('/conges-employe/{membreEquipe}', [CongeRhController::class, 'parEmploye'])->name('conges.par-employe');
        Route::get('/conges-calendrier', [CongeRhController::class, 'calendrier'])->name('conges.calendrier');
        Route::get('/conges-solde', [CongeRhController::class, 'solde'])->name('conges.solde-global');
        Route::get('/conges-solde/{membreEquipe}', [CongeRhController::class, 'solde'])->name('conges.solde-employe');
        Route::get('/conges-historique', [CongeRhController::class, 'historique'])->name('conges.historique');

        /*
        |--------------------------------------------------------------------------
        | Actions Congés
        |--------------------------------------------------------------------------
        */
        Route::post('/conges/{congeRh}/valider', ValiderCongeController::class)->name('conges.valider');
        Route::post('/conges/{congeRh}/refuser', RefuserCongeController::class)->name('conges.refuser');
        Route::post('/conges/{congeRh}/annuler', AnnulerCongeController::class)->name('conges.annuler');

        /*
        |--------------------------------------------------------------------------
        | Recrutements
        |--------------------------------------------------------------------------
        */
        Route::get('/recrutements', [RecrutementController::class, 'index'])->name('recrutements.index');
        Route::get('/recrutements/create', [RecrutementController::class, 'create'])->name('recrutements.create');
        Route::post('/recrutements', [RecrutementController::class, 'store'])->name('recrutements.store');
        Route::get('/recrutements/{recrutement}', [RecrutementController::class, 'show'])->name('recrutements.show');
        Route::get('/recrutements/{recrutement}/edit', [RecrutementController::class, 'edit'])->name('recrutements.edit');
        Route::put('/recrutements/{recrutement}', [RecrutementController::class, 'update'])->name('recrutements.update');
        Route::delete('/recrutements/{recrutement}', [RecrutementController::class, 'destroy'])->name('recrutements.destroy');

        Route::get('/recrutements-ouverts', [RecrutementController::class, 'ouvertes'])->name('recrutements.ouvertes');
        Route::get('/recrutements-fermes', [RecrutementController::class, 'fermees'])->name('recrutements.fermees');
        Route::get('/recrutements-archives', [RecrutementController::class, 'archivees'])->name('recrutements.archivees');
        Route::get('/recrutements/{recrutement}/pipeline', [RecrutementController::class, 'pipeline'])->name('recrutements.pipeline');
        Route::get('/recrutements/{recrutement}/dashboard', [RecrutementController::class, 'dashboard'])->name('recrutements.dashboard');
        Route::get('/recrutements/departement/{departement}', [RecrutementController::class, 'duDepartement'])->name('recrutements.departement');

        /*
        |--------------------------------------------------------------------------
        | Actions Recrutements
        |--------------------------------------------------------------------------
        */
        Route::post('/recrutements/{recrutement}/ouvrir', OuvrirRecrutementController::class)->name('recrutements.ouvrir');
        Route::post('/recrutements/{recrutement}/fermer', FermerRecrutementController::class)->name('recrutements.fermer');
        Route::post('/recrutements/{recrutement}/archiver', ArchiverRecrutementController::class)->name('recrutements.archiver');

        /*
        |--------------------------------------------------------------------------
        | Candidatures
        |--------------------------------------------------------------------------
        */
        Route::get('/candidatures', [CandidatureController::class, 'index'])->name('candidatures.index');
        Route::get('/candidatures/create', [CandidatureController::class, 'create'])->name('candidatures.create');
        Route::post('/candidatures', [CandidatureController::class, 'store'])->name('candidatures.store');
        Route::get('/candidatures/{candidature}', [CandidatureController::class, 'show'])->name('candidatures.show');
        Route::get('/candidatures/{candidature}/edit', [CandidatureController::class, 'edit'])->name('candidatures.edit');
        Route::put('/candidatures/{candidature}', [CandidatureController::class, 'update'])->name('candidatures.update');
        Route::delete('/candidatures/{candidature}', [CandidatureController::class, 'destroy'])->name('candidatures.destroy');

        Route::get('/candidatures/recrutement/{recrutement}', [CandidatureController::class, 'parRecrutement'])->name('candidatures.par-recrutement');
        Route::get('/candidatures-en-etude', [CandidatureController::class, 'enEtude'])->name('candidatures.en-etude');
        Route::get('/candidatures-entretiens', [CandidatureController::class, 'entretiens'])->name('candidatures.entretiens');
        Route::get('/candidatures-retenues', [CandidatureController::class, 'retenues'])->name('candidatures.retenues');
        Route::get('/candidatures-rejetees', [CandidatureController::class, 'rejetees'])->name('candidatures.rejetees');
        Route::get('/candidatures/{candidature}/historique', [CandidatureController::class, 'historique'])->name('candidatures.historique');
        Route::get('/candidatures/{candidature}/telecharger-cv', [CandidatureController::class, 'telechargerCv'])->name('candidatures.telecharger-cv');

        /*
        |--------------------------------------------------------------------------
        | Actions Candidatures
        |--------------------------------------------------------------------------
        */
        Route::post('/candidatures/{candidature}/changer-statut', ChangerStatutCandidatureController::class)->name('candidatures.changer-statut');
        Route::post('/candidatures/{candidature}/retenir', RetenirCandidatureController::class)->name('candidatures.retenir');
        Route::post('/candidatures/{candidature}/rejeter', RejeterCandidatureController::class)->name('candidatures.rejeter');

        /*
        |--------------------------------------------------------------------------
        | Présences RH
        |--------------------------------------------------------------------------
        */
        Route::get('/presences', [PresenceRhController::class, 'index'])->name('presences.index');
        Route::get('/presences/create', [PresenceRhController::class, 'create'])->name('presences.create');
        Route::post('/presences', [PresenceRhController::class, 'store'])->name('presences.store');
        Route::get('/presences/{presenceRh}', [PresenceRhController::class, 'show'])->name('presences.show');
        Route::get('/presences/{presenceRh}/edit', [PresenceRhController::class, 'edit'])->name('presences.edit');
        Route::put('/presences/{presenceRh}', [PresenceRhController::class, 'update'])->name('presences.update');
        Route::delete('/presences/{presenceRh}', [PresenceRhController::class, 'destroy'])->name('presences.destroy');

        Route::get('/presences-journalier', [PresenceRhController::class, 'journalier'])->name('presences.journalier');
        Route::get('/presences-hebdomadaire', [PresenceRhController::class, 'hebdomadaire'])->name('presences.hebdomadaire');
        Route::get('/presences-mensuel', [PresenceRhController::class, 'mensuel'])->name('presences.mensuel');
        Route::get('/presences-retards', [PresenceRhController::class, 'retards'])->name('presences.retards');
        Route::get('/presences-absences', [PresenceRhController::class, 'absences'])->name('presences.absences');
        Route::get('/presences-employe/{membreEquipe}', [PresenceRhController::class, 'parEmploye'])->name('presences.par-employe');
        Route::get('/presences-calendrier', [PresenceRhController::class, 'calendrier'])->name('presences.calendrier');
        Route::get('/presences-rapport', [PresenceRhController::class, 'rapport'])->name('presences.rapport');

        /*
        |--------------------------------------------------------------------------
        | Actions Présences
        |--------------------------------------------------------------------------
        */
        Route::post('/presences/pointer', PointerPresenceController::class)->name('presences.pointer');

        /*
        |--------------------------------------------------------------------------
        | Évaluations RH
        |--------------------------------------------------------------------------
        */
        Route::get('/evaluations', [EvaluationRhController::class, 'index'])->name('evaluations.index');
        Route::get('/evaluations/create', [EvaluationRhController::class, 'create'])->name('evaluations.create');
        Route::post('/evaluations', [EvaluationRhController::class, 'store'])->name('evaluations.store');
        Route::get('/evaluations/{evaluationRh}', [EvaluationRhController::class, 'show'])->name('evaluations.show');
        Route::get('/evaluations/{evaluationRh}/edit', [EvaluationRhController::class, 'edit'])->name('evaluations.edit');
        Route::put('/evaluations/{evaluationRh}', [EvaluationRhController::class, 'update'])->name('evaluations.update');
        Route::delete('/evaluations/{evaluationRh}', [EvaluationRhController::class, 'destroy'])->name('evaluations.destroy');

        Route::get('/evaluations-validees', [EvaluationRhController::class, 'validees'])->name('evaluations.validees');
        Route::get('/evaluations-brouillons', [EvaluationRhController::class, 'brouillons'])->name('evaluations.brouillons');
        Route::get('/evaluations-archivees', [EvaluationRhController::class, 'archivees'])->name('evaluations.archivees');
        Route::get('/evaluations-employe/{membreEquipe}', [EvaluationRhController::class, 'parEmploye'])->name('evaluations.par-employe');
        Route::get('/evaluations/{evaluationRh}/historique', [EvaluationRhController::class, 'historique'])->name('evaluations.historique');
        Route::get('/evaluations-synthese', [EvaluationRhController::class, 'synthese'])->name('evaluations.synthese');

        /*
        |--------------------------------------------------------------------------
        | Actions Évaluations
        |--------------------------------------------------------------------------
        */
        Route::post('/evaluations/{evaluationRh}/valider', ValiderEvaluationController::class)->name('evaluations.valider');
        Route::post('/evaluations/{evaluationRh}/archiver', ArchiverEvaluationController::class)->name('evaluations.archiver');

        /*
        |--------------------------------------------------------------------------
        | Sanctions disciplinaires
        |--------------------------------------------------------------------------
        */
        Route::get('/sanctions', [SanctionDisciplinaireController::class, 'index'])->name('sanctions.index');
        Route::get('/sanctions/create', [SanctionDisciplinaireController::class, 'create'])->name('sanctions.create');
        Route::post('/sanctions', [SanctionDisciplinaireController::class, 'store'])->name('sanctions.store');
        Route::get('/sanctions/{sanctionDisciplinaire}', [SanctionDisciplinaireController::class, 'show'])->name('sanctions.show');
        Route::get('/sanctions/{sanctionDisciplinaire}/edit', [SanctionDisciplinaireController::class, 'edit'])->name('sanctions.edit');
        Route::put('/sanctions/{sanctionDisciplinaire}', [SanctionDisciplinaireController::class, 'update'])->name('sanctions.update');
        Route::delete('/sanctions/{sanctionDisciplinaire}', [SanctionDisciplinaireController::class, 'destroy'])->name('sanctions.destroy');

        Route::get('/sanctions-actives', [SanctionDisciplinaireController::class, 'actives'])->name('sanctions.actives');
        Route::get('/sanctions-levees', [SanctionDisciplinaireController::class, 'levees'])->name('sanctions.levees');
        Route::get('/sanctions-archivees', [SanctionDisciplinaireController::class, 'archivees'])->name('sanctions.archivees');
        Route::get('/sanctions-employe/{membreEquipe}', [SanctionDisciplinaireController::class, 'parEmploye'])->name('sanctions.par-employe');
        Route::get('/sanctions-historique', [SanctionDisciplinaireController::class, 'historique'])->name('sanctions.historique');

        /*
        |--------------------------------------------------------------------------
        | Actions Sanctions
        |--------------------------------------------------------------------------
        */
        Route::post('/sanctions/{sanctionDisciplinaire}/lever', LeverSanctionController::class)->name('sanctions.lever');

        /*
        |--------------------------------------------------------------------------
        | Bien-être au travail
        |--------------------------------------------------------------------------
        */
        Route::get('/bien-etre', [BienEtreTravailController::class, 'index'])->name('bien-etre.index');
        Route::get('/bien-etre/create', [BienEtreTravailController::class, 'create'])->name('bien-etre.create');
        Route::post('/bien-etre', [BienEtreTravailController::class, 'store'])->name('bien-etre.store');
        Route::get('/bien-etre/{bienEtreTravail}', [BienEtreTravailController::class, 'show'])->name('bien-etre.show');
        Route::get('/bien-etre/{bienEtreTravail}/edit', [BienEtreTravailController::class, 'edit'])->name('bien-etre.edit');
        Route::put('/bien-etre/{bienEtreTravail}', [BienEtreTravailController::class, 'update'])->name('bien-etre.update');
        Route::delete('/bien-etre/{bienEtreTravail}', [BienEtreTravailController::class, 'destroy'])->name('bien-etre.destroy');

        Route::get('/bien-etre-ouverts', [BienEtreTravailController::class, 'ouverts'])->name('bien-etre.ouverts');
        Route::get('/bien-etre-en-cours', [BienEtreTravailController::class, 'enCours'])->name('bien-etre.en-cours');
        Route::get('/bien-etre-traites', [BienEtreTravailController::class, 'traites'])->name('bien-etre.traites');
        Route::get('/bien-etre-archives', [BienEtreTravailController::class, 'archives'])->name('bien-etre.archives');
        Route::get('/bien-etre-employe/{membreEquipe}', [BienEtreTravailController::class, 'parEmploye'])->name('bien-etre.par-employe');
        Route::get('/bien-etre-statistiques', [BienEtreTravailController::class, 'statistiques'])->name('bien-etre.statistiques');
        Route::get('/bien-etre/{bienEtreTravail}/suivi', [BienEtreTravailController::class, 'suivi'])->name('bien-etre.suivi');

        /*
        |--------------------------------------------------------------------------
        | Actions Bien-être
        |--------------------------------------------------------------------------
        */
        Route::post('/bien-etre/{bienEtreTravail}/cloturer', CloturerBienEtreController::class)->name('bien-etre.cloturer');
    });