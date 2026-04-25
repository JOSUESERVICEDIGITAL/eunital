@extends('back.layouts.principal')

@section('title', 'Sites pilotes')
@section('page_title', 'Sites pilotes')
@section('page_subtitle', $experimentation->titre)

@section('content')
<div class="content-card">
    <div class="section-head">
        <div>
            <h4>Sites pilotes</h4>
            <p>Zones et structures où l’expérimentation est testée.</p>
        </div>
        <a href="{{ route('back.innovations.experimentations.show', $experimentation) }}" class="btn btn-outline-secondary rounded-pill px-4">Retour</a>
    </div>

    <div class="row g-3">
        @forelse($experimentation->sites as $site)
            <div class="col-md-4">
                <div class="pilot-card">
                    <h6>{{ $site->nom_site }}</h6>
                    <p>Responsable : {{ $site->responsable_local ?? '—' }}</p>
                    <small>Contact : {{ $site->contact_local ?? '—' }}</small>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5 text-muted">Aucun site pilote.</div>
        @endforelse
    </div>
</div>

@include('back.innovations.experimentations._styles')
@endsection
