@extends('back.layouts.principal')

@section('title', 'Décisions expérimentation')
@section('page_title', 'Décisions')
@section('page_subtitle', $experimentation->titre)

@section('content')
<div class="content-card">
    <div class="section-head">
        <div>
            <h4>Décisions après expérimentation</h4>
            <p>Déployer, ajuster, prolonger ou abandonner.</p>
        </div>
        <a href="{{ route('back.innovations.experimentations.show', $experimentation) }}" class="btn btn-outline-secondary rounded-pill px-4">Retour</a>
    </div>

    <div class="timeline-list">
        @forelse($experimentation->decisions as $decision)
            <div class="timeline-item">
                <div class="timeline-dot bg-warning"></div>
                <div class="timeline-card">
                    <strong>{{ ucfirst($decision->decision) }}</strong>
                    <p>{{ $decision->motif ?? 'Aucun motif.' }}</p>
                    <small>{{ optional($decision->date_decision)->format('d/m/Y') ?? 'Date non définie' }}</small>
                </div>
            </div>
        @empty
            <div class="text-center py-5 text-muted">Aucune décision.</div>
        @endforelse
    </div>
</div>

@include('back.innovations.experimentations._styles')
@endsection
