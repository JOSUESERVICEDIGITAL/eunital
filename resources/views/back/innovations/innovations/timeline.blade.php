@extends('back.layouts.principal')

@section('title', 'Timeline innovation')
@section('page_title', 'Timeline')
@section('page_subtitle', $innovation->titre)

@section('content')
<div class="content-card">
    <div class="section-head">
        <div>
            <h4>Chronologie</h4>
            <p>Suivis, expérimentations et déploiements.</p>
        </div>
        <a href="{{ route('back.innovations.innovations.show', $innovation) }}" class="btn btn-outline-secondary rounded-pill px-4">Retour</a>
    </div>

    <div class="timeline-list">
        @foreach($suivis as $suivi)
            <div class="timeline-item">
                <div class="timeline-dot bg-primary"></div>
                <div class="timeline-card">
                    <strong>Suivi : {{ $suivi->statut_global }}</strong>
                    <p>{{ $suivi->resume }}</p>
                    <small>{{ optional($suivi->date_suivi)->format('d/m/Y') }}</small>
                </div>
            </div>
        @endforeach

        @foreach($experimentations as $experimentation)
            <div class="timeline-item">
                <div class="timeline-dot bg-warning"></div>
                <div class="timeline-card">
                    <strong>Expérimentation : {{ $experimentation->titre }}</strong>
                    <p>{{ $experimentation->statut }}</p>
                </div>
            </div>
        @endforeach

        @foreach($deploiements as $deploiement)
            <div class="timeline-item">
                <div class="timeline-dot bg-success"></div>
                <div class="timeline-card">
                    <strong>Déploiement : {{ $deploiement->titre }}</strong>
                    <p>{{ $deploiement->statut }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>

@include('back.innovations.innovations._styles')
@endsection
