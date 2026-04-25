@extends('back.layouts.principal')

@section('title', 'Timeline suivi')
@section('page_title', 'Timeline du suivi')
@section('page_subtitle', optional($suivi->innovation)->titre ?? 'Innovation')

@section('content')
<div class="content-card">
    <div class="section-head">
        <div>
            <h4>Étapes du suivi</h4>
            <p>Chronologie des étapes opérationnelles.</p>
        </div>
        <a href="{{ route('back.innovations.suivis.show', $suivi) }}" class="btn btn-outline-secondary rounded-pill px-4">Retour</a>
    </div>

    <div class="timeline-list">
        @forelse($suivi->etapes as $etape)
            <div class="timeline-item">
                <div class="timeline-dot bg-warning"></div>
                <div class="timeline-card">
                    <strong>{{ $etape->titre }}</strong>
                    <p>{{ $etape->description ?? '—' }}</p>
                    <small>
                        {{ $etape->statut }}
                        @if($etape->date_echeance)
                            • échéance {{ $etape->date_echeance->format('d/m/Y') }}
                        @endif
                    </small>
                </div>
            </div>
        @empty
            <div class="text-center py-5 text-muted">Aucune étape.</div>
        @endforelse
    </div>
</div>

@include('back.innovations.suivis._styles')
@endsection
