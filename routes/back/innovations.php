<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Back\Innovation\DashboardInnovationController;
use App\Http\Controllers\Back\Innovation\InnovationController;
use App\Http\Controllers\Back\Innovation\InnovationPortefeuilleController;
use App\Http\Controllers\Back\Innovation\PropositionAmeliorationController;
use App\Http\Controllers\Back\Innovation\IdeeInnovationController;
use App\Http\Controllers\Back\Innovation\ReformeInterneController;
use App\Http\Controllers\Back\Innovation\ExperimentationController;
use App\Http\Controllers\Back\Innovation\DeploiementInnovationController;
use App\Http\Controllers\Back\Innovation\SuiviInnovationController;
use App\Http\Controllers\Back\Innovation\ImpactInnovationController;
use App\Http\Controllers\Back\Innovation\ComiteInnovationController;
use App\Http\Controllers\Back\Innovation\FinancementInnovationController;

use App\Http\Controllers\Back\Innovation\InnovationObjectifController;
use App\Http\Controllers\Back\Innovation\InnovationIndicateurController;
use App\Http\Controllers\Back\Innovation\InnovationDocumentController;
use App\Http\Controllers\Back\Innovation\ReformeActionController;
use App\Http\Controllers\Back\Innovation\ReformeRisqueController;
use App\Http\Controllers\Back\Innovation\ReformeDecisionController;

Route::middleware(['web', 'auth'])
    ->prefix('back/innovations')
    ->name('back.innovations.')
    ->group(function () {

        Route::get('/', [DashboardInnovationController::class, 'index'])->name('dashboard');
        Route::get('/pilotage', [DashboardInnovationController::class, 'pilotage'])->name('pilotage');
        Route::get('/cartographie', [DashboardInnovationController::class, 'cartographie'])->name('cartographie');
        Route::get('/alertes', [DashboardInnovationController::class, 'alertes'])->name('alertes');

        Route::get('/portefeuilles/{portefeuille}/budget', [InnovationPortefeuilleController::class, 'budget'])->name('portefeuilles.budget');
        Route::patch('/portefeuilles/{portefeuille}/activer', [InnovationPortefeuilleController::class, 'activer'])->name('portefeuilles.activer');
        Route::patch('/portefeuilles/{portefeuille}/suspendre', [InnovationPortefeuilleController::class, 'suspendre'])->name('portefeuilles.suspendre');
        Route::patch('/portefeuilles/{portefeuille}/archiver', [InnovationPortefeuilleController::class, 'archiver'])->name('portefeuilles.archiver');
        Route::resource('portefeuilles', InnovationPortefeuilleController::class);

        Route::get('/innovations/{innovation}/synthese', [InnovationController::class, 'synthese'])->name('innovations.synthese');
        Route::get('/innovations/{innovation}/performance', [InnovationController::class, 'performance'])->name('innovations.performance');
        Route::get('/innovations/{innovation}/timeline', [InnovationController::class, 'timeline'])->name('innovations.timeline');
        Route::get('/innovations/{innovation}/export-json', [InnovationController::class, 'exportJson'])->name('innovations.export-json');
        Route::patch('/innovations/{innovation}/statut', [InnovationController::class, 'changerStatut'])->name('innovations.changer-statut');
        Route::patch('/innovations/{innovation}/priorite', [InnovationController::class, 'prioriser'])->name('innovations.prioriser');
        Route::post('/innovations/{innovation}/dupliquer', [InnovationController::class, 'dupliquer'])->name('innovations.dupliquer');
        Route::resource('innovations', InnovationController::class);

        Route::get('/propositions/{proposition}/analyse', [PropositionAmeliorationController::class, 'analyse'])->name('propositions.analyse');
        Route::patch('/propositions/{proposition}/statut', [PropositionAmeliorationController::class, 'changerStatut'])->name('propositions.changer-statut');
        Route::patch('/propositions/{proposition}/retenir', [PropositionAmeliorationController::class, 'retenir'])->name('propositions.retenir');
        Route::patch('/propositions/{proposition}/rejeter', [PropositionAmeliorationController::class, 'rejeter'])->name('propositions.rejeter');
        Route::resource('propositions', PropositionAmeliorationController::class);

        Route::get('/idees/shortlist', [IdeeInnovationController::class, 'shortlist'])->name('idees.shortlist');
        Route::get('/idees/populaires', [IdeeInnovationController::class, 'populaires'])->name('idees.populaires');
        Route::get('/idees/maturite', [IdeeInnovationController::class, 'maturite'])->name('idees.maturite');
        Route::patch('/idees/{idee}/statut', [IdeeInnovationController::class, 'changerStatut'])->name('idees.changer-statut');
        Route::resource('idees', IdeeInnovationController::class);

        Route::get('/reformes/{reforme}/actions', [ReformeInterneController::class, 'actions'])->name('reformes.actions');
        Route::get('/reformes/{reforme}/risques', [ReformeInterneController::class, 'risques'])->name('reformes.risques');
        Route::get('/reformes/{reforme}/decisions', [ReformeInterneController::class, 'decisions'])->name('reformes.decisions');
        Route::get('/reformes/{reforme}/synthese', [ReformeInterneController::class, 'synthese'])->name('reformes.synthese');
        Route::patch('/reformes/{reforme}/statut', [ReformeInterneController::class, 'changerStatut'])->name('reformes.changer-statut');
        Route::resource('reformes', ReformeInterneController::class);

        Route::get('/experimentations/{experimentation}/sites', [ExperimentationController::class, 'sites'])->name('experimentations.sites');
        Route::get('/experimentations/{experimentation}/resultats', [ExperimentationController::class, 'resultats'])->name('experimentations.resultats');
        Route::get('/experimentations/{experimentation}/decisions', [ExperimentationController::class, 'decisions'])->name('experimentations.decisions');
        Route::get('/experimentations/{experimentation}/rapport', [ExperimentationController::class, 'rapport'])->name('experimentations.rapport');
        Route::patch('/experimentations/{experimentation}/statut', [ExperimentationController::class, 'changerStatut'])->name('experimentations.changer-statut');
        Route::resource('experimentations', ExperimentationController::class);

        Route::get('/deploiements/{deploiement}/couverture', [DeploiementInnovationController::class, 'couverture'])->name('deploiements.couverture');
        Route::get('/deploiements/{deploiement}/adoption', [DeploiementInnovationController::class, 'adoption'])->name('deploiements.adoption');
        Route::get('/deploiements/{deploiement}/incidents', [DeploiementInnovationController::class, 'incidents'])->name('deploiements.incidents');
        Route::get('/deploiements/{deploiement}/carte', [DeploiementInnovationController::class, 'carte'])->name('deploiements.carte');
        Route::patch('/deploiements/{deploiement}/statut', [DeploiementInnovationController::class, 'changerStatut'])->name('deploiements.changer-statut');
        Route::resource('deploiements', DeploiementInnovationController::class);

        Route::get('/suivis/{suivi}/timeline', [SuiviInnovationController::class, 'timeline'])->name('suivis.timeline');
        Route::get('/suivis/{suivi}/blocages', [SuiviInnovationController::class, 'blocages'])->name('suivis.blocages');
        Route::post('/suivis/{suivi}/notifier', [SuiviInnovationController::class, 'notifier'])->name('suivis.notifier');
        Route::resource('suivis', SuiviInnovationController::class);

        Route::get('/impacts/{impact}/mesures', [ImpactInnovationController::class, 'mesures'])->name('impacts.mesures');
        Route::get('/impacts/{impact}/beneficiaires', [ImpactInnovationController::class, 'beneficiaires'])->name('impacts.beneficiaires');
        Route::get('/impacts/{impact}/rapports', [ImpactInnovationController::class, 'rapports'])->name('impacts.rapports');
        Route::resource('impacts', ImpactInnovationController::class);

        Route::get('/comites/{comite}/sessions', [ComiteInnovationController::class, 'sessions'])->name('comites.sessions');
        Route::get('/comites/{comite}/planning', [ComiteInnovationController::class, 'planning'])->name('comites.planning');
        Route::get('/comites/{comite}/decisions', [ComiteInnovationController::class, 'decisions'])->name('comites.decisions');
        Route::resource('comites', ComiteInnovationController::class);

        Route::get('/financements/stats', [FinancementInnovationController::class, 'stats'])->name('financements.stats');
        Route::resource('financements', FinancementInnovationController::class);

        Route::patch('/objectifs/{objectif}/atteint', [InnovationObjectifController::class, 'marquerAtteint'])->name('objectifs.atteint');
        Route::patch('/objectifs/{objectif}/non-atteint', [InnovationObjectifController::class, 'marquerNonAtteint'])->name('objectifs.non-atteint');
        Route::resource('objectifs', InnovationObjectifController::class);

        Route::patch('/indicateurs/{indicateur}/actualiser-valeur', [InnovationIndicateurController::class, 'actualiserValeur'])->name('indicateurs.actualiser-valeur');
        Route::resource('indicateurs', InnovationIndicateurController::class);

        Route::get('/documents/{document}/telecharger', [InnovationDocumentController::class, 'telecharger'])->name('documents.telecharger');
        Route::resource('documents', InnovationDocumentController::class);

        Route::patch('/actions/{action}/terminer', [ReformeActionController::class, 'terminer'])->name('actions.terminer');
        Route::patch('/actions/{action}/bloquer', [ReformeActionController::class, 'bloquer'])->name('actions.bloquer');
        Route::resource('actions', ReformeActionController::class);

        Route::get('/risques/critiques', [ReformeRisqueController::class, 'critiques'])->name('risques.critiques');
        Route::resource('risques', ReformeRisqueController::class);

        Route::resource('decisions', ReformeDecisionController::class);
    });
