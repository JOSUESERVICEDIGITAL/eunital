@extends('back.layouts.principal')

@section('title', 'Dashboard RH')
@section('page_title', 'Chambre des ressources humaines')
@section('page_subtitle', 'Pilotage global du personnel, des congés, du recrutement, des évaluations, de la discipline et du bien-être au travail.')

@section('content')
    <div class="row g-4">

        {{-- KPI principaux --}}
        <div class="col-12">
            <div class="row g-4">
                <div class="col-md-6 col-xl-3">
                    <div class="content-card h-100 stat-card stat-primary">
                        <div class="d-flex justify-content-between align-items-start gap-3">
                            <div>
                                <div class="mini-label">Employés</div>
                                <h3 class="stat-number">{{ $stats['employes']['total'] ?? 0 }}</h3>
                                <div class="stat-meta mt-2">
                                    <span class="badge rounded-pill text-bg-success">
                                        {{ $stats['employes']['actifs'] ?? 0 }} actifs
                                    </span>
                                    <span class="badge rounded-pill text-bg-secondary">
                                        {{ $stats['employes']['en_pause'] ?? 0 }} en pause
                                    </span>
                                </div>
                            </div>
                            <div class="stat-icon bg-primary-subtle text-primary">
                                <i class="fa-solid fa-users"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="content-card h-100 stat-card stat-success">
                        <div class="d-flex justify-content-between align-items-start gap-3">
                            <div>
                                <div class="mini-label">Congés en attente</div>
                                <h3 class="stat-number">{{ $stats['conges']['en_attente'] ?? 0 }}</h3>
                                <div class="stat-meta mt-2">
                                    <span class="badge rounded-pill text-bg-info">
                                        {{ $stats['conges']['valides_du_mois'] ?? 0 }} validés ce mois
                                    </span>
                                </div>
                            </div>
                            <div class="stat-icon bg-warning-subtle text-warning">
                                <i class="fa-solid fa-calendar-days"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="content-card h-100 stat-card stat-info">
                        <div class="d-flex justify-content-between align-items-start gap-3">
                            <div>
                                <div class="mini-label">Recrutements ouverts</div>
                                <h3 class="stat-number">{{ $stats['recrutements']['ouverts'] ?? 0 }}</h3>
                                <div class="stat-meta mt-2">
                                    <span class="badge rounded-pill text-bg-dark">
                                        {{ $stats['recrutements']['candidatures_du_mois'] ?? 0 }} candidatures ce mois
                                    </span>
                                </div>
                            </div>
                            <div class="stat-icon bg-info-subtle text-info">
                                <i class="fa-solid fa-user-plus"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="content-card h-100 stat-card stat-danger">
                        <div class="d-flex justify-content-between align-items-start gap-3">
                            <div>
                                <div class="mini-label">Présence du jour</div>
                                <h3 class="stat-number">{{ $stats['presences']['taux_presence_jour'] ?? 0 }}%</h3>
                                <div class="stat-meta mt-2">
                                    <span class="badge rounded-pill text-bg-success">
                                        {{ $stats['presences']['present_du_jour'] ?? 0 }} présents
                                    </span>
                                    <span class="badge rounded-pill text-bg-danger">
                                        {{ $stats['presences']['absents_du_jour'] ?? 0 }} absents
                                    </span>
                                </div>
                            </div>
                            <div class="stat-icon bg-success-subtle text-success">
                                <i class="fa-solid fa-clock"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Bandeau actions rapides --}}
        <div class="col-12">
            <div class="content-card hero-rh-card">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-4">
                    <div class="hero-rh-content">
                        <div class="hero-badge">
                            <i class="fa-solid fa-shield-heart me-2"></i>Centre de pilotage RH
                        </div>
                        <h4 class="fw-bold mb-2 mt-3">Navigation fluide de la chambre RH</h4>
                        <p class="text-muted mb-0">
                            Accède rapidement aux dossiers du personnel, aux recrutements, aux présences,
                            aux évaluations, à la discipline et au bien-être au travail depuis un seul cockpit.
                        </p>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('rh.dossiers-personnel.index') }}" class="btn btn-primary rounded-pill px-4">
                            <i class="fa-solid fa-folder-open me-2"></i>Dossiers
                        </a>

                        <a href="{{ route('rh.conges.index') }}" class="btn btn-outline-warning rounded-pill px-4">
                            <i class="fa-solid fa-calendar-check me-2"></i>Congés
                        </a>

                        <a href="{{ route('rh.recrutements.index') }}" class="btn btn-outline-info rounded-pill px-4">
                            <i class="fa-solid fa-user-plus me-2"></i>Recrutement
                        </a>

                        <a href="{{ route('rh.presences.index') }}" class="btn btn-outline-success rounded-pill px-4">
                            <i class="fa-solid fa-clock me-2"></i>Présences
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Navigation multi-modules RH --}}
        <div class="col-12">
            <div class="row g-4">
                <div class="col-md-6 col-xl-4">
                    <a href="{{ route('rh.dossiers-personnel.index') }}" class="module-card content-card h-100 text-decoration-none">
                        <div class="module-icon bg-primary-subtle text-primary">
                            <i class="fa-solid fa-id-card"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Dossiers du personnel</h5>
                        <p class="text-muted mb-3">
                            Fiches complètes des employés, documents, historique, sanctions, congés, présences et évaluations.
                        </p>
                        <div class="module-link">
                            Ouvrir le module <i class="fa-solid fa-arrow-right ms-2"></i>
                        </div>
                    </a>
                </div>

                <div class="col-md-6 col-xl-4">
                    <a href="{{ route('rh.recrutements.index') }}" class="module-card content-card h-100 text-decoration-none">
                        <div class="module-icon bg-info-subtle text-info">
                            <i class="fa-solid fa-user-group"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Recrutement & candidatures</h5>
                        <p class="text-muted mb-3">
                            Gère les recrutements ouverts, le pipeline de candidatures et les décisions RH rapides.
                        </p>
                        <div class="module-link">
                            Ouvrir le module <i class="fa-solid fa-arrow-right ms-2"></i>
                        </div>
                    </a>
                </div>

                <div class="col-md-6 col-xl-4">
                    <a href="{{ route('rh.presences.index') }}" class="module-card content-card h-100 text-decoration-none">
                        <div class="module-icon bg-success-subtle text-success">
                            <i class="fa-solid fa-business-time"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Présences & pointages</h5>
                        <p class="text-muted mb-3">
                            Journalier, hebdomadaire, mensuel, absences, retards et pointage rapide du personnel.
                        </p>
                        <div class="module-link">
                            Ouvrir le module <i class="fa-solid fa-arrow-right ms-2"></i>
                        </div>
                    </a>
                </div>

                <div class="col-md-6 col-xl-4">
                    <a href="{{ route('rh.evaluations.index') }}" class="module-card content-card h-100 text-decoration-none">
                        <div class="module-icon bg-warning-subtle text-warning">
                            <i class="fa-solid fa-chart-line"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Évaluations RH</h5>
                        <p class="text-muted mb-3">
                            Suivi de la performance, brouillons à valider, synthèses et historique par employé.
                        </p>
                        <div class="module-link">
                            Ouvrir le module <i class="fa-solid fa-arrow-right ms-2"></i>
                        </div>
                    </a>
                </div>

                <div class="col-md-6 col-xl-4">
                    <a href="{{ route('rh.sanctions.index') }}" class="module-card content-card h-100 text-decoration-none">
                        <div class="module-icon bg-danger-subtle text-danger">
                            <i class="fa-solid fa-scale-balanced"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Discipline</h5>
                        <p class="text-muted mb-3">
                            Supervise les sanctions, les actions disciplinaires et le suivi individuel des cas sensibles.
                        </p>
                        <div class="module-link">
                            Ouvrir le module <i class="fa-solid fa-arrow-right ms-2"></i>
                        </div>
                    </a>
                </div>

                <div class="col-md-6 col-xl-4">
                    <a href="{{ route('rh.bien-etre.index') }}" class="module-card content-card h-100 text-decoration-none">
                        <div class="module-icon bg-secondary-subtle text-secondary">
                            <i class="fa-solid fa-heart-circle-check"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Bien-être au travail</h5>
                        <p class="text-muted mb-3">
                            Signalements, accompagnement, incidents, suivi humain et dossiers sensibles.
                        </p>
                        <div class="module-link">
                            Ouvrir le module <i class="fa-solid fa-arrow-right ms-2"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        {{-- Alertes + Activités --}}
        <div class="col-xl-5">
            <div class="content-card h-100">
                <div class="section-head mb-4">
                    <div>
                        <h5 class="fw-bold mb-1">Alertes RH</h5>
                        <p class="text-muted mb-0">Points sensibles qui demandent une attention rapide.</p>
                    </div>
                </div>

                <div class="alert-feed">
                    @php
                        $hasAlertes =
                            ($alertes['conges_en_attente']->count() ?? 0) ||
                            ($alertes['recrutements_sans_responsable']->count() ?? 0) ||
                            ($alertes['evaluations_en_retard']->count() ?? 0) ||
                            ($alertes['sanctions_actives']->count() ?? 0) ||
                            ($alertes['bien_etre_urgent']->count() ?? 0);
                    @endphp

                    @if($hasAlertes)
                        @foreach(($alertes['conges_en_attente'] ?? collect()) as $conge)
                            <div class="alert-item">
                                <div class="alert-icon bg-warning-subtle text-warning">
                                    <i class="fa-solid fa-calendar-xmark"></i>
                                </div>
                                <div class="alert-content">
                                    <div class="alert-title">Congé en attente</div>
                                    <div class="alert-text">
                                        {{ optional($conge->membreEquipe)->nom }} {{ optional($conge->membreEquipe)->prenom }}
                                    </div>
                                </div>
                                <a href="{{ route('rh.conges.show', $conge) }}" class="btn btn-sm btn-light rounded-pill px-3">
                                    Voir
                                </a>
                            </div>
                        @endforeach

                        @foreach(($alertes['recrutements_sans_responsable'] ?? collect()) as $recrutement)
                            <div class="alert-item">
                                <div class="alert-icon bg-info-subtle text-info">
                                    <i class="fa-solid fa-user-slash"></i>
                                </div>
                                <div class="alert-content">
                                    <div class="alert-title">Recrutement sans responsable</div>
                                    <div class="alert-text">{{ $recrutement->titre }}</div>
                                </div>
                                <a href="{{ route('rh.recrutements.show', $recrutement) }}" class="btn btn-sm btn-light rounded-pill px-3">
                                    Voir
                                </a>
                            </div>
                        @endforeach

                        @foreach(($alertes['evaluations_en_retard'] ?? collect()) as $evaluation)
                            <div class="alert-item">
                                <div class="alert-icon bg-danger-subtle text-danger">
                                    <i class="fa-solid fa-file-circle-exclamation"></i>
                                </div>
                                <div class="alert-content">
                                    <div class="alert-title">Évaluation en retard</div>
                                    <div class="alert-text">
                                        {{ optional($evaluation->membreEquipe)->nom }} {{ optional($evaluation->membreEquipe)->prenom }}
                                    </div>
                                </div>
                                <a href="{{ route('rh.evaluations.show', $evaluation) }}" class="btn btn-sm btn-light rounded-pill px-3">
                                    Voir
                                </a>
                            </div>
                        @endforeach

                        @foreach(($alertes['sanctions_actives'] ?? collect()) as $sanction)
                            <div class="alert-item">
                                <div class="alert-icon bg-danger-subtle text-danger">
                                    <i class="fa-solid fa-triangle-exclamation"></i>
                                </div>
                                <div class="alert-content">
                                    <div class="alert-title">Sanction active</div>
                                    <div class="alert-text">
                                        {{ optional($sanction->membreEquipe)->nom }} {{ optional($sanction->membreEquipe)->prenom }}
                                    </div>
                                </div>
                                <a href="{{ route('rh.sanctions.show', $sanction) }}" class="btn btn-sm btn-light rounded-pill px-3">
                                    Voir
                                </a>
                            </div>
                        @endforeach

                        @foreach(($alertes['bien_etre_urgent'] ?? collect()) as $dossier)
                            <div class="alert-item">
                                <div class="alert-icon bg-secondary-subtle text-secondary">
                                    <i class="fa-solid fa-heart-crack"></i>
                                </div>
                                <div class="alert-content">
                                    <div class="alert-title">Bien-être prioritaire</div>
                                    <div class="alert-text">{{ $dossier->titre }}</div>
                                </div>
                                <a href="{{ route('rh.bien-etre.show', $dossier) }}" class="btn btn-sm btn-light rounded-pill px-3">
                                    Voir
                                </a>
                            </div>
                        @endforeach
                    @else
                        <div class="empty-state small-empty-state">
                            <i class="fa-solid fa-circle-check empty-state-icon"></i>
                            <h6 class="mt-3">Aucune alerte critique</h6>
                            <p class="text-muted mb-0">La chambre RH ne présente aucune urgence pour le moment.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-xl-7">
            <div class="content-card h-100">
                <div class="section-head mb-4">
                    <div>
                        <h5 class="fw-bold mb-1">Activités récentes</h5>
                        <p class="text-muted mb-0">Tout ce qui bouge dans la chambre RH en temps réel.</p>
                    </div>
                </div>

                <div class="activity-feed">
                    @forelse($activites as $activite)
                        <div class="activity-item">
                            <div class="activity-bullet
                                @if($activite['type'] === 'conge') bg-warning-subtle text-warning
                                @elseif($activite['type'] === 'candidature') bg-info-subtle text-info
                                @elseif($activite['type'] === 'evaluation') bg-success-subtle text-success
                                @elseif($activite['type'] === 'sanction') bg-danger-subtle text-danger
                                @elseif($activite['type'] === 'bien_etre') bg-secondary-subtle text-secondary
                                @else bg-primary-subtle text-primary
                                @endif">
                                @if($activite['type'] === 'conge')
                                    <i class="fa-solid fa-calendar-days"></i>
                                @elseif($activite['type'] === 'candidature')
                                    <i class="fa-solid fa-user-plus"></i>
                                @elseif($activite['type'] === 'evaluation')
                                    <i class="fa-solid fa-chart-line"></i>
                                @elseif($activite['type'] === 'sanction')
                                    <i class="fa-solid fa-scale-balanced"></i>
                                @elseif($activite['type'] === 'bien_etre')
                                    <i class="fa-solid fa-heart-circle-check"></i>
                                @else
                                    <i class="fa-solid fa-folder-open"></i>
                                @endif
                            </div>

                            <div class="activity-content">
                                <div class="d-flex justify-content-between align-items-start gap-3 flex-wrap">
                                    <div>
                                        <div class="activity-title">{{ $activite['titre'] }}</div>
                                        <div class="activity-text">{{ $activite['description'] }}</div>
                                        <div class="activity-meta">
                                            <span class="badge rounded-pill text-bg-light border">{{ ucfirst(str_replace('_', ' ', $activite['statut'] ?? '')) }}</span>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center gap-2">
                                        <span class="activity-time">
                                            {{ \Carbon\Carbon::parse($activite['date'])->diffForHumans() }}
                                        </span>
                                        <a href="{{ $activite['url'] }}" class="btn btn-sm btn-light rounded-pill px-3">
                                            Ouvrir
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state small-empty-state">
                            <i class="fa-solid fa-clock-rotate-left empty-state-icon"></i>
                            <h6 class="mt-3">Aucune activité récente</h6>
                            <p class="text-muted mb-0">Les actions RH récentes apparaîtront ici.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Tableaux synthétiques --}}
        <div class="col-12">
            <div class="row g-4">
                <div class="col-xl-6">
                    <div class="content-card h-100">
                        <div class="table-head-custom mb-4">
                            <div>
                                <h5 class="mb-1 fw-bold">Synthèse des congés</h5>
                                <p class="text-muted mb-0">Lecture rapide des statuts de congés.</p>
                            </div>

                            <a href="{{ route('rh.conges.index') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                Voir tout
                            </a>
                        </div>

                        <div class="table-responsive">
                            <table class="table align-middle custom-table mb-0">
                                <thead>
                                    <tr>
                                        <th>Statut</th>
                                        <th>Total</th>
                                        <th class="text-end">Accès</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><span class="badge rounded-pill text-bg-warning">En attente</span></td>
                                        <td>{{ $widgets['conges_par_statut']['en_attente'] ?? 0 }}</td>
                                        <td class="text-end">
                                            <a href="{{ route('rh.conges.en-attente') }}" class="btn btn-sm btn-light rounded-pill px-3">Ouvrir</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="badge rounded-pill text-bg-success">Validés</span></td>
                                        <td>{{ $widgets['conges_par_statut']['valide'] ?? 0 }}</td>
                                        <td class="text-end">
                                            <a href="{{ route('rh.conges.valides') }}" class="btn btn-sm btn-light rounded-pill px-3">Ouvrir</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="badge rounded-pill text-bg-danger">Refusés</span></td>
                                        <td>{{ $widgets['conges_par_statut']['refuse'] ?? 0 }}</td>
                                        <td class="text-end">
                                            <a href="{{ route('rh.conges.refuses') }}" class="btn btn-sm btn-light rounded-pill px-3">Ouvrir</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="badge rounded-pill text-bg-secondary">Annulés</span></td>
                                        <td>{{ $widgets['conges_par_statut']['annule'] ?? 0 }}</td>
                                        <td class="text-end">
                                            <a href="{{ route('rh.conges.annules') }}" class="btn btn-sm btn-light rounded-pill px-3">Ouvrir</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="content-card h-100">
                        <div class="table-head-custom mb-4">
                            <div>
                                <h5 class="mb-1 fw-bold">Pipeline candidatures</h5>
                                <p class="text-muted mb-0">Suivi rapide des étapes du recrutement.</p>
                            </div>

                            <a href="{{ route('rh.candidatures.index') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                Voir tout
                            </a>
                        </div>

                        <div class="table-responsive">
                            <table class="table align-middle custom-table mb-0">
                                <thead>
                                    <tr>
                                        <th>Étape</th>
                                        <th>Total</th>
                                        <th class="text-end">Accès</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><span class="badge rounded-pill text-bg-light border">Reçues</span></td>
                                        <td>{{ $widgets['candidatures_par_statut']['recu'] ?? 0 }}</td>
                                        <td class="text-end">
                                            <a href="{{ route('rh.candidatures.index') }}" class="btn btn-sm btn-light rounded-pill px-3">Ouvrir</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="badge rounded-pill text-bg-info">En étude</span></td>
                                        <td>{{ $widgets['candidatures_par_statut']['en_etude'] ?? 0 }}</td>
                                        <td class="text-end">
                                            <a href="{{ route('rh.candidatures.en-etude') }}" class="btn btn-sm btn-light rounded-pill px-3">Ouvrir</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="badge rounded-pill text-bg-warning">Entretien</span></td>
                                        <td>{{ $widgets['candidatures_par_statut']['entretien'] ?? 0 }}</td>
                                        <td class="text-end">
                                            <a href="{{ route('rh.candidatures.entretiens') }}" class="btn btn-sm btn-light rounded-pill px-3">Ouvrir</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="badge rounded-pill text-bg-success">Retenues</span></td>
                                        <td>{{ $widgets['candidatures_par_statut']['retenu'] ?? 0 }}</td>
                                        <td class="text-end">
                                            <a href="{{ route('rh.candidatures.retenues') }}" class="btn btn-sm btn-light rounded-pill px-3">Ouvrir</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="badge rounded-pill text-bg-danger">Rejetées</span></td>
                                        <td>{{ $widgets['candidatures_par_statut']['rejete'] ?? 0 }}</td>
                                        <td class="text-end">
                                            <a href="{{ route('rh.candidatures.rejetees') }}" class="btn btn-sm btn-light rounded-pill px-3">Ouvrir</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Raccourcis opérationnels --}}
        <div class="col-12">
            <div class="content-card">
                <div class="table-head-custom mb-4">
                    <div>
                        <h5 class="mb-1 fw-bold">Actions rapides</h5>
                        <p class="text-muted mb-0">Passe d’une fenêtre RH à l’autre sans friction.</p>
                    </div>
                </div>

                <div class="quick-grid-rh">
                    <a href="{{ route('rh.dossiers-personnel.create') }}" class="quick-action-card">
                        <div class="quick-action-icon bg-primary-subtle text-primary">
                            <i class="fa-solid fa-id-card"></i>
                        </div>
                        <div>
                            <div class="quick-action-title">Créer un dossier</div>
                            <div class="quick-action-text">Ajouter un nouveau dossier du personnel</div>
                        </div>
                    </a>

                    <a href="{{ route('rh.conges.create') }}" class="quick-action-card">
                        <div class="quick-action-icon bg-warning-subtle text-warning">
                            <i class="fa-solid fa-calendar-plus"></i>
                        </div>
                        <div>
                            <div class="quick-action-title">Nouvelle demande</div>
                            <div class="quick-action-text">Créer une demande de congé</div>
                        </div>
                    </a>

                    <a href="{{ route('rh.recrutements.create') }}" class="quick-action-card">
                        <div class="quick-action-icon bg-info-subtle text-info">
                            <i class="fa-solid fa-briefcase"></i>
                        </div>
                        <div>
                            <div class="quick-action-title">Nouveau recrutement</div>
                            <div class="quick-action-text">Ouvrir une nouvelle campagne RH</div>
                        </div>
                    </a>

                    <a href="{{ route('rh.candidatures.create') }}" class="quick-action-card">
                        <div class="quick-action-icon bg-success-subtle text-success">
                            <i class="fa-solid fa-user-check"></i>
                        </div>
                        <div>
                            <div class="quick-action-title">Nouvelle candidature</div>
                            <div class="quick-action-text">Ajouter un candidat manuellement</div>
                        </div>
                    </a>

                    <a href="{{ route('rh.presences.create') }}" class="quick-action-card">
                        <div class="quick-action-icon bg-success-subtle text-success">
                            <i class="fa-solid fa-clock"></i>
                        </div>
                        <div>
                            <div class="quick-action-title">Nouvelle présence</div>
                            <div class="quick-action-text">Enregistrer un pointage RH</div>
                        </div>
                    </a>

                    <a href="{{ route('rh.evaluations.create') }}" class="quick-action-card">
                        <div class="quick-action-icon bg-warning-subtle text-warning">
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <div>
                            <div class="quick-action-title">Nouvelle évaluation</div>
                            <div class="quick-action-text">Créer une évaluation du personnel</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

    </div>

    <style>
        .mini-label{
            font-size:13px;
            color:#64748b;
            font-weight:700;
            margin-bottom:8px
        }
        .stat-number{
            font-size:34px;
            font-weight:800;
            margin:0
        }
        .stat-icon{
            width:58px;
            height:58px;
            border-radius:18px;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:22px;
            flex-shrink:0
        }
        .stat-meta{
            display:flex;
            flex-wrap:wrap;
            gap:8px
        }
        .hero-rh-card{
            position:relative;
            overflow:hidden;
            background:linear-gradient(135deg, rgba(17,177,173,.06), rgba(59,130,246,.06));
            border:1px solid rgba(17,177,173,.12)
        }
        .hero-badge{
            display:inline-flex;
            align-items:center;
            padding:8px 14px;
            border-radius:999px;
            background:rgba(17,177,173,.1);
            color:#0f766e;
            font-size:13px;
            font-weight:700
        }
        .module-card{
            transition:all .25s ease;
            border:1px solid transparent
        }
        .module-card:hover{
            transform:translateY(-4px);
            border-color:#dbeafe;
            box-shadow:0 14px 34px rgba(15,23,42,.08)
        }
        .module-icon{
            width:58px;
            height:58px;
            border-radius:18px;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:22px;
            margin-bottom:18px
        }
        .module-link{
            font-weight:700;
            color:#2563eb;
            font-size:14px
        }
        .section-head{
            display:flex;
            justify-content:space-between;
            align-items:center;
            gap:16px;
            flex-wrap:wrap
        }
        .alert-feed,
        .activity-feed{
            display:flex;
            flex-direction:column;
            gap:14px
        }
        .alert-item,
        .activity-item{
            display:flex;
            gap:14px;
            align-items:flex-start;
            padding:14px;
            border:1px solid #eef2f7;
            border-radius:18px;
            background:#fff
        }
        .alert-icon,
        .activity-bullet{
            width:46px;
            height:46px;
            border-radius:16px;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:18px;
            flex-shrink:0
        }
        .alert-content,
        .activity-content{
            flex:1;
            min-width:0
        }
        .alert-title,
        .activity-title{
            font-weight:800;
            color:#0f172a;
            margin-bottom:3px
        }
        .alert-text,
        .activity-text{
            font-size:14px;
            color:#64748b
        }
        .activity-meta{
            margin-top:8px
        }
        .activity-time{
            color:#94a3b8;
            font-size:12px;
            white-space:nowrap
        }
        .table-head-custom{
            display:flex;
            justify-content:space-between;
            align-items:center;
            gap:16px;
            flex-wrap:wrap
        }
        .custom-table thead th{
            font-size:13px;
            text-transform:uppercase;
            letter-spacing:.5px;
            color:#64748b;
            border-bottom:1px solid #e5e7eb
        }
        .custom-table tbody td{
            border-bottom:1px solid #f1f5f9
        }
        .quick-grid-rh{
            display:grid;
            grid-template-columns:repeat(auto-fit, minmax(260px, 1fr));
            gap:16px
        }
        .quick-action-card{
            display:flex;
            align-items:center;
            gap:14px;
            padding:16px;
            border:1px solid #eef2f7;
            border-radius:20px;
            background:#fff;
            text-decoration:none;
            color:inherit;
            transition:all .25s ease
        }
        .quick-action-card:hover{
            transform:translateY(-3px);
            border-color:#dbeafe;
            box-shadow:0 14px 34px rgba(15,23,42,.06)
        }
        .quick-action-icon{
            width:52px;
            height:52px;
            border-radius:16px;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:20px;
            flex-shrink:0
        }
        .quick-action-title{
            font-weight:800;
            color:#0f172a;
            margin-bottom:4px
        }
        .quick-action-text{
            font-size:14px;
            color:#64748b
        }
        .empty-state{
            padding:20px;
            text-align:center
        }
        .small-empty-state{
            padding:30px 20px
        }
        .empty-state-icon{
            font-size:42px;
            color:#94a3b8
        }

        @media (max-width: 991.98px){
            .stat-number{
                font-size:28px
            }
        }
    </style>
@endsection