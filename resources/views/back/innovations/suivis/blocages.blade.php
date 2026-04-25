@extends('back.layouts.principal')

@section('title', 'Blocages suivi')
@section('page_title', 'Blocages')
@section('page_subtitle', optional($suivi->innovation)->titre ?? 'Innovation')

@section('content')
<div class="content-card">
    <div class="section-head">
        <div>
            <h4>Blocages identifiés</h4>
            <p>Freins, risques opérationnels et points à lever.</p>
        </div>
        <a href="{{ route('back.innovations.suivis.show', $suivi) }}" class="btn btn-outline-secondary rounded-pill px-4">Retour</a>
    </div>

    <div class="row g-3">
        @forelse($suivi->blocages as $blocage)
            <div class="col-md-4">
                <div class="block-card">
                    <div class="d-flex justify-content-between gap-3">
                        <h6>{{ $blocage->titre }}</h6>
                        <span class="badge bg-danger-subtle text-danger">{{ $blocage->niveau_criticite }}</span>
                    </div>
                    <p>{{ $blocage->description ?? '—' }}</p>
                    <small>{{ $blocage->statut }}</small>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5 text-muted">Aucun blocage.</div>
        @endforelse
    </div>
</div>

@include('back.innovations.suivis._styles')
@endsection
