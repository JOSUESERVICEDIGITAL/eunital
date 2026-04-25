@extends('back.layouts.principal')

@section('title', 'Décisions réforme')
@section('page_title', 'Décisions')
@section('page_subtitle', $reforme->titre)

@section('content')
<div class="content-card">
    <div class="section-head">
        <div>
            <h4>Décisions</h4>
            <p>Arbitrages et décisions prises autour de la réforme.</p>
        </div>
        <a href="{{ route('back.innovations.reformes.show', $reforme) }}" class="btn btn-outline-secondary rounded-pill px-4">Retour</a>
    </div>

    <div class="timeline-list">
        @forelse($reforme->decisions as $decision)
            <div class="timeline-item">
                <div class="timeline-dot bg-warning"></div>
                <div class="timeline-card">
                    <strong>{{ $decision->titre }}</strong>
                    <p>{{ $decision->decision }}</p>
                    <small>{{ optional($decision->date_decision)->format('d/m/Y') ?? 'Date non définie' }}</small>
                </div>
            </div>
        @empty
            <div class="text-center py-5 text-muted">Aucune décision.</div>
        @endforelse
    </div>
</div>

@include('back.innovations.reformes._styles')
@endsection
