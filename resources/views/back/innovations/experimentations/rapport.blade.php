@extends('back.layouts.principal')

@section('title', 'Rapport expérimentation')
@section('page_title', 'Rapport d’expérimentation')
@section('page_subtitle', $experimentation->titre)

@section('content')
<div class="row g-4">

    <div class="col-12">
        <div class="content-card">
            <div class="section-head">
                <div>
                    <h4>Rapport final</h4>
                    <p>Synthèse complète de l’expérimentation.</p>
                </div>
                <a href="{{ route('back.innovations.experimentations.show', $experimentation) }}" class="btn btn-outline-secondary rounded-pill px-4">Retour</a>
            </div>
        </div>
    </div>

    <div class="col-md-3"><div class="mini-stat-card"><span>Sites</span><strong>{{ $experimentation->sites->count() }}</strong></div></div>
    <div class="col-md-3"><div class="mini-stat-card"><span>Résultats</span><strong>{{ $experimentation->resultats->count() }}</strong></div></div>
    <div class="col-md-3"><div class="mini-stat-card"><span>Décisions</span><strong>{{ $experimentation->decisions->count() }}</strong></div></div>
    <div class="col-md-3"><div class="mini-stat-card"><span>Statut</span><strong>{{ $experimentation->statut }}</strong></div></div>

    <div class="col-12">
        <div class="content-card">
            <h5 class="fw-bold">Hypothèse</h5>
            <p class="text-muted">{{ $experimentation->hypothese ?? '—' }}</p>

            <h5 class="fw-bold mt-4">Protocole</h5>
            <p class="text-muted">{{ $experimentation->protocole ?? '—' }}</p>

            <h5 class="fw-bold mt-4">Résultat global</h5>
            <p class="text-muted mb-0">{{ $experimentation->resultat_global ?? '—' }}</p>
        </div>
    </div>

</div>

@include('back.innovations.experimentations._styles')
@endsection
