@extends('back.layouts.principal')

@section('title', 'Fiche innovation')
@section('page_title', $innovation->titre)
@section('page_subtitle', 'Fiche centrale de pilotage de l’innovation.')

@section('content')
<div class="row g-4">

    <div class="col-12">
        <div class="innovation-show-hero">
            <div>
                <span class="badge rounded-pill bg-warning-subtle text-warning mb-2">{{ $innovation->type_innovation }}</span>
                <h2>{{ $innovation->titre }}</h2>
                <p>{{ $innovation->description ?? 'Aucune description.' }}</p>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('back.innovations.innovations.edit', $innovation) }}" class="btn btn-warning rounded-pill px-4">Modifier</a>
                <a href="{{ route('back.innovations.innovations.synthese', $innovation) }}" class="btn btn-light rounded-pill px-4">Synthèse</a>
                <a href="{{ route('back.innovations.innovations.performance', $innovation) }}" class="btn btn-outline-light rounded-pill px-4">Performance</a>
            </div>
        </div>
    </div>

    @php
        $stats = [
            ['label' => 'Objectifs', 'value' => $innovation->objectifs->count()],
            ['label' => 'Indicateurs', 'value' => $innovation->indicateurs->count()],
            ['label' => 'Expérimentations', 'value' => $innovation->experimentations->count()],
            ['label' => 'Déploiements', 'value' => $innovation->deploiements->count()],
            ['label' => 'Suivis', 'value' => $innovation->suivis->count()],
            ['label' => 'Impacts', 'value' => $innovation->impacts->count()],
        ];
    @endphp

    @foreach($stats as $stat)
        <div class="col-md-2">
            <div class="mini-stat-card text-center">
                <span>{{ $stat['label'] }}</span>
                <strong>{{ $stat['value'] }}</strong>
            </div>
        </div>
    @endforeach

    <div class="col-xl-4">
        <div class="content-card h-100">
            <h5 class="fw-bold mb-4">Informations générales</h5>

            <div class="info-line"><span>Code</span><strong>{{ $innovation->code }}</strong></div>
            <div class="info-line"><span>Statut</span><strong>{{ $innovation->statut }}</strong></div>
            <div class="info-line"><span>Priorité</span><strong>{{ $innovation->niveau_priorite }}</strong></div>
            <div class="info-line"><span>Portefeuille</span><strong>{{ optional($innovation->portefeuille)->nom ?? '—' }}</strong></div>
            <div class="info-line"><span>Responsable</span><strong>{{ optional($innovation->responsable)->name ?? '—' }}</strong></div>
            <div class="info-line"><span>Sponsor</span><strong>{{ optional($innovation->sponsor)->name ?? '—' }}</strong></div>
        </div>
    </div>

    <div class="col-xl-8">
        <div class="content-card h-100">
            <div class="section-head">
                <div>
                    <h4>Modules rapides</h4>
                    <p>Accès aux composantes de cette innovation.</p>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-md-4"><a class="module-card" href="{{ route('back.innovations.innovations.timeline', $innovation) }}">Timeline</a></div>
                <div class="col-md-4"><a class="module-card" href="{{ route('back.innovations.objectifs.index', ['innovation_id' => $innovation->id]) }}">Objectifs</a></div>
                <div class="col-md-4"><a class="module-card" href="{{ route('back.innovations.indicateurs.index', ['innovation_id' => $innovation->id]) }}">Indicateurs</a></div>
                <div class="col-md-4"><a class="module-card" href="{{ route('back.innovations.experimentations.index', ['innovation_id' => $innovation->id]) }}">Expérimentations</a></div>
                <div class="col-md-4"><a class="module-card" href="{{ route('back.innovations.deploiements.index', ['innovation_id' => $innovation->id]) }}">Déploiements</a></div>
                <div class="col-md-4"><a class="module-card" href="{{ route('back.innovations.impacts.index', ['innovation_id' => $innovation->id]) }}">Impacts</a></div>
            </div>
        </div>
    </div>

</div>

@include('back.innovations.innovations._styles')
@endsection
