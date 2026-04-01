@extends('back.layouts.principal')
@section('title', 'Détails réflexion')
@section('page_title', 'Chambre d’ingénieurs · Détails réflexion')
@section('page_subtitle', 'Lecture détaillée du contexte, de l’analyse et de la recommandation.')
@section('content')
    <div class="content-card">
        <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
            <div>
                <h3 class="fw-bold mb-1">{{ $reflexionStrategique->titre }}</h3>
                <p class="text-muted mb-0">Auteur : {{ $reflexionStrategique->auteur->name ?? '—' }}</p>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('back.chambre-ingenieur.reflexions.modifier', $reflexionStrategique) }}"
                    class="btn btn-warning rounded-pill px-4">Modifier</a>

                <button type="button" class="btn btn-outline-danger rounded-pill px-4" data-bs-toggle="modal"
                    data-bs-target="#modalSuppressionReflexion{{ $reflexionStrategique->id }}">
                    Supprimer
                </button>
            </div>

            @include('back.chambre-ingenieur.reflexions._modales', [
                'reflexionStrategique' => $reflexionStrategique,
            ])
        </div>

        <div class="detail-zone mb-3"><strong>Contexte</strong><br>{{ $reflexionStrategique->contexte ?: 'Non renseigné.' }}
        </div>
        <div class="detail-zone mb-3"><strong>Analyse</strong><br>{{ $reflexionStrategique->analyse ?: 'Non renseignée.' }}
        </div>
        <div class="detail-zone mb-3"><strong>Orientation
                recommandée</strong><br>{{ $reflexionStrategique->orientation_recommandee ?: 'Non renseignée.' }}</div>
        <div class="detail-zone"><strong>Impact
                attendu</strong><br>{{ $reflexionStrategique->impact_attendu ?: 'Non renseigné.' }}</div>
    </div>

    <style>
        .detail-zone {
            padding: 18px;
            border-radius: 18px;
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            white-space: pre-line
        }
    </style>
@endsection
