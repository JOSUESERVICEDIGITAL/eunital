@extends('back.layouts.principal')

@section('title', 'Fiche indicateur')
@section('page_title', $indicateur->nom)
@section('page_subtitle', optional($indicateur->innovation)->titre ?? 'Innovation')

@section('content')
<div class="row g-4">

    <div class="col-12">
        <div class="indicateur-hero">
            <div>
                <span class="badge rounded-pill bg-warning-subtle text-warning mb-2">
                    {{ $indicateur->unite ?? 'KPI' }}
                </span>
                <h2>{{ $indicateur->nom }}</h2>
                <p>{{ $indicateur->description ?? 'Aucune description.' }}</p>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('back.innovations.indicateurs.edit', $indicateur) }}" class="btn btn-warning rounded-pill px-4">Modifier</a>
                <a href="{{ route('back.innovations.indicateurs.index') }}" class="btn btn-outline-light rounded-pill px-4">Retour</a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="mini-stat-card">
            <span>Référence</span>
            <strong>{{ $indicateur->valeur_reference ?? '—' }}</strong>
        </div>
    </div>

    <div class="col-md-3">
        <div class="mini-stat-card">
            <span>Cible</span>
            <strong>{{ $indicateur->valeur_cible ?? '—' }}</strong>
        </div>
    </div>

    <div class="col-md-3">
        <div class="mini-stat-card">
            <span>Actuelle</span>
            <strong>{{ $indicateur->valeur_actuelle ?? '—' }}</strong>
        </div>
    </div>

    <div class="col-md-3">
        <div class="mini-stat-card">
            <span>Unité</span>
            <strong>{{ $indicateur->unite ?? '—' }}</strong>
        </div>
    </div>

    <div class="col-12">
        <div class="content-card">
            <h5 class="fw-bold mb-4">Innovation rattachée</h5>
            <div class="info-line">
                <span>Innovation</span>
                <strong>{{ optional($indicateur->innovation)->titre ?? '—' }}</strong>
            </div>

            @php
                $reference = is_numeric($indicateur->valeur_reference) ? (float) $indicateur->valeur_reference : null;
                $cible = is_numeric($indicateur->valeur_cible) ? (float) $indicateur->valeur_cible : null;
                $actuelle = is_numeric($indicateur->valeur_actuelle) ? (float) $indicateur->valeur_actuelle : null;
                $progression = ($cible && $actuelle !== null) ? min(100, round(($actuelle / $cible) * 100, 2)) : 0;
            @endphp

            <div class="mt-4">
                <div class="d-flex justify-content-between mb-2">
                    <strong>Progression vers la cible</strong>
                    <span>{{ $progression }}%</span>
                </div>
                <div class="kpi-bar">
                    <div class="kpi-progress" style="width: {{ $progression }}%"></div>
                </div>
            </div>
        </div>
    </div>

</div>

@include('back.innovations.indicateurs._styles')
@endsection
