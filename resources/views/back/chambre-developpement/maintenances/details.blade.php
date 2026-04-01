@extends('back.layouts.principal')

@section('title', 'Détails maintenance')
@section('page_title', 'Chambre développement · Détails maintenance')
@section('page_subtitle', 'Vue détaillée de l’intervention, du niveau d’urgence, du suivi et de la résolution.')

@section('content')
    <div class="content-card">
        <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
            <div>
                <h3 class="fw-bold mb-1">{{ $maintenanceTechnique->titre }}</h3>
                <p class="text-muted mb-0">{{ $maintenanceTechnique->description ?: 'Aucune description.' }}</p>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('back.chambre-developpement.maintenances.modifier', $maintenanceTechnique) }}"
                   class="btn btn-warning rounded-pill px-4">
                    Modifier
                </a>

                <button type="button"
                    class="btn btn-outline-danger rounded-pill px-4"
                    data-bs-toggle="modal"
                    data-bs-target="#modalSuppressionMaintenance{{ $maintenanceTechnique->id }}">
                    Supprimer
                </button>
            </div>
        </div>

        @include('back.chambre-developpement.maintenances._modales', ['maintenanceTechnique' => $maintenanceTechnique])

        <div class="row g-3">
            <div class="col-md-4">
                <div class="info-tile">
                    <span class="text-muted small">Type</span>
                    <div class="fw-bold mt-2">{{ ucfirst($maintenanceTechnique->type_maintenance) }}</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-tile">
                    <span class="text-muted small">Urgence</span>
                    <div class="fw-bold mt-2">{{ ucfirst($maintenanceTechnique->niveau_urgence) }}</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-tile">
                    <span class="text-muted small">Statut</span>
                    <div class="fw-bold mt-2">{{ str_replace('_', ' ', ucfirst($maintenanceTechnique->statut)) }}</div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-tile">
                    <span class="text-muted small">Auteur</span>
                    <div class="fw-bold mt-2">{{ $maintenanceTechnique->auteur->name ?? '—' }}</div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-tile">
                    <span class="text-muted small">Responsable</span>
                    <div class="fw-bold mt-2">{{ $maintenanceTechnique->responsable->name ?? '—' }}</div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-tile">
                    <span class="text-muted small">Date de signalement</span>
                    <div class="fw-bold mt-2">
                        {{ $maintenanceTechnique->date_signalement ? $maintenanceTechnique->date_signalement->format('d/m/Y H:i') : '—' }}
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-tile">
                    <span class="text-muted small">Date de résolution</span>
                    <div class="fw-bold mt-2">
                        {{ $maintenanceTechnique->date_resolution ? $maintenanceTechnique->date_resolution->format('d/m/Y H:i') : '—' }}
                    </div>
                </div>
            </div>
        </div>

        <div class="detail-zone mt-4">
            <strong>Description détaillée</strong><br>
            {{ $maintenanceTechnique->description ?: 'Non renseignée.' }}
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
