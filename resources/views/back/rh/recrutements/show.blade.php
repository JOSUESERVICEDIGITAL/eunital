@extends('back.layouts.principal')

@section('title', 'Détail du recrutement')
@section('page_title', 'Détail du recrutement')
@section('page_subtitle', 'Vue détaillée de la campagne RH avec accès au pipeline, dashboard interne, candidatures et actions métier.')

@section('content')
    <div class="row g-4">

        <div class="col-12">
            <div class="content-card hero-card">
                <div class="d-flex flex-wrap justify-content-between align-items-start gap-4">
                    <div class="d-flex align-items-center gap-4">
                        <div class="hero-icon bg-info-subtle text-info">
                            <i class="fa-solid fa-user-group"></i>
                        </div>
                        <div>
                            <h3 class="fw-bold mb-1">{{ $recrutement->titre }}</h3>
                            <div class="text-muted mb-2">
                                {{ optional($recrutement->departement)->nom ?? 'Département non défini' }}
                                • {{ optional($recrutement->poste)->nom ?? 'Poste non défini' }}
                            </div>
                            <div class="d-flex flex-wrap gap-2">
                                @php
                                    $statusClass = match($recrutement->statut) {
                                        'brouillon' => 'text-bg-secondary',
                                        'ouvert' => 'text-bg-success',
                                        'en_cours' => 'text-bg-info',
                                        'ferme' => 'text-bg-warning',
                                        'archive' => 'text-bg-dark',
                                        default => 'text-bg-light'
                                    };
                                @endphp
                                <span class="badge rounded-pill {{ $statusClass }}">
                                    {{ ucfirst(str_replace('_', ' ', $recrutement->statut)) }}
                                </span>
                                <span class="badge rounded-pill text-bg-light border">
                                    {{ $recrutement->slug }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('rh.recrutements.edit', $recrutement) }}" class="btn btn-warning rounded-pill px-4">
                            <i class="fa-solid fa-pen me-2"></i>Modifier
                        </a>
                        <a href="{{ route('rh.recrutements.pipeline', $recrutement) }}" class="btn btn-outline-primary rounded-pill px-4">
                            <i class="fa-solid fa-diagram-project me-2"></i>Pipeline
                        </a>
                        <a href="{{ route('rh.recrutements.dashboard', $recrutement) }}" class="btn btn-outline-info rounded-pill px-4">
                            <i class="fa-solid fa-chart-column me-2"></i>Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="content-card h-100">
                <h5 class="fw-bold mb-4">Informations principales</h5>

                <div class="info-list">
                    <div class="info-row">
                        <span class="info-label">Responsable</span>
                        <span class="info-value">{{ optional($recrutement->responsable)->name ?? '—' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Département</span>
                        <span class="info-value">{{ optional($recrutement->departement)->nom ?? '—' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Poste</span>
                        <span class="info-value">{{ optional($recrutement->poste)->nom ?? '—' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Contrat</span>
                        <span class="info-value">{{ strtoupper($recrutement->type_contrat) }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Ouverture</span>
                        <span class="info-value">{{ $recrutement->date_ouverture?->format('d/m/Y') ?? '—' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Clôture</span>
                        <span class="info-value">{{ $recrutement->date_cloture?->format('d/m/Y') ?? '—' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Candidatures</span>
                        <span class="info-value">{{ $stats['total'] ?? 0 }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8">
            <div class="row g-4">
                <div class="col-md-6 col-xl-3">
                    <div class="content-card h-100 mini-kpi-card">
                        <div class="mini-label">Reçues</div>
                        <h3 class="stat-number">{{ $stats['recu'] ?? 0 }}</h3>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="content-card h-100 mini-kpi-card">
                        <div class="mini-label">En étude</div>
                        <h3 class="stat-number">{{ $stats['en_etude'] ?? 0 }}</h3>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="content-card h-100 mini-kpi-card">
                        <div class="mini-label">Entretien</div>
                        <h3 class="stat-number">{{ $stats['entretien'] ?? 0 }}</h3>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="content-card h-100 mini-kpi-card">
                        <div class="mini-label">Retenues</div>
                        <h3 class="stat-number text-success">{{ $stats['retenu'] ?? 0 }}</h3>
                    </div>
                </div>

                <div class="col-12">
                    <div class="content-card">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3">
                            <div>
                                <h5 class="fw-bold mb-1">Description du besoin</h5>
                                <p class="text-muted mb-0">Résumé du recrutement et du poste à pourvoir.</p>
                            </div>
                        </div>

                        <div class="note-box">
                            {{ $recrutement->description ?: 'Aucune description renseignée.' }}
                        </div>

                        <hr class="my-4">

                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('rh.candidatures.par-recrutement', $recrutement) }}" class="btn btn-outline-primary rounded-pill px-4">
                                <i class="fa-solid fa-users-viewfinder me-2"></i>Voir les candidatures
                            </a>

                            @if($recrutement->statut !== 'ouvert')
                                <form method="POST" action="{{ route('rh.recrutements.ouvrir', $recrutement) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-success rounded-pill px-4">Ouvrir</button>
                                </form>
                            @endif

                            @if(!in_array($recrutement->statut, ['ferme', 'archive']))
                                <form method="POST" action="{{ route('rh.recrutements.fermer', $recrutement) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-warning rounded-pill px-4">Fermer</button>
                                </form>
                            @endif

                            @if($recrutement->statut !== 'archive')
                                <form method="POST" action="{{ route('rh.recrutements.archiver', $recrutement) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-secondary rounded-pill px-4">Archiver</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="content-card">
                        <div class="table-head-custom mb-4">
                            <div>
                                <h5 class="mb-1 fw-bold">Candidatures récentes</h5>
                                <p class="text-muted mb-0">Aperçu rapide des derniers profils reçus.</p>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table align-middle custom-table mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Candidat</th>
                                        <th>Email</th>
                                        <th>Statut</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recrutement->candidatures->take(8) as $candidature)
                                        <tr>
                                            <td>{{ $candidature->id }}</td>
                                            <td>{{ $candidature->nom }} {{ $candidature->prenom }}</td>
                                            <td>{{ $candidature->email ?? '—' }}</td>
                                            <td>
                                                <span class="badge rounded-pill text-bg-light border">
                                                    {{ ucfirst(str_replace('_', ' ', $candidature->statut)) }}
                                                </span>
                                            </td>
                                            <td class="text-end">
                                                <a href="{{ route('rh.candidatures.show', $candidature) }}" class="btn btn-sm btn-light rounded-pill px-3">
                                                    Voir
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-4 text-muted">
                                                Aucune candidature pour ce recrutement.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <style>
        .hero-card{background:linear-gradient(135deg, rgba(17,177,173,.06), rgba(59,130,246,.05))}
        .hero-icon{width:86px;height:86px;border-radius:24px;display:flex;align-items:center;justify-content:center;font-size:30px}
        .info-list{display:flex;flex-direction:column;gap:14px}
        .info-row{display:flex;justify-content:space-between;gap:16px;padding-bottom:12px;border-bottom:1px solid #f1f5f9}
        .info-label{font-size:14px;color:#64748b;font-weight:700}
        .info-value{font-size:14px;color:#0f172a;text-align:right;font-weight:600}
        .note-box{background:#f8fafc;border:1px solid #e5e7eb;border-radius:18px;padding:18px;line-height:1.7;color:#334155}
        .mini-label{font-size:13px;color:#64748b;font-weight:700;margin-bottom:8px}
        .stat-number{font-size:30px;font-weight:800;margin:0}
        .table-head-custom{display:flex;justify-content:space-between;align-items:center;gap:16px;flex-wrap:wrap}
        .custom-table thead th{font-size:13px;text-transform:uppercase;letter-spacing:.5px;color:#64748b;border-bottom:1px solid #e5e7eb}
        .custom-table tbody td{border-bottom:1px solid #f1f5f9}
    </style>
@endsection