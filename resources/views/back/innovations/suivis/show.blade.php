@extends('back.layouts.principal')

@section('title', 'Fiche suivi')
@section('page_title', 'Fiche suivi')
@section('page_subtitle', optional($suivi->innovation)->titre ?? 'Innovation')

@section('content')
<div class="row g-4">

    <div class="col-12">
        <div class="suivi-hero">
            <div>
                <span class="badge rounded-pill bg-warning-subtle text-warning mb-2">
                    {{ optional($suivi->date_suivi)->format('d/m/Y') ?? 'Date non définie' }}
                </span>
                <h2>{{ optional($suivi->innovation)->titre ?? 'Innovation non liée' }}</h2>
                <p>{{ $suivi->resume ?? 'Aucun résumé.' }}</p>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('back.innovations.suivis.timeline', $suivi) }}" class="btn btn-light rounded-pill px-4">Timeline</a>
                <a href="{{ route('back.innovations.suivis.blocages', $suivi) }}" class="btn btn-outline-light rounded-pill px-4">Blocages</a>
            </div>
        </div>
    </div>

    <div class="col-md-3"><div class="mini-stat-card"><span>Progression</span><strong>{{ $suivi->progression ?? 0 }}%</strong></div></div>
    <div class="col-md-3"><div class="mini-stat-card"><span>Étapes</span><strong>{{ $suivi->etapes->count() }}</strong></div></div>
    <div class="col-md-3"><div class="mini-stat-card"><span>Blocages</span><strong>{{ $suivi->blocages->count() }}</strong></div></div>
    <div class="col-md-3"><div class="mini-stat-card"><span>Notifications</span><strong>{{ $suivi->notifications->count() }}</strong></div></div>

    <div class="col-xl-4">
        <div class="content-card h-100">
            <h5 class="fw-bold mb-4">Informations</h5>
            <div class="info-line"><span>Statut global</span><strong>{{ $suivi->statut_global }}</strong></div>
            <div class="info-line"><span>Rédacteur</span><strong>{{ optional($suivi->redacteur)->name ?? '—' }}</strong></div>
            <div class="info-line"><span>Date</span><strong>{{ optional($suivi->date_suivi)->format('d/m/Y') ?? '—' }}</strong></div>
        </div>
    </div>

    <div class="col-xl-8">
        <div class="content-card h-100">
            <h5 class="fw-bold">Risques majeurs</h5>
            <p class="text-muted">{{ $suivi->risques_majeurs ?? 'Aucun risque majeur.' }}</p>

            <h5 class="fw-bold mt-4">Recommandations</h5>
            <p class="text-muted mb-0">{{ $suivi->recommandations ?? 'Aucune recommandation.' }}</p>
        </div>
    </div>

</div>

@include('back.innovations.suivis._styles')
@endsection
