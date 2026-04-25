@extends('back.layouts.principal')

@section('title', 'Fiche risque')
@section('page_title', $risque->titre)
@section('page_subtitle', optional($risque->reforme)->titre ?? 'Réforme non liée')

@section('content')
<div class="row g-4">

    <div class="col-12">
        <div class="risque-hero">
            <div>
                <span class="badge rounded-pill bg-danger-subtle text-danger mb-2">
                    Niveau {{ $risque->niveau }}
                </span>
                <h2>{{ $risque->titre }}</h2>
                <p>{{ $risque->description ?? 'Aucune description.' }}</p>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('back.innovations.risques.edit', $risque) }}" class="btn btn-warning rounded-pill px-4">Modifier</a>
                <a href="{{ route('back.innovations.risques.index') }}" class="btn btn-outline-light rounded-pill px-4">Retour</a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="mini-stat-card">
            <span>Niveau</span>
            <strong>{{ $risque->niveau }}</strong>
        </div>
    </div>

    <div class="col-md-4">
        <div class="mini-stat-card">
            <span>Réforme</span>
            <strong>{{ optional($risque->reforme)->titre ?? '—' }}</strong>
        </div>
    </div>

    <div class="col-md-4">
        <div class="mini-stat-card">
            <span>Statut</span>
            <strong>Suivi</strong>
        </div>
    </div>

    <div class="col-12">
        <div class="content-card">
            <h5 class="fw-bold mb-4">Mesure de mitigation</h5>
            <p class="text-muted mb-0">{{ $risque->mesure_mitigation ?? 'Aucune mesure de mitigation renseignée.' }}</p>
        </div>
    </div>

</div>

@include('back.innovations.risques._styles')
@endsection
