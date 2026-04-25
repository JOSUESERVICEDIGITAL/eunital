@extends('back.layouts.principal')

@section('title', 'Rapports impact')
@section('page_title', 'Rapports d’impact')
@section('page_subtitle', optional($impact->innovation)->titre ?? 'Innovation')

@section('content')
<div class="content-card">
    <div class="section-head">
        <div>
            <h4>Rapports & preuves</h4>
            <p>Documents, preuves et synthèses d’impact.</p>
        </div>
        <a href="{{ route('back.innovations.impacts.show', $impact) }}" class="btn btn-outline-secondary rounded-pill px-4">Retour</a>
    </div>

    <div class="hub-list">
        @forelse($impact->rapports as $rapport)
            <div class="hub-list-item">
                <div class="hub-list-icon">
                    <i class="fa-solid fa-file-lines"></i>
                </div>
                <div class="flex-grow-1">
                    <div class="fw-bold">{{ $rapport->titre }}</div>
                    <small>{{ optional($rapport->redacteur)->name ?? '—' }}</small>
                    <p class="text-muted mt-2 mb-0">{{ $rapport->resume ?? 'Aucun résumé.' }}</p>
                </div>
                @if($rapport->fichier)
                    <a href="{{ asset('storage/' . $rapport->fichier) }}" target="_blank" class="btn btn-sm btn-light rounded-pill">Ouvrir</a>
                @endif
            </div>
        @empty
            <div class="text-center py-5 text-muted">Aucun rapport.</div>
        @endforelse
    </div>
</div>

@include('back.innovations.impacts._styles')
@endsection
