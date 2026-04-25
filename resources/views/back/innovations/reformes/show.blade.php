@extends('back.layouts.principal')

@section('title', 'Fiche réforme')
@section('page_title', $reforme->titre)
@section('page_subtitle', 'Fiche centrale de suivi de la réforme.')

@section('content')
<div class="row g-4">

    <div class="col-12">
        <div class="reforme-hero">
            <div>
                <span class="badge rounded-pill bg-warning-subtle text-warning mb-2">{{ $reforme->statut }}</span>
                <h2>{{ $reforme->titre }}</h2>
                <p>{{ $reforme->description ?? 'Aucune description.' }}</p>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('back.innovations.reformes.edit', $reforme) }}" class="btn btn-warning rounded-pill px-4">Modifier</a>
                <a href="{{ route('back.innovations.reformes.synthese', $reforme) }}" class="btn btn-outline-light rounded-pill px-4">Synthèse</a>
            </div>
        </div>
    </div>

    <div class="col-md-3"><div class="mini-stat-card"><span>Actions</span><strong>{{ $reforme->actions->count() }}</strong></div></div>
    <div class="col-md-3"><div class="mini-stat-card"><span>Risques</span><strong>{{ $reforme->risques->count() }}</strong></div></div>
    <div class="col-md-3"><div class="mini-stat-card"><span>Décisions</span><strong>{{ $reforme->decisions->count() }}</strong></div></div>
    <div class="col-md-3"><div class="mini-stat-card"><span>Priorité</span><strong>{{ $reforme->niveau_priorite }}</strong></div></div>

    <div class="col-xl-4">
        <div class="content-card h-100">
            <h5 class="fw-bold mb-4">Informations</h5>
            <div class="info-line"><span>Code</span><strong>{{ $reforme->code }}</strong></div>
            <div class="info-line"><span>Domaine</span><strong>{{ $reforme->domaine ?? '—' }}</strong></div>
            <div class="info-line"><span>Responsable</span><strong>{{ optional($reforme->responsable)->name ?? '—' }}</strong></div>
            <div class="info-line"><span>Début</span><strong>{{ optional($reforme->date_debut)->format('d/m/Y') ?? '—' }}</strong></div>
            <div class="info-line"><span>Fin prévue</span><strong>{{ optional($reforme->date_fin_previsionnelle)->format('d/m/Y') ?? '—' }}</strong></div>
        </div>
    </div>

    <div class="col-xl-8">
        <div class="content-card h-100">
            <h5 class="fw-bold mb-4">Modules rapides</h5>

            <div class="row g-3">
                <div class="col-md-4">
                    <a href="{{ route('back.innovations.reformes.actions', $reforme) }}" class="module-card">Actions</a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('back.innovations.reformes.risques', $reforme) }}" class="module-card">Risques</a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('back.innovations.reformes.decisions', $reforme) }}" class="module-card">Décisions</a>
                </div>
            </div>
        </div>
    </div>

</div>

@include('back.innovations.reformes._styles')
@endsection
