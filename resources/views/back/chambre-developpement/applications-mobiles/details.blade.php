@extends('back.layouts.principal')
@section('title', 'Détails application mobile')
@section('page_title', 'Chambre développement · Détails application mobile')
@section('page_subtitle', 'Vue complète du projet mobile, de sa plateforme et de sa progression.')
@section('content')
    <div class="content-card">
        <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
            <div>
                <h3 class="fw-bold mb-1">{{ $applicationMobile->titre }}</h3>
                <p class="text-muted mb-0">{{ $applicationMobile->description ?: 'Aucune description.' }}</p>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('back.chambre-developpement.applications-mobiles.modifier', $applicationMobile) }}" class="btn btn-warning rounded-pill px-4">Modifier</a>
                <button type="button" class="btn btn-outline-danger rounded-pill px-4"
                    data-bs-toggle="modal"
                    data-bs-target="#modalSuppressionApplicationMobile{{ $applicationMobile->id }}">
                    Supprimer
                </button>
            </div>
        </div>

        @include('back.chambre-developpement.applications-mobiles._modales', ['applicationMobile' => $applicationMobile])

        <div class="row g-3">
            <div class="col-md-4"><div class="info-tile"><span class="text-muted small">Plateforme</span><div class="fw-bold mt-2">{{ strtoupper($applicationMobile->plateforme) }}</div></div></div>
            <div class="col-md-4"><div class="info-tile"><span class="text-muted small">Version</span><div class="fw-bold mt-2">{{ $applicationMobile->version }}</div></div></div>
            <div class="col-md-4"><div class="info-tile"><span class="text-muted small">Statut</span><div class="fw-bold mt-2">{{ str_replace('_', ' ', ucfirst($applicationMobile->statut)) }}</div></div></div>
        </div>

        <div class="detail-zone mt-4"><strong>Stack mobile</strong><br>{{ $applicationMobile->stack_mobile ?: 'Non renseignée.' }}</div>
        <div class="detail-zone mt-3"><strong>Lien démo</strong><br>{{ $applicationMobile->lien_demo ?: 'Non renseigné.' }}</div>
    </div>

    <style>
        .info-tile,.detail-zone{padding:18px;border-radius:18px;border:1px solid #e5e7eb;background:#f8fafc;white-space:pre-line}
    </style>
@endsection
