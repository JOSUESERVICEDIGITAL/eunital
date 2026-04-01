@extends('back.layouts.principal')
@section('title', 'Détails étude')
@section('page_title', 'Chambre d’ingénieurs · Détails étude de faisabilité')
@section('page_subtitle', 'Lecture complète des faisabilités, risques et recommandations.')


@section('content')

    <div class="d-flex flex-wrap gap-2 mb-4">
        <a href="{{ route('back.chambre-ingenieur.etudes.modifier', $etudeFaisabilite) }}"
            class="btn btn-warning rounded-pill px-4">Modifier</a>

        <button type="button" class="btn btn-outline-danger rounded-pill px-4" data-bs-toggle="modal"
            data-bs-target="#modalSuppressionEtude{{ $etudeFaisabilite->id }}">
            Supprimer
        </button>
    </div>

    @include('back.chambre-ingenieur.etudes._modales', ['etudeFaisabilite' => $etudeFaisabilite])
    <div class="content-card">
        <h3 class="fw-bold mb-3">{{ $etudeFaisabilite->titre }}</h3>
        <div class="detail-zone mb-3">
            <strong>Description</strong><br>{{ $etudeFaisabilite->description ?: 'Non renseignée.' }}</div>
        <div class="detail-zone mb-3"><strong>Faisabilité
                technique</strong><br>{{ $etudeFaisabilite->faisabilite_technique ?: 'Non renseignée.' }}</div>
        <div class="detail-zone mb-3"><strong>Faisabilité
                financière</strong><br>{{ $etudeFaisabilite->faisabilite_financiere ?: 'Non renseignée.' }}</div>
        <div class="detail-zone mb-3"><strong>Faisabilité
                humaine</strong><br>{{ $etudeFaisabilite->faisabilite_humaine ?: 'Non renseignée.' }}</div>
        <div class="detail-zone mb-3"><strong>Risques</strong><br>{{ $etudeFaisabilite->risques ?: 'Non renseignés.' }}
        </div>
        <div class="detail-zone"><strong>Recommandation
                finale</strong><br>{{ $etudeFaisabilite->recommandation_finale ?: 'Non renseignée.' }}</div>
    </div>

    <style>
        .detail-zone {
            padding: 18px;
            border-radius: 18px;
            border: 1px solid #e5e7eb;
            background: #f8fafc;
            white-space: pre-line
        }
    </style>
@endsection
