@extends('back.layouts.principal')

@section('title', 'Détail du dossier du personnel')
@section('page_title', 'Fiche du personnel')
@section('page_subtitle', 'Vue 360° du collaborateur avec accès rapide aux documents, historiques, congés, présences, évaluations et sanctions.')

@section('content')
    @php
        $membre = $dossier->membreEquipe;
    @endphp

    <div class="row g-4">

        <div class="col-12">
            <div class="content-card profile-hero-card">
                <div class="d-flex flex-wrap justify-content-between align-items-start gap-4">
                    <div class="d-flex align-items-center gap-4">
                        <div class="profile-big-avatar bg-primary-subtle text-primary">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <div>
                            <h3 class="fw-bold mb-1">{{ optional($membre)->nom }} {{ optional($membre)->prenom }}</h3>
                            <div class="text-muted mb-2">
                                {{ optional(optional($membre)->poste)->nom ?? 'Poste non défini' }} •
                                {{ optional(optional($membre)->departement)->nom ?? 'Département non défini' }}
                            </div>
                            <div class="d-flex flex-wrap gap-2">
                                <span class="badge rounded-pill text-bg-light border">Matricule : {{ $dossier->matricule }}</span>
                                <span class="badge rounded-pill text-bg-success">{{ ucfirst(str_replace('_', ' ', $dossier->statut_professionnel)) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('rh.dossiers-personnel.edit', $dossier) }}" class="btn btn-warning rounded-pill px-4">
                            <i class="fa-solid fa-pen me-2"></i>Modifier
                        </a>
                        <a href="{{ route('rh.dossiers-personnel.timeline', $dossier) }}" class="btn btn-outline-primary rounded-pill px-4">
                            <i class="fa-solid fa-clock-rotate-left me-2"></i>Timeline
                        </a>
                        <a href="{{ route('rh.dossiers-personnel.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            <i class="fa-solid fa-arrow-left me-2"></i>Retour
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Cartes infos --}}
        <div class="col-xl-4">
            <div class="content-card h-100">
                <h5 class="fw-bold mb-4">Informations RH</h5>

                <div class="info-list">
                    <div class="info-row">
                        <span class="info-label">Email pro</span>
                        <span class="info-value">{{ optional($membre)->email_professionnel ?? '—' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Téléphone</span>
                        <span class="info-value">{{ optional($membre)->telephone ?? '—' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Date naissance</span>
                        <span class="info-value">{{ $dossier->date_naissance?->format('d/m/Y') ?? '—' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Date embauche</span>
                        <span class="info-value">{{ $dossier->date_embauche?->format('d/m/Y') ?? '—' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">CNSS</span>
                        <span class="info-value">{{ $dossier->numero_cnss ?? '—' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Pièce identité</span>
                        <span class="info-value">{{ $dossier->numero_piece_identite ?? '—' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Adresse</span>
                        <span class="info-value">{{ $dossier->adresse ?? '—' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Salaire base</span>
                        <span class="info-value">{{ $dossier->salaire_base ? number_format($dossier->salaire_base, 2, ',', ' ') : '—' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8">
            <div class="row g-4">
                <div class="col-md-6 col-xl-3">
                    <a href="{{ route('rh.dossiers-personnel.documents', $dossier) }}" class="text-decoration-none">
                        <div class="content-card h-100 mini-module-card">
                            <div class="mini-module-icon bg-primary-subtle text-primary">
                                <i class="fa-solid fa-folder-open"></i>
                            </div>
                            <h6 class="fw-bold mb-1">Documents</h6>
                            <p class="text-muted small mb-0">Pièces et documents RH</p>
                        </div>
                    </a>
                </div>

                <div class="col-md-6 col-xl-3">
                    <a href="{{ route('rh.dossiers-personnel.presences', $dossier) }}" class="text-decoration-none">
                        <div class="content-card h-100 mini-module-card">
                            <div class="mini-module-icon bg-success-subtle text-success">
                                <i class="fa-solid fa-clock"></i>
                            </div>
                            <h6 class="fw-bold mb-1">Présences</h6>
                            <p class="text-muted small mb-0">Historique de pointage</p>
                        </div>
                    </a>
                </div>

                <div class="col-md-6 col-xl-3">
                    <a href="{{ route('rh.dossiers-personnel.conges', $dossier) }}" class="text-decoration-none">
                        <div class="content-card h-100 mini-module-card">
                            <div class="mini-module-icon bg-warning-subtle text-warning">
                                <i class="fa-solid fa-calendar-days"></i>
                            </div>
                            <h6 class="fw-bold mb-1">Congés</h6>
                            <p class="text-muted small mb-0">Demandes et historique</p>
                        </div>
                    </a>
                </div>

                <div class="col-md-6 col-xl-3">
                    <a href="{{ route('rh.dossiers-personnel.evaluations', $dossier) }}" class="text-decoration-none">
                        <div class="content-card h-100 mini-module-card">
                            <div class="mini-module-icon bg-info-subtle text-info">
                                <i class="fa-solid fa-chart-line"></i>
                            </div>
                            <h6 class="fw-bold mb-1">Évaluations</h6>
                            <p class="text-muted small mb-0">Performance et suivi</p>
                        </div>
                    </a>
                </div>

                <div class="col-12">
                    <div class="content-card">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3">
                            <div>
                                <h5 class="fw-bold mb-1">Notes RH</h5>
                                <p class="text-muted mb-0">Résumé administratif et informations internes.</p>
                            </div>
                        </div>

                        <div class="note-box">
                            {{ $dossier->notes ?: 'Aucune note RH renseignée pour ce collaborateur.' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Quick access --}}
        <div class="col-12">
            <div class="content-card">
                <div class="table-head-custom mb-4">
                    <div>
                        <h5 class="fw-bold mb-1">Navigation rapide</h5>
                        <p class="text-muted mb-0">Passe d’une vue à l’autre sans perdre le contexte employé.</p>
                    </div>
                </div>

                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('rh.dossiers-personnel.historique', $dossier) }}" class="btn btn-outline-secondary rounded-pill px-4">Historique</a>
                    <a href="{{ route('rh.dossiers-personnel.timeline', $dossier) }}" class="btn btn-outline-secondary rounded-pill px-4">Timeline</a>
                    <a href="{{ route('rh.dossiers-personnel.documents', $dossier) }}" class="btn btn-outline-primary rounded-pill px-4">Documents</a>
                    <a href="{{ route('rh.dossiers-personnel.presences', $dossier) }}" class="btn btn-outline-success rounded-pill px-4">Présences</a>
                    <a href="{{ route('rh.dossiers-personnel.conges', $dossier) }}" class="btn btn-outline-warning rounded-pill px-4">Congés</a>
                    <a href="{{ route('rh.dossiers-personnel.evaluations', $dossier) }}" class="btn btn-outline-info rounded-pill px-4">Évaluations</a>
                    <a href="{{ route('rh.dossiers-personnel.sanctions', $dossier) }}" class="btn btn-outline-danger rounded-pill px-4">Sanctions</a>
                    <a href="{{ route('rh.dossiers-personnel.contrats', $dossier) }}" class="btn btn-outline-dark rounded-pill px-4">Contrats</a>
                </div>
            </div>
        </div>

    </div>

    <style>
        .profile-hero-card{background:linear-gradient(135deg, rgba(17,177,173,.05), rgba(59,130,246,.05))}
        .profile-big-avatar{width:86px;height:86px;border-radius:24px;display:flex;align-items:center;justify-content:center;font-size:30px}
        .info-list{display:flex;flex-direction:column;gap:14px}
        .info-row{display:flex;justify-content:space-between;gap:16px;padding-bottom:12px;border-bottom:1px solid #f1f5f9}
        .info-label{font-size:14px;color:#64748b;font-weight:700}
        .info-value{font-size:14px;color:#0f172a;text-align:right;font-weight:600}
        .mini-module-card{transition:all .25s ease}
        .mini-module-card:hover{transform:translateY(-4px);box-shadow:0 14px 34px rgba(15,23,42,.06)}
        .mini-module-icon{width:54px;height:54px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:20px;margin-bottom:16px}
        .note-box{background:#f8fafc;border:1px solid #e5e7eb;border-radius:18px;padding:18px;line-height:1.7;color:#334155}
        .table-head-custom{display:flex;justify-content:space-between;align-items:center;gap:16px;flex-wrap:wrap}
    </style>
@endsection
