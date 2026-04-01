@extends('back.layouts.principal')
@section('title', 'Détails prototype')
@section('page_title', 'Chambre d’ingénieurs · Détails prototype')
@section('page_subtitle', 'Vue détaillée du prototype, de son objectif et de ses liens techniques.')
@section('content')

<td class="text-end">
    <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
        <a href="{{ route('back.chambre-ingenieur.prototypes.details', $prototype) }}" class="btn btn-sm btn-light rounded-pill px-3">Voir</a>
        <a href="{{ route('back.chambre-ingenieur.prototypes.modifier', $prototype) }}" class="btn btn-sm btn-warning rounded-pill px-3">Modifier</a>

        <button type="button"
            class="btn btn-sm btn-outline-warning rounded-pill px-3"
            data-bs-toggle="modal"
            data-bs-target="#modalSuppressionCapture{{ $prototype->id }}">
            Supprimer capture
        </button>

        <button type="button"
            class="btn btn-sm btn-outline-danger rounded-pill px-3"
            data-bs-toggle="modal"
            data-bs-target="#modalSuppressionPrototype{{ $prototype->id }}">
            Supprimer
        </button>
    </div>

    @include('back.chambre-ingenieur.prototypes._modales', ['prototype' => $prototype])
</td>
    <div class="content-card">
        <h3 class="fw-bold mb-3">{{ $prototypeIngenieurie->titre }}</h3>
        <div class="row g-3 mb-4">
            <div class="col-md-4"><div class="info-tile"><span class="text-muted small">Statut</span><div class="fw-bold mt-2">{{ str_replace('_', ' ', ucfirst($prototypeIngenieurie->statut)) }}</div></div></div>
            <div class="col-md-4"><div class="info-tile"><span class="text-muted small">Auteur</span><div class="fw-bold mt-2">{{ $prototypeIngenieurie->auteur->name ?? '—' }}</div></div></div>
            <div class="col-md-4"><div class="info-tile"><span class="text-muted small">Capture</span><div class="fw-bold mt-2">{{ $prototypeIngenieurie->captures ? 'Oui' : 'Non' }}</div></div></div>
        </div>

        <div class="detail-zone mb-3"><strong>Description</strong><br>{{ $prototypeIngenieurie->description ?: 'Non renseignée.' }}</div>
        <div class="detail-zone mb-3"><strong>Objectif</strong><br>{{ $prototypeIngenieurie->objectif ?: 'Non renseigné.' }}</div>
        <div class="detail-zone mb-3"><strong>Lien démo</strong><br>{{ $prototypeIngenieurie->lien_demo ?: 'Non renseigné.' }}</div>
        <div class="detail-zone"><strong>Dépôt source</strong><br>{{ $prototypeIngenieurie->depot_source ?: 'Non renseigné.' }}</div>
    </div>

    <style>
        .info-tile,.detail-zone{padding:18px;border-radius:18px;border:1px solid #e5e7eb;background:#f8fafc;white-space:pre-line}
    </style>
@endsection