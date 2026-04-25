@extends('back.layouts.principal')

@section('title', 'Fiche expérimentation')
@section('page_title', $experimentation->titre)
@section('page_subtitle', 'Suivi complet du test terrain.')

@section('content')
<div class="row g-4">

    <div class="col-12">
        <div class="experimentation-hero">
            <div>
                <span class="badge rounded-pill bg-warning-subtle text-warning mb-2">{{ $experimentation->statut }}</span>
                <h2>{{ $experimentation->titre }}</h2>
                <p>{{ $experimentation->description ?? 'Aucune description.' }}</p>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('back.innovations.experimentations.edit', $experimentation) }}" class="btn btn-warning rounded-pill px-4">Modifier</a>
                <a href="{{ route('back.innovations.experimentations.rapport', $experimentation) }}" class="btn btn-outline-light rounded-pill px-4">Rapport</a>
            </div>
        </div>
    </div>

    <div class="col-md-3"><div class="mini-stat-card"><span>Sites pilotes</span><strong>{{ $experimentation->sites->count() }}</strong></div></div>
    <div class="col-md-3"><div class="mini-stat-card"><span>Résultats</span><strong>{{ $experimentation->resultats->count() }}</strong></div></div>
    <div class="col-md-3"><div class="mini-stat-card"><span>Décisions</span><strong>{{ $experimentation->decisions->count() }}</strong></div></div>
    <div class="col-md-3"><div class="mini-stat-card"><span>Satisfaction</span><strong>{{ $experimentation->satisfactions->count() }}</strong></div></div>

    <div class="col-xl-4">
        <div class="content-card h-100">
            <h5 class="fw-bold mb-4">Informations</h5>
            <div class="info-line"><span>Innovation</span><strong>{{ optional($experimentation->innovation)->titre ?? '—' }}</strong></div>
            <div class="info-line"><span>Responsable</span><strong>{{ optional($experimentation->responsable)->name ?? '—' }}</strong></div>
            <div class="info-line"><span>Début</span><strong>{{ optional($experimentation->date_debut)->format('d/m/Y') ?? '—' }}</strong></div>
            <div class="info-line"><span>Fin</span><strong>{{ optional($experimentation->date_fin)->format('d/m/Y') ?? '—' }}</strong></div>
        </div>
    </div>

    <div class="col-xl-8">
        <div class="content-card h-100">
            <h5 class="fw-bold mb-4">Modules rapides</h5>
            <div class="row g-3">
                <div class="col-md-4"><a href="{{ route('back.innovations.experimentations.sites', $experimentation) }}" class="module-card">Sites pilotes</a></div>
                <div class="col-md-4"><a href="{{ route('back.innovations.experimentations.resultats', $experimentation) }}" class="module-card">Résultats</a></div>
                <div class="col-md-4"><a href="{{ route('back.innovations.experimentations.decisions', $experimentation) }}" class="module-card">Décisions</a></div>
            </div>

            <div class="mt-4">
                <h6 class="fw-bold">Hypothèse</h6>
                <p class="text-muted">{{ $experimentation->hypothese ?? 'Aucune hypothèse.' }}</p>

                <h6 class="fw-bold">Résultat global</h6>
                <p class="text-muted mb-0">{{ $experimentation->resultat_global ?? 'Aucun résultat global.' }}</p>
            </div>
        </div>
    </div>

</div>

@include('back.innovations.experimentations._styles')
@endsection
