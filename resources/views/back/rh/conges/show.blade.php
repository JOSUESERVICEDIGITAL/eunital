@extends('back.layouts.principal')

@section('title', 'Détail du congé')
@section('page_title', 'Détail du congé')
@section('page_subtitle', 'Vue détaillée de la demande de congé avec actions de validation, refus, annulation et navigation RH rapide.')

@section('content')
    <div class="row g-4">
        <div class="col-12">
            <div class="content-card hero-card">
                <div class="d-flex flex-wrap justify-content-between align-items-start gap-4">
                    <div class="d-flex align-items-center gap-4">
                        <div class="hero-icon bg-warning-subtle text-warning">
                            <i class="fa-solid fa-calendar-days"></i>
                        </div>
                        <div>
                            <h3 class="fw-bold mb-1">
                                {{ optional($conge->membreEquipe)->nom }} {{ optional($conge->membreEquipe)->prenom }}
                            </h3>
                            <div class="text-muted mb-2">
                                {{ ucfirst(str_replace('_', ' ', $conge->type_conge)) }}
                                • {{ $conge->date_debut?->format('d/m/Y') ?? '—' }} → {{ $conge->date_fin?->format('d/m/Y') ?? '—' }}
                            </div>
                            <div class="d-flex flex-wrap gap-2">
                                @php
                                    $statusClass = match($conge->statut) {
                                        'en_attente' => 'text-bg-warning',
                                        'valide' => 'text-bg-success',
                                        'refuse' => 'text-bg-danger',
                                        'annule' => 'text-bg-secondary',
                                        default => 'text-bg-light'
                                    };
                                @endphp
                                <span class="badge rounded-pill {{ $statusClass }}">
                                    {{ ucfirst(str_replace('_', ' ', $conge->statut)) }}
                                </span>
                                <span class="badge rounded-pill text-bg-dark">
                                    {{ $conge->nombre_jours ?? '—' }} jours
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('rh.conges.edit', $conge) }}" class="btn btn-warning rounded-pill px-4">
                            <i class="fa-solid fa-pen me-2"></i>Modifier
                        </a>

                        @if($conge->statut === 'en_attente')
                            <form method="POST" action="{{ route('rh.conges.valider', $conge) }}">
                                @csrf
                                <button type="submit" class="btn btn-success rounded-pill px-4">
                                    <i class="fa-solid fa-check me-2"></i>Valider
                                </button>
                            </form>

                            <form method="POST" action="{{ route('rh.conges.refuser', $conge) }}">
                                @csrf
                                <button type="submit" class="btn btn-danger rounded-pill px-4">
                                    <i class="fa-solid fa-xmark me-2"></i>Refuser
                                </button>
                            </form>
                        @endif

                        @if($conge->statut !== 'annule')
                            <form method="POST" action="{{ route('rh.conges.annuler', $conge) }}">
                                @csrf
                                <button type="submit" class="btn btn-outline-secondary rounded-pill px-4">
                                    <i class="fa-solid fa-ban me-2"></i>Annuler
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="content-card h-100">
                <h5 class="fw-bold mb-4">Informations principales</h5>

                <div class="info-list">
                    <div class="info-row">
                        <span class="info-label">Employé</span>
                        <span class="info-value">{{ optional($conge->membreEquipe)->nom }} {{ optional($conge->membreEquipe)->prenom }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Département</span>
                        <span class="info-value">{{ optional(optional($conge->membreEquipe)->departement)->nom ?? '—' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Type</span>
                        <span class="info-value">{{ ucfirst(str_replace('_', ' ', $conge->type_conge)) }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Date début</span>
                        <span class="info-value">{{ $conge->date_debut?->format('d/m/Y') ?? '—' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Date fin</span>
                        <span class="info-value">{{ $conge->date_fin?->format('d/m/Y') ?? '—' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Jours</span>
                        <span class="info-value">{{ $conge->nombre_jours ?? '—' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Validateur</span>
                        <span class="info-value">{{ optional($conge->validateur)->name ?? '—' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8">
            <div class="content-card h-100">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3">
                    <div>
                        <h5 class="fw-bold mb-1">Motif de la demande</h5>
                        <p class="text-muted mb-0">Contexte et justification RH du congé.</p>
                    </div>
                </div>

                <div class="note-box">
                    {{ $conge->motif ?: 'Aucun motif renseigné.' }}
                </div>

                <hr class="my-4">

                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('rh.conges.par-employe', $conge->membreEquipe) }}" class="btn btn-outline-primary rounded-pill px-4">
                        <i class="fa-solid fa-user me-2"></i>Voir les congés de l’employé
                    </a>
                    <a href="{{ route('rh.conges.historique') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="fa-solid fa-clock-rotate-left me-2"></i>Historique global
                    </a>
                    <a href="{{ route('rh.conges.calendrier') }}" class="btn btn-outline-info rounded-pill px-4">
                        <i class="fa-solid fa-calendar-week me-2"></i>Calendrier
                    </a>
                </div>
            </div>
        </div>
    </div>

    <style>
        .hero-card{background:linear-gradient(135deg, rgba(245,158,11,.06), rgba(17,177,173,.04))}
        .hero-icon{width:86px;height:86px;border-radius:24px;display:flex;align-items:center;justify-content:center;font-size:30px}
        .info-list{display:flex;flex-direction:column;gap:14px}
        .info-row{display:flex;justify-content:space-between;gap:16px;padding-bottom:12px;border-bottom:1px solid #f1f5f9}
        .info-label{font-size:14px;color:#64748b;font-weight:700}
        .info-value{font-size:14px;color:#0f172a;text-align:right;font-weight:600}
        .note-box{background:#f8fafc;border:1px solid #e5e7eb;border-radius:18px;padding:18px;line-height:1.7;color:#334155}
    </style>
@endsection