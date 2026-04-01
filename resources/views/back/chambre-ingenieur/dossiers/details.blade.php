@extends('back.layouts.principal')
@section('title', 'Détails dossier')
@section('page_title', 'Chambre d’ingénieurs · Détails dossier technique')
@section('page_subtitle', 'Vue complète du dossier technique, de sa version et de son statut.')
@section('content')

<div class="d-flex flex-wrap gap-2 mb-4">
    <a href="{{ route('back.chambre-ingenieur.dossiers.modifier', $dossierTechnique) }}" class="btn btn-warning rounded-pill px-4">Modifier</a>

    <button type="button"
        class="btn btn-outline-warning rounded-pill px-4"
        data-bs-toggle="modal"
        data-bs-target="#modalSuppressionDocumentPrincipal{{ $dossierTechnique->id }}">
        Supprimer document
    </button>

    <button type="button"
        class="btn btn-outline-danger rounded-pill px-4"
        data-bs-toggle="modal"
        data-bs-target="#modalSuppressionDossier{{ $dossierTechnique->id }}">
        Supprimer
    </button>
</div>

@include('back.chambre-ingenieur.dossiers._modales', ['dossierTechnique' => $dossierTechnique])
    <div class="content-card">
        <div class="row g-3 mb-4">
            <div class="col-md-6"><h3 class="fw-bold mb-0">{{ $dossierTechnique->titre }}</h3></div>
            <div class="col-md-2"><span class="badge rounded-pill text-bg-light border">{{ ucfirst($dossierTechnique->type_dossier) }}</span></div>
            <div class="col-md-2"><span class="badge rounded-pill text-bg-secondary">{{ ucfirst($dossierTechnique->statut) }}</span></div>
            <div class="col-md-2"><span class="badge rounded-pill text-bg-dark">v{{ $dossierTechnique->version }}</span></div>
        </div>

        <div class="detail-zone mb-3"><strong>Résumé</strong><br>{{ $dossierTechnique->resume ?: 'Non renseigné.' }}</div>
        <div class="detail-zone"><strong>Document principal</strong><br>{{ $dossierTechnique->document_principal ?: 'Aucun document attaché.' }}</div>
    </div>

    <style>
        .detail-zone{padding:18px;border-radius:18px;border:1px solid #e5e7eb;background:#f8fafc;white-space:pre-line}
    </style>
@endsection