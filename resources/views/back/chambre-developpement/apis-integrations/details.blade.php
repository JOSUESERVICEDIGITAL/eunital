@extends('back.layouts.principal')

@section('title', 'Détails API / intégration')
@section('page_title', 'Chambre développement · Détails API / intégration')
@section('page_subtitle', 'Vue détaillée du service, de sa documentation, de son authentification et de son état.')

@section('content')
    <div class="content-card">
        <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
            <div>
                <h3 class="fw-bold mb-1">{{ $apiIntegration->titre }}</h3>
                <p class="text-muted mb-0">{{ $apiIntegration->description ?: 'Aucune description.' }}</p>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('back.chambre-developpement.apis-integrations.modifier', $apiIntegration) }}"
                   class="btn btn-warning rounded-pill px-4">
                    Modifier
                </a>

                <button type="button"
                    class="btn btn-outline-danger rounded-pill px-4"
                    data-bs-toggle="modal"
                    data-bs-target="#modalSuppressionApiIntegration{{ $apiIntegration->id }}">
                    Supprimer
                </button>
            </div>
        </div>

        @include('back.chambre-developpement.apis-integrations._modales', ['apiIntegration' => $apiIntegration])

        <div class="row g-3">
            <div class="col-md-4">
                <div class="info-tile">
                    <span class="text-muted small">Type</span>
                    <div class="fw-bold mt-2">{{ strtoupper($apiIntegration->type_api) }}</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-tile">
                    <span class="text-muted small">Authentification</span>
                    <div class="fw-bold mt-2">{{ $apiIntegration->methode_authentification ?: '—' }}</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-tile">
                    <span class="text-muted small">Statut</span>
                    <div class="fw-bold mt-2">{{ str_replace('_', ' ', ucfirst($apiIntegration->statut)) }}</div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-tile">
                    <span class="text-muted small">Auteur</span>
                    <div class="fw-bold mt-2">{{ $apiIntegration->auteur->name ?? '—' }}</div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-tile">
                    <span class="text-muted small">URL de base</span>
                    <div class="fw-bold mt-2">{{ $apiIntegration->url_base ?: '—' }}</div>
                </div>
            </div>
        </div>

        <div class="detail-zone mt-4">
            <strong>Documentation</strong><br>
            {{ $apiIntegration->documentation_url ?: 'Non renseignée.' }}
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
