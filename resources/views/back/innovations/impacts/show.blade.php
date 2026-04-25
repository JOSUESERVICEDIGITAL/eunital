@extends('back.layouts.principal')

@section('title', 'Fiche impact')
@section('page_title', 'Fiche impact')
@section('page_subtitle', optional($impact->innovation)->titre ?? 'Innovation')

@section('content')
<div class="row g-4">

    <div class="col-12">
        <div class="impact-hero">
            <div>
                <span class="badge rounded-pill bg-warning-subtle text-warning mb-2">{{ $impact->type_impact }}</span>
                <h2>{{ optional($impact->innovation)->titre ?? 'Innovation non liée' }}</h2>
                <p>{{ $impact->description ?? 'Aucune description.' }}</p>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('back.innovations.impacts.edit', $impact) }}" class="btn btn-warning rounded-pill px-4">Modifier</a>
                <a href="{{ route('back.innovations.impacts.index') }}" class="btn btn-outline-light rounded-pill px-4">Retour</a>
            </div>
        </div>
    </div>

    <div class="col-md-3"><div class="mini-stat-card"><span>Avant</span><strong>{{ $impact->valeur_avant ?? '—' }}</strong></div></div>
    <div class="col-md-3"><div class="mini-stat-card"><span>Après</span><strong>{{ $impact->valeur_apres ?? '—' }}</strong></div></div>
    <div class="col-md-3"><div class="mini-stat-card"><span>Variation</span><strong>{{ $impact->variation ?? '—' }}</strong></div></div>
    <div class="col-md-3"><div class="mini-stat-card"><span>Période</span><strong>{{ $impact->periode_mesure }}</strong></div></div>

    <div class="col-xl-4">
        <div class="content-card h-100">
            <h5 class="fw-bold mb-4">Modules rapides</h5>

            <div class="d-grid gap-2">
                <a href="{{ route('back.innovations.impacts.mesures', $impact) }}" class="btn btn-light rounded-pill text-start px-4">
                    <i class="fa-solid fa-chart-line me-2"></i>Mesures
                </a>
                <a href="{{ route('back.innovations.impacts.beneficiaires', $impact) }}" class="btn btn-light rounded-pill text-start px-4">
                    <i class="fa-solid fa-users me-2"></i>Bénéficiaires
                </a>
                <a href="{{ route('back.innovations.impacts.rapports', $impact) }}" class="btn btn-light rounded-pill text-start px-4">
                    <i class="fa-solid fa-file-lines me-2"></i>Rapports
                </a>
            </div>
        </div>
    </div>

    <div class="col-xl-8">
        <div class="content-card h-100">
            <h5 class="fw-bold mb-4">Résumé d’impact</h5>
            <p class="text-muted mb-0">{{ $impact->description ?? 'Aucun résumé disponible.' }}</p>
        </div>
    </div>

</div>

@include('back.innovations.impacts._styles')
@endsection
