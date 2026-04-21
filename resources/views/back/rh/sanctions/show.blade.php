@extends('back.layouts.principal')

@section('title', 'Détail de la sanction')
@section('page_title', 'Détail de la sanction')
@section('page_subtitle', 'Vue complète d’une sanction disciplinaire avec contexte RH, statut, auteur et actions disponibles.')

@section('content')
    <div class="row g-4">

        <div class="col-12">
            <div class="content-card hero-card">
                <div class="d-flex flex-wrap justify-content-between align-items-start gap-4">
                    <div class="d-flex align-items-center gap-4">
                        <div class="hero-icon bg-danger-subtle text-danger">
                            <i class="fa-solid fa-scale-balanced"></i>
                        </div>
                        <div>
                            <h3 class="fw-bold mb-1">{{ $sanction->motif }}</h3>
                            <div class="text-muted mb-2">
                                {{ optional($sanction->membreEquipe)->nom }} {{ optional($sanction->membreEquipe)->prenom }}
                                • {{ optional($sanction->auteur)->name ?? 'Auteur non défini' }}
                            </div>
                            <div class="d-flex flex-wrap gap-2">
                                @php
                                    $statusClass = match($sanction->statut) {
                                        'active' => 'text-bg-danger',
                                        'levee' => 'text-bg-success',
                                        'archivee' => 'text-bg-secondary',
                                        default => 'text-bg-light'
                                    };
                                @endphp
                                <span class="badge rounded-pill {{ $statusClass }}">
                                    {{ ucfirst($sanction->statut) }}
                                </span>
                                <span class="badge rounded-pill text-bg-light border">
                                    {{ ucfirst(str_replace('_', ' ', $sanction->type_sanction)) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('rh.sanctions.edit', $sanction) }}" class="btn btn-warning rounded-pill px-4">
                            <i class="fa-solid fa-pen me-2"></i>Modifier
                        </a>

                        @if($sanction->statut === 'active')
                            <form method="POST" action="{{ route('rh.sanctions.lever', $sanction) }}">
                                @csrf
                                <button type="submit" class="btn btn-success rounded-pill px-4">
                                    <i class="fa-solid fa-check me-2"></i>Lever la sanction
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="content-card h-100">
                <h5 class="fw-bold mb-4">Résumé disciplinaire</h5>

                <div class="info-list">
                    <div class="info-row">
                        <span class="info-label">Employé</span>
                        <span class="info-value">{{ $resume['employe'] ?? '—' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Auteur</span>
                        <span class="info-value">{{ $resume['auteur'] ?? '—' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Type</span>
                        <span class="info-value">{{ ucfirst(str_replace('_', ' ', $resume['type_sanction'] ?? '—')) }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Statut</span>
                        <span class="info-value">{{ ucfirst($resume['statut'] ?? '—') }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Date</span>
                        <span class="info-value">
                            {{ $sanction->date_sanction?->format('d/m/Y') ?? '—' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8">
            <div class="content-card h-100">
                <h5 class="fw-bold mb-3">Description</h5>

                <div class="note-box">
                    {{ $sanction->description ?: 'Aucune description renseignée.' }}
                </div>

                <hr class="my-4">

                <div class="d-flex flex-wrap gap-2">
                    @if($sanction->membreEquipe)
                        <a href="{{ route('rh.sanctions.par-employe', $sanction->membreEquipe) }}" class="btn btn-outline-primary rounded-pill px-4">
                            <i class="fa-solid fa-user me-2"></i>Sanctions de l’employé
                        </a>
                    @endif
                    <a href="{{ route('rh.sanctions.historique') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="fa-solid fa-clock-rotate-left me-2"></i>Historique global
                    </a>
                </div>
            </div>
        </div>

    </div>

    <style>
        .hero-card{background:linear-gradient(135deg, rgba(239,68,68,.06), rgba(245,158,11,.04))}
        .hero-icon{width:86px;height:86px;border-radius:24px;display:flex;align-items:center;justify-content:center;font-size:30px}
        .info-list{display:flex;flex-direction:column;gap:14px}
        .info-row{display:flex;justify-content:space-between;gap:16px;padding-bottom:12px;border-bottom:1px solid #f1f5f9}
        .info-label{font-size:14px;color:#64748b;font-weight:700}
        .info-value{font-size:14px;color:#0f172a;text-align:right;font-weight:600}
        .note-box{background:#f8fafc;border:1px solid #e5e7eb;border-radius:18px;padding:18px;line-height:1.7;color:#334155}
    </style>
@endsection