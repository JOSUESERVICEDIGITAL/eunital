@extends('back.layouts.principal')

@section('title', 'Détails dépôt / version')
@section('page_title', 'Chambre développement · Détails dépôt / version')
@section('page_subtitle', 'Vue détaillée du dépôt, de la branche principale, de la version actuelle et de son état de diffusion.')

@section('content')
    <div class="content-card">
        <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
            <div>
                <h3 class="fw-bold mb-1">{{ $depotVersion->titre }}</h3>
                <p class="text-muted mb-0">{{ $depotVersion->description ?: 'Aucune description.' }}</p>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('back.chambre-developpement.depots-versions.modifier', $depotVersion) }}"
                   class="btn btn-warning rounded-pill px-4">
                    Modifier
                </a>

                <button type="button"
                    class="btn btn-outline-danger rounded-pill px-4"
                    data-bs-toggle="modal"
                    data-bs-target="#modalSuppressionDepotVersion{{ $depotVersion->id }}">
                    Supprimer
                </button>
            </div>
        </div>

        @include('back.chambre-developpement.depots-versions._modales', ['depotVersion' => $depotVersion])

        <div class="row g-3">
            <div class="col-md-4">
                <div class="info-tile">
                    <span class="text-muted small">Branche principale</span>
                    <div class="fw-bold mt-2">{{ $depotVersion->branche_principale ?: '—' }}</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-tile">
                    <span class="text-muted small">Version actuelle</span>
                    <div class="fw-bold mt-2">{{ $depotVersion->version_actuelle }}</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-tile">
                    <span class="text-muted small">Type de version</span>
                    <div class="fw-bold mt-2">{{ ucfirst($depotVersion->type_version) }}</div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-tile">
                    <span class="text-muted small">Statut</span>
                    <div class="fw-bold mt-2">{{ str_replace('_', ' ', ucfirst($depotVersion->statut)) }}</div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-tile">
                    <span class="text-muted small">Auteur</span>
                    <div class="fw-bold mt-2">{{ $depotVersion->auteur->name ?? '—' }}</div>
                </div>
            </div>
        </div>

        <div class="detail-zone mt-4">
            <strong>URL du dépôt</strong><br>
            {{ $depotVersion->url_depot ?: 'Non renseignée.' }}
        </div>
    </div>

    <style>
        .info-tile,.detail-zone{
            padding:18px;
            border-radius:18px;
            border:1px solid #e5e7eb;
            background:#f8fafc;
            white-space:pre-line
        }
    </style>
@endsection
