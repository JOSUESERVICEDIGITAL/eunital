@extends('back.layouts.principal')
@section('title', 'Détails architecture')
@section('page_title', 'Chambre d’ingénieurs · Détails architecture')
@section('page_subtitle', 'Vue détaillée de la structure technique, des technologies et des contraintes.')
@section('content')
    <div class="content-card">
        <h3 class="fw-bold mb-3">{{ $architectureTechnique->titre }}</h3>

        <div class="d-flex flex-wrap gap-2 mb-4">
            <a href="{{ route('back.chambre-ingenieur.architectures.modifier', $architectureTechnique) }}"
                class="btn btn-warning rounded-pill px-4">Modifier</a>

            <button type="button" class="btn btn-outline-warning rounded-pill px-4" data-bs-toggle="modal"
                data-bs-target="#modalSuppressionDiagramme{{ $architectureTechnique->id }}">
                Supprimer diagramme
            </button>

            <button type="button" class="btn btn-outline-danger rounded-pill px-4" data-bs-toggle="modal"
                data-bs-target="#modalSuppressionArchitecture{{ $architectureTechnique->id }}">
                Supprimer
            </button>
        </div>

        @include('back.chambre-ingenieur.architectures._modales', [
            'architectureTechnique' => $architectureTechnique,
        ])

        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="info-tile"><span class="text-muted small">Version</span>
                    <div class="fw-bold mt-2">{{ $architectureTechnique->version }}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-tile"><span class="text-muted small">Statut</span>
                    <div class="fw-bold mt-2">{{ ucfirst($architectureTechnique->statut) }}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-tile"><span class="text-muted small">Auteur</span>
                    <div class="fw-bold mt-2">{{ $architectureTechnique->auteur->name ?? '—' }}</div>
                </div>
            </div>
        </div>

        <div class="detail-zone mb-3">
            <strong>Description</strong><br>{{ $architectureTechnique->description ?: 'Non renseignée.' }}</div>
        <div class="detail-zone mb-3">
            <strong>Composants</strong><br>{{ $architectureTechnique->composants ?: 'Non renseignés.' }}</div>
        <div class="detail-zone mb-3"><strong>Technologies
                recommandées</strong><br>{{ $architectureTechnique->technologies_recommandees ?: 'Non renseignées.' }}</div>
        <div class="detail-zone"><strong>Contraintes
                techniques</strong><br>{{ $architectureTechnique->contraintes_techniques ?: 'Non renseignées.' }}</div>
    </div>

    <style>
        .info-tile,
        .detail-zone {
            padding: 18px;
            border-radius: 18px;
            border: 1px solid #e5e7eb;
            background: #f8fafc;
            white-space: pre-line
        }
    </style>
@endsection
