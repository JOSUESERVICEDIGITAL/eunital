@extends('back.layouts.principal')

@section('title', 'Détails idée')
@section('page_title', 'Chambre d’ingénieurs · Détails de l’idée')
@section('page_subtitle', 'Vue complète de l’idée, du problème, de la solution proposée et de son traitement.')

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="content-card">
                <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
                    <div>
                        <h3 class="fw-bold mb-1">{{ $ideeIngenieurie->titre }}</h3>
                        <p class="text-muted mb-0">{{ $ideeIngenieurie->description ?: 'Aucune description.' }}</p>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('back.chambre-ingenieur.idees.modifier', $ideeIngenieurie) }}"
                            class="btn btn-warning rounded-pill px-4">Modifier</a>

                        <button type="button" class="btn btn-outline-danger rounded-pill px-4" data-bs-toggle="modal"
                            data-bs-target="#modalSuppressionIdee{{ $ideeIngenieurie->id }}">
                            Supprimer
                        </button>
                    </div>

                    @include('back.chambre-ingenieur.idees._modales', [
                        'ideeIngenieurie' => $ideeIngenieurie,
                    ])
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="info-tile"><span class="text-muted small">Priorité</span>
                            <div class="fw-bold mt-2">{{ ucfirst($ideeIngenieurie->niveau_priorite) }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-tile"><span class="text-muted small">Statut</span>
                            <div class="fw-bold mt-2">{{ str_replace('_', ' ', ucfirst($ideeIngenieurie->statut)) }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-tile"><span class="text-muted small">Auteur</span>
                            <div class="fw-bold mt-2">{{ $ideeIngenieurie->auteur->name ?? '—' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-tile"><span class="text-muted small">Responsable</span>
                            <div class="fw-bold mt-2">{{ $ideeIngenieurie->responsable->name ?? '—' }}</div>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <h5 class="fw-bold">Problème identifié</h5>
                    <div class="detail-zone">{{ $ideeIngenieurie->probleme_identifie ?: 'Non renseigné.' }}</div>
                </div>

                <div class="mt-4">
                    <h5 class="fw-bold">Solution proposée</h5>
                    <div class="detail-zone">{{ $ideeIngenieurie->solution_proposee ?: 'Non renseignée.' }}</div>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <form method="POST"
                        action="{{ route('back.chambre-ingenieur.idees.mettre_en_etude', $ideeIngenieurie) }}">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-outline-info rounded-pill px-4">Mettre en étude</button>
                    </form>

                    <form method="POST" action="{{ route('back.chambre-ingenieur.idees.retenir', $ideeIngenieurie) }}">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-outline-success rounded-pill px-4">Retenir</button>
                    </form>

                    <form method="POST" action="{{ route('back.chambre-ingenieur.idees.rejeter', $ideeIngenieurie) }}">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-outline-danger rounded-pill px-4">Rejeter</button>
                    </form>

                    <form method="POST"
                        action="{{ route('back.chambre-ingenieur.idees.marquer_comme_realisee', $ideeIngenieurie) }}">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-outline-dark rounded-pill px-4">Marquer réalisée</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .info-tile {
            padding: 18px;
            border-radius: 18px;
            border: 1px solid #e5e7eb;
            background: #f8fafc
        }

        .detail-zone {
            padding: 18px;
            border-radius: 18px;
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            white-space: pre-line
        }
    </style>
@endsection
