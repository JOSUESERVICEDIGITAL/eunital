@extends('back.layouts.principal')

@section('title', 'Détail de la présence')
@section('page_title', 'Détail de la présence')
@section('page_subtitle', 'Vue complète d’un pointage RH avec contexte employé, horaire, statut et observations.')

@section('content')
    <div class="row g-4">

        <div class="col-12">
            <div class="content-card hero-card">
                <div class="d-flex flex-wrap justify-content-between align-items-start gap-4">
                    <div class="d-flex align-items-center gap-4">
                        <div class="hero-icon bg-success-subtle text-success">
                            <i class="fa-solid fa-user-clock"></i>
                        </div>
                        <div>
                            <h3 class="fw-bold mb-1">
                                {{ optional($presence->membreEquipe)->nom }} {{ optional($presence->membreEquipe)->prenom }}
                            </h3>
                            <div class="text-muted mb-2">
                                {{ $presence->date_presence?->format('d/m/Y') ?? 'Date non définie' }}
                            </div>
                            <div class="d-flex flex-wrap gap-2">
                                @php
                                    $statusClass = match($presence->statut) {
                                        'present' => 'text-bg-success',
                                        'absent' => 'text-bg-danger',
                                        'retard' => 'text-bg-warning',
                                        'mission' => 'text-bg-info',
                                        'teletravail' => 'text-bg-primary',
                                        'conge' => 'text-bg-secondary',
                                        default => 'text-bg-light'
                                    };
                                @endphp
                                <span class="badge rounded-pill {{ $statusClass }}">
                                    {{ ucfirst(str_replace('_', ' ', $presence->statut)) }}
                                </span>
                                <span class="badge rounded-pill text-bg-light border">
                                    {{ optional(optional($presence->membreEquipe)->departement)->nom ?? 'Département non défini' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('rh.presences.edit', $presence) }}" class="btn btn-warning rounded-pill px-4">
                            <i class="fa-solid fa-pen me-2"></i>Modifier
                        </a>

                        @if($presence->membreEquipe)
                            <a href="{{ route('rh.presences.par-employe', $presence->membreEquipe) }}" class="btn btn-outline-primary rounded-pill px-4">
                                <i class="fa-solid fa-user me-2"></i>Historique employé
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="content-card h-100">
                <h5 class="fw-bold mb-4">Informations de pointage</h5>

                <div class="info-list">
                    <div class="info-row">
                        <span class="info-label">Employé</span>
                        <span class="info-value">{{ optional($presence->membreEquipe)->nom }} {{ optional($presence->membreEquipe)->prenom }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Département</span>
                        <span class="info-value">{{ optional(optional($presence->membreEquipe)->departement)->nom ?? '—' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Poste</span>
                        <span class="info-value">{{ optional(optional($presence->membreEquipe)->poste)->nom ?? '—' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Date</span>
                        <span class="info-value">{{ $presence->date_presence?->format('d/m/Y') ?? '—' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Arrivée</span>
                        <span class="info-value">{{ $presence->heure_arrivee ?? '—' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Départ</span>
                        <span class="info-value">{{ $presence->heure_depart ?? '—' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8">
            <div class="content-card h-100">
                <h5 class="fw-bold mb-3">Observation RH</h5>

                <div class="note-box">
                    {{ $presence->observation ?: 'Aucune observation renseignée pour ce pointage.' }}
                </div>

                <hr class="my-4">

                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('rh.presences.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="fa-solid fa-arrow-left me-2"></i>Retour à la liste
                    </a>
                    <a href="{{ route('rh.presences.journalier', ['date' => optional($presence->date_presence)->format('Y-m-d')]) }}" class="btn btn-outline-success rounded-pill px-4">
                        <i class="fa-solid fa-calendar-day me-2"></i>Jour concerné
                    </a>
                </div>
            </div>
        </div>

    </div>

    <style>
        .hero-card{background:linear-gradient(135deg, rgba(16,185,129,.06), rgba(59,130,246,.04))}
        .hero-icon{width:86px;height:86px;border-radius:24px;display:flex;align-items:center;justify-content:center;font-size:30px}
        .info-list{display:flex;flex-direction:column;gap:14px}
        .info-row{display:flex;justify-content:space-between;gap:16px;padding-bottom:12px;border-bottom:1px solid #f1f5f9}
        .info-label{font-size:14px;color:#64748b;font-weight:700}
        .info-value{font-size:14px;color:#0f172a;text-align:right;font-weight:600}
        .note-box{background:#f8fafc;border:1px solid #e5e7eb;border-radius:18px;padding:18px;line-height:1.7;color:#334155}
    </style>
@endsection