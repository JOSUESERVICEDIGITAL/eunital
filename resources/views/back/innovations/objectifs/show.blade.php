@extends('back.layouts.principal')

@section('title', 'Fiche objectif')
@section('page_title', $objectif->titre)
@section('page_subtitle', optional($objectif->innovation)->titre ?? 'Innovation')

@section('content')
<div class="row g-4">

    <div class="col-12">
        <div class="objectif-hero">
            <div>
                <span class="badge rounded-pill bg-warning-subtle text-warning mb-2">
                    {{ str_replace('_', ' ', $objectif->statut) }}
                </span>
                <h2>{{ $objectif->titre }}</h2>
                <p>{{ $objectif->description ?? 'Aucune description.' }}</p>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('back.innovations.objectifs.edit', $objectif) }}" class="btn btn-warning rounded-pill px-4">Modifier</a>
                <a href="{{ route('back.innovations.objectifs.index') }}" class="btn btn-outline-light rounded-pill px-4">Retour</a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="mini-stat-card">
            <span>Valeur cible</span>
            <strong>{{ $objectif->valeur_cible ?? '—' }}</strong>
        </div>
    </div>

    <div class="col-md-4">
        <div class="mini-stat-card">
            <span>Valeur actuelle</span>
            <strong>{{ $objectif->valeur_actuelle ?? '—' }}</strong>
        </div>
    </div>

    <div class="col-md-4">
        <div class="mini-stat-card">
            <span>Statut</span>
            <strong>{{ str_replace('_', ' ', $objectif->statut) }}</strong>
        </div>
    </div>

    <div class="col-12">
        <div class="content-card">
            <h5 class="fw-bold mb-4">Innovation rattachée</h5>
            <div class="info-line">
                <span>Innovation</span>
                <strong>{{ optional($objectif->innovation)->titre ?? '—' }}</strong>
            </div>
        </div>
    </div>

</div>

@include('back.innovations.objectifs._styles')
@endsection
