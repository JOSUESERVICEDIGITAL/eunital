@extends('back.layouts.principal')

@section('title', 'Détail du dossier bien-être')
@section('page_title', 'Détail du dossier bien-être')
@section('page_subtitle', 'Vue complète d’un dossier humain ou social avec priorité, statut, auteur et suivi du collaborateur.')

@section('content')
    <div class="row g-4">

        <div class="col-12">
            <div class="content-card hero-card">
                <div class="d-flex flex-wrap justify-content-between align-items-start gap-4">
                    <div class="d-flex align-items-center gap-4">
                        <div class="hero-icon bg-primary-subtle text-primary">
                            <i class="fa-solid fa-heart-circle-check"></i>
                        </div>
                        <div>
                            <h3 class="fw-bold mb-1">{{ $dossier->titre }}</h3>
                            <div class="text-muted mb-2">
                                {{ optional($dossier->membreEquipe)->nom }} {{ optional($dossier->membreEquipe)->prenom }}
                                • {{ optional($dossier->auteur)->name ?? 'Auteur non défini' }}
                            </div>
                            <div class="d-flex flex-wrap gap-2">
                                @php
                                    $priorityClass = match($dossier->niveau_priorite) {
                                        'faible' => 'text-bg-light border',
                                        'moyenne' => 'text-bg-info',
                                        'haute' => 'text-bg-warning',
                                        'urgente' => 'text-bg-danger',
                                        default => 'text-bg-light'
                                    };

                                    $statusClass = match($dossier->statut) {
                                        'ouvert' => 'text-bg-warning',
                                        'en_cours' => 'text-bg-info',
                                        'traite' => 'text-bg-success',
                                        'archive' => 'text-bg-secondary',
                                        default => 'text-bg-light'
                                    };
                                @endphp

                                <span class="badge rounded-pill {{ $priorityClass }}">
                                    {{ ucfirst($dossier->niveau_priorite) }}
                                </span>

                                <span class="badge rounded-pill {{ $statusClass }}">
                                    {{ ucfirst(str_replace('_', ' ', $dossier->statut)) }}
                                </span>

                                <span class="badge rounded-pill text-bg-light border">
                                    {{ ucfirst(str_replace('_', ' ', $dossier->type)) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('rh.bien-etre.edit', $dossier) }}" class="btn btn-warning rounded-pill px-4">
                            <i class="fa-solid fa-pen me-2"></i>Modifier
                        </a>

                        <a href="{{ route('rh.bien-etre.suivi', $dossier) }}" class="btn btn-outline-primary rounded-pill px-4">
                            <i class="fa-solid fa-clock-rotate-left me-2"></i>Suivi
                        </a>

                        @if(in_array($dossier->statut, ['ouvert', 'en_cours']))
                            <form method="POST" action="{{ route('rh.bien-etre.cloturer', $dossier) }}">
                                @csrf
                                <input type="hidden" name="statut" value="traite">
                                <button type="submit" class="btn btn-success rounded-pill px-4">
                                    <i class="fa-solid fa-check me-2"></i>Marquer traité
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
                        <span class="info-label">Auteur</span>
                        <span class="info-value">{{ $resume['auteur'] ?? '—' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Type</span>
                        <span class="info-value">{{ ucfirst(str_replace('_', ' ', $resume['type'] ?? '—')) }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Priorité</span>
                        <span class="info-value">{{ ucfirst($resume['priorite'] ?? '—') }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Statut</span>
                        <span class="info-value">{{ ucfirst(str_replace('_', ' ', $resume['statut'] ?? '—')) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8">
            <div class="content-card h-100">
                <h5 class="fw-bold mb-3">Description</h5>

                <div class="note-box">
                    {{ $dossier->description ?: 'Aucune description renseignée.' }}
                </div>

                <hr class="my-4">

                <div class="d-flex flex-wrap gap-2">
                    @if($dossier->membreEquipe)
                        <a href="{{ route('rh.bien-etre.par-employe', $dossier->membreEquipe) }}" class="btn btn-outline-primary rounded-pill px-4">
                            <i class="fa-solid fa-user me-2"></i>Dossiers de l’employé
                        </a>
                    @endif

                    <a href="{{ route('rh.bien-etre.statistiques') }}" class="btn btn-outline-info rounded-pill px-4">
                        <i class="fa-solid fa-chart-pie me-2"></i>Statistiques
                    </a>

                    @if(in_array($dossier->statut, ['ouvert', 'en_cours']))
                        <form method="POST" action="{{ route('rh.bien-etre.cloturer', $dossier) }}">
                            @csrf
                            <input type="hidden" name="statut" value="archive">
                            <button type="submit" class="btn btn-outline-secondary rounded-pill px-4">
                                <i class="fa-solid fa-box-archive me-2"></i>Archiver
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>

    </div>

    <style>
        .hero-card{background:linear-gradient(135deg, rgba(17,177,173,.06), rgba(59,130,246,.04))}
        .hero-icon{width:86px;height:86px;border-radius:24px;display:flex;align-items:center;justify-content:center;font-size:30px}
        .info-list{display:flex;flex-direction:column;gap:14px}
        .info-row{display:flex;justify-content:space-between;gap:16px;padding-bottom:12px;border-bottom:1px solid #f1f5f9}
        .info-label{font-size:14px;color:#64748b;font-weight:700}
        .info-value{font-size:14px;color:#0f172a;text-align:right;font-weight:600}
        .note-box{background:#f8fafc;border:1px solid #e5e7eb;border-radius:18px;padding:18px;line-height:1.7;color:#334155}
    </style>
@endsection