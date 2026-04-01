@extends('back.layouts.principal')
@section('title', 'Détails application web')
@section('page_title', 'Chambre développement · Détails application web')
@section('page_subtitle', 'Vue détaillée de l’application, de sa stack, de ses URLs et de sa progression.')
@section('content')
    <div class="content-card">
        <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
            <div>
                <h3 class="fw-bold mb-1">{{ $applicationWeb->titre }}</h3>
                <p class="text-muted mb-0">{{ $applicationWeb->description ?: 'Aucune description.' }}</p>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('back.chambre-developpement.applications-web.modifier', $applicationWeb) }}" class="btn btn-warning rounded-pill px-4">Modifier</a>
                <button type="button" class="btn btn-outline-danger rounded-pill px-4"
                    data-bs-toggle="modal"
                    data-bs-target="#modalSuppressionApplicationWeb{{ $applicationWeb->id }}">
                    Supprimer
                </button>
            </div>
        </div>

        @include('back.chambre-developpement.applications-web._modales', ['applicationWeb' => $applicationWeb])

        <div class="row g-3">
            <div class="col-md-4"><div class="info-tile"><span class="text-muted small">Version</span><div class="fw-bold mt-2">{{ $applicationWeb->version }}</div></div></div>
            <div class="col-md-4"><div class="info-tile"><span class="text-muted small">Priorité</span><div class="fw-bold mt-2">{{ ucfirst($applicationWeb->priorite) }}</div></div></div>
            <div class="col-md-4"><div class="info-tile"><span class="text-muted small">Statut</span><div class="fw-bold mt-2">{{ str_replace('_', ' ', ucfirst($applicationWeb->statut)) }}</div></div></div>
            <div class="col-md-6"><div class="info-tile"><span class="text-muted small">Auteur</span><div class="fw-bold mt-2">{{ $applicationWeb->auteur->name ?? '—' }}</div></div></div>
            <div class="col-md-6"><div class="info-tile"><span class="text-muted small">Responsable</span><div class="fw-bold mt-2">{{ $applicationWeb->responsable->name ?? '—' }}</div></div></div>
        </div>

        <div class="detail-zone mt-4"><strong>Stack technique</strong><br>{{ $applicationWeb->stack_technique ?: 'Non renseignée.' }}</div>
        <div class="detail-zone mt-3"><strong>URL production</strong><br>{{ $applicationWeb->url_production ?: 'Non renseignée.' }}</div>
        <div class="detail-zone mt-3"><strong>URL staging</strong><br>{{ $applicationWeb->url_staging ?: 'Non renseignée.' }}</div>
    </div>

    <style>
        .info-tile,.detail-zone{padding:18px;border-radius:18px;border:1px solid #e5e7eb;background:#f8fafc;white-space:pre-line}
    </style>
@endsection
