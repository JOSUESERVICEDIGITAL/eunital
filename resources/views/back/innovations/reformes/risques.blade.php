@extends('back.layouts.principal')

@section('title', 'Risques réforme')
@section('page_title', 'Risques')
@section('page_subtitle', $reforme->titre)

@section('content')
<div class="content-card">
    <div class="section-head">
        <div>
            <h4>Risques identifiés</h4>
            <p>Blocages, menaces et mesures de mitigation.</p>
        </div>
        <a href="{{ route('back.innovations.reformes.show', $reforme) }}" class="btn btn-outline-secondary rounded-pill px-4">Retour</a>
    </div>

    <div class="row g-3">
        @forelse($reforme->risques as $risque)
            <div class="col-md-4">
                <div class="risk-card">
                    <div class="d-flex justify-content-between gap-3">
                        <h6>{{ $risque->titre }}</h6>
                        <span class="badge bg-danger-subtle text-danger">{{ $risque->niveau }}</span>
                    </div>
                    <p>{{ $risque->description }}</p>
                    <small><strong>Mitigation :</strong> {{ $risque->mesure_mitigation ?? '—' }}</small>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5 text-muted">Aucun risque.</div>
        @endforelse
    </div>
</div>

@include('back.innovations.reformes._styles')
@endsection
