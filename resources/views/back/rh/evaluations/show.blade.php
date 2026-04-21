@extends('back.layouts.principal')

@section('title', 'Détail de l’évaluation')
@section('page_title', 'Détail de l’évaluation')
@section('page_subtitle', 'Vue complète de l’évaluation RH avec note, résumé qualitatif, recommandations et décisions rapides.')

@section('content')
    <div class="row g-4">

        <div class="col-12">
            <div class="content-card hero-card">
                <div class="d-flex flex-wrap justify-content-between align-items-start gap-4">
                    <div class="d-flex align-items-center gap-4">
                        <div class="hero-icon bg-warning-subtle text-warning">
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <div>
                            <h3 class="fw-bold mb-1">{{ $evaluation->titre }}</h3>
                            <div class="text-muted mb-2">
                                {{ optional($evaluation->membreEquipe)->nom }} {{ optional($evaluation->membreEquipe)->prenom }}
                                • {{ optional($evaluation->evaluateur)->name ?? 'Évaluateur non défini' }}
                            </div>
                            <div class="d-flex flex-wrap gap-2">
                                @php
                                    $statusClass = match($evaluation->statut) {
                                        'brouillon' => 'text-bg-warning',
                                        'validee' => 'text-bg-success',
                                        'archivee' => 'text-bg-secondary',
                                        default => 'text-bg-light'
                                    };
                                @endphp
                                <span class="badge rounded-pill {{ $statusClass }}">
                                    {{ ucfirst($evaluation->statut) }}
                                </span>
                                <span class="badge rounded-pill text-bg-info">
                                    {{ $evaluation->note_globale ?? '—' }}/10
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('rh.evaluations.edit', $evaluation) }}" class="btn btn-warning rounded-pill px-4">
                            <i class="fa-solid fa-pen me-2"></i>Modifier
                        </a>

                        @if($evaluation->statut === 'brouillon')
                            <form method="POST" action="{{ route('rh.evaluations.valider', $evaluation) }}">
                                @csrf
                                <button type="submit" class="btn btn-success rounded-pill px-4">
                                    <i class="fa-solid fa-check me-2"></i>Valider
                                </button>
                            </form>
                        @endif

                        @if($evaluation->statut !== 'archivee')
                            <form method="POST" action="{{ route('rh.evaluations.archiver', $evaluation) }}">
                                @csrf
                                <button type="submit" class="btn btn-outline-secondary rounded-pill px-4">
                                    <i class="fa-solid fa-box-archive me-2"></i>Archiver
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="content-card h-100">
                <h5 class="fw-bold mb-4">Résumé</h5>

                <div class="info-list">
                    <div class="info-row">
                        <span class="info-label">Employé</span>
                        <span class="info-value">{{ $resume['employe'] ?? '—' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Évaluateur</span>
                        <span class="info-value">{{ $resume['evaluateur'] ?? '—' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Date</span>
                        <span class="info-value">
                            {{ $evaluation->date_evaluation?->format('d/m/Y') ?? '—' }}
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Note</span>
                        <span class="info-value">{{ $resume['note'] ?? '—' }}/10</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Statut</span>
                        <span class="info-value">{{ ucfirst($resume['statut'] ?? '—') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8">
            <div class="row g-4">
                <div class="col-12">
                    <div class="content-card">
                        <h5 class="fw-bold mb-3">Points forts</h5>
                        <div class="note-box">
                            {{ $evaluation->points_forts ?: 'Aucun point fort renseigné.' }}
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="content-card">
                        <h5 class="fw-bold mb-3">Points à améliorer</h5>
                        <div class="note-box">
                            {{ $evaluation->points_a_ameliorer ?: 'Aucun axe d’amélioration renseigné.' }}
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="content-card">
                        <h5 class="fw-bold mb-3">Recommandations RH</h5>
                        <div class="note-box">
                            {{ $evaluation->recommandations ?: 'Aucune recommandation renseignée.' }}
                        </div>

                        <hr class="my-4">

                        <div class="d-flex flex-wrap gap-2">
                            @if($evaluation->membreEquipe)
                                <a href="{{ route('rh.evaluations.par-employe', $evaluation->membreEquipe) }}" class="btn btn-outline-primary rounded-pill px-4">
                                    <i class="fa-solid fa-user me-2"></i>Voir les évaluations de l’employé
                                </a>
                            @endif
                            <a href="{{ route('rh.evaluations.historique', $evaluation) }}" class="btn btn-outline-secondary rounded-pill px-4">
                                <i class="fa-solid fa-clock-rotate-left me-2"></i>Historique
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <style>
        .hero-card{background:linear-gradient(135deg, rgba(245,158,11,.06), rgba(59,130,246,.04))}
        .hero-icon{width:86px;height:86px;border-radius:24px;display:flex;align-items:center;justify-content:center;font-size:30px}
        .info-list{display:flex;flex-direction:column;gap:14px}
        .info-row{display:flex;justify-content:space-between;gap:16px;padding-bottom:12px;border-bottom:1px solid #f1f5f9}
        .info-label{font-size:14px;color:#64748b;font-weight:700}
        .info-value{font-size:14px;color:#0f172a;text-align:right;font-weight:600}
        .note-box{background:#f8fafc;border:1px solid #e5e7eb;border-radius:18px;padding:18px;line-height:1.7;color:#334155}
    </style>
@endsection