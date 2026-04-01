@extends('back.layouts.principal')

@section('title', 'Détails site vitrine')
@section('page_title', 'Chambre développement · Détails site vitrine')
@section('page_subtitle', 'Vue détaillée du site, du client, des technologies et de son état d’avancement.')

@section('content')
    <div class="content-card">
        <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
            <div>
                <h3 class="fw-bold mb-1">{{ $siteVitrine->titre }}</h3>
                <p class="text-muted mb-0">{{ $siteVitrine->description ?: 'Aucune description.' }}</p>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('back.chambre-developpement.sites-vitrines.modifier', $siteVitrine) }}"
                   class="btn btn-warning rounded-pill px-4">
                    Modifier
                </a>

                <button type="button"
                    class="btn btn-outline-danger rounded-pill px-4"
                    data-bs-toggle="modal"
                    data-bs-target="#modalSuppressionSiteVitrine{{ $siteVitrine->id }}">
                    Supprimer
                </button>
            </div>
        </div>

        @include('back.chambre-developpement.sites-vitrines._modales', ['siteVitrine' => $siteVitrine])

        <div class="row g-3">
            <div class="col-md-4">
                <div class="info-tile">
                    <span class="text-muted small">Client</span>
                    <div class="fw-bold mt-2">{{ $siteVitrine->client ?: '—' }}</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-tile">
                    <span class="text-muted small">Statut</span>
                    <div class="fw-bold mt-2">{{ str_replace('_', ' ', ucfirst($siteVitrine->statut)) }}</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-tile">
                    <span class="text-muted small">Livraison prévue</span>
                    <div class="fw-bold mt-2">
                        {{ $siteVitrine->date_livraison_prevue ? $siteVitrine->date_livraison_prevue->format('d/m/Y') : '—' }}
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-tile">
                    <span class="text-muted small">Auteur</span>
                    <div class="fw-bold mt-2">{{ $siteVitrine->auteur->name ?? '—' }}</div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-tile">
                    <span class="text-muted small">URL du site</span>
                    <div class="fw-bold mt-2">{{ $siteVitrine->url_site ?: '—' }}</div>
                </div>
            </div>
        </div>

        <div class="detail-zone mt-4">
            <strong>Technologies</strong><br>
            {{ $siteVitrine->technologies ?: 'Non renseignées.' }}
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
