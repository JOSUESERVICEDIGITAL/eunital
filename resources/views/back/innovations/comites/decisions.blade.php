@extends('back.layouts.principal')

@section('title', 'Décisions comité')
@section('page_title', 'Décisions du comité')
@section('page_subtitle', $comite->nom)

@section('content')
<div class="content-card">
    <div class="section-head">
        <div>
            <h4>Décisions</h4>
            <p>Arbitrages, validations et orientations issues des sessions.</p>
        </div>
        <a href="{{ route('back.innovations.comites.show', $comite) }}" class="btn btn-outline-secondary rounded-pill px-4">Retour</a>
    </div>

    <div class="hub-list">
        @forelse($comite->sessions as $session)
            @foreach($session->decisions as $decision)
                <div class="hub-list-item">
                    <div class="hub-list-icon decision">
                        <i class="fa-solid fa-scale-balanced"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="fw-bold">{{ $decision->titre }}</div>
                        <small>
                            Session : {{ $session->titre }}
                            • Statut : {{ $decision->statut }}
                        </small>
                        <p class="text-muted mt-2 mb-0">{{ $decision->decision }}</p>
                    </div>
                </div>
            @endforeach
        @empty
            <div class="text-center py-5 text-muted">Aucune décision.</div>
        @endforelse
    </div>
</div>

@include('back.innovations.comites._styles')
@endsection
