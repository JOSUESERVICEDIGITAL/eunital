@extends('back.layouts.principal')

@section('title', 'Idées populaires')
@section('page_title', 'Idées populaires')
@section('page_subtitle', 'Classement des idées par nombre de votes.')

@section('content')
<div class="content-card">
    <div class="section-head">
        <div>
            <h4>Classement populaire</h4>
            <p>Les idées les plus soutenues.</p>
        </div>
        <a href="{{ route('back.innovations.idees.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Retour</a>
    </div>

    <div class="row g-3">
        @forelse($idees as $idee)
            <div class="col-md-4">
                <a href="{{ route('back.innovations.idees.show', $idee) }}" class="idea-card">
                    <div class="d-flex justify-content-between gap-3">
                        <h6>{{ $idee->titre }}</h6>
                        <span class="badge bg-warning-subtle text-warning">{{ $idee->votes_count }} votes</span>
                    </div>
                    <p>{{ Str::limit($idee->description, 120) }}</p>
                    <small>{{ $idee->statut }} • {{ $idee->niveau_maturite }}</small>
                </a>
            </div>
        @empty
            <div class="col-12 text-center text-muted py-5">Aucune idée populaire.</div>
        @endforelse
    </div>

    <div class="mt-4">{{ $idees->links() }}</div>
</div>

@include('back.innovations.idees._styles')
@endsection
