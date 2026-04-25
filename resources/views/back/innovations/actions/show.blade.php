@extends('back.layouts.principal')

@section('title', 'Fiche action')
@section('page_title', $action->titre)
@section('page_subtitle', optional($action->reforme)->titre ?? 'Réforme non liée')

@section('content')
<div class="row g-4">

    <div class="col-12">
        <div class="action-hero">
            <div>
                <span class="badge rounded-pill bg-warning-subtle text-warning mb-2">
                    {{ str_replace('_', ' ', $action->statut) }}
                </span>
                <h2>{{ $action->titre }}</h2>
                <p>{{ $action->description ?? 'Aucune description.' }}</p>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('back.innovations.actions.edit', $action) }}" class="btn btn-warning rounded-pill px-4">Modifier</a>
                <a href="{{ route('back.innovations.actions.index') }}" class="btn btn-outline-light rounded-pill px-4">Retour</a>
            </div>
        </div>
    </div>

    <div class="col-md-3"><div class="mini-stat-card"><span>Statut</span><strong>{{ $action->statut }}</strong></div></div>
    <div class="col-md-3"><div class="mini-stat-card"><span>Début</span><strong>{{ optional($action->date_debut)->format('d/m/Y') ?? '—' }}</strong></div></div>
    <div class="col-md-3"><div class="mini-stat-card"><span>Échéance</span><strong>{{ optional($action->date_echeance)->format('d/m/Y') ?? '—' }}</strong></div></div>
    <div class="col-md-3"><div class="mini-stat-card"><span>Responsable</span><strong>{{ optional($action->responsable)->name ?? '—' }}</strong></div></div>

    <div class="col-12">
        <div class="content-card">
            <h5 class="fw-bold mb-4">Informations</h5>
            <div class="info-line"><span>Réforme</span><strong>{{ optional($action->reforme)->titre ?? '—' }}</strong></div>
            <div class="info-line"><span>Responsable</span><strong>{{ optional($action->responsable)->name ?? '—' }}</strong></div>
            <div class="info-line"><span>Statut</span><strong>{{ str_replace('_', ' ', $action->statut) }}</strong></div>
        </div>
    </div>

</div>

@include('back.innovations.actions._styles')
@endsection
