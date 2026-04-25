@extends('back.layouts.principal')

@section('title', 'Fiche idée')
@section('page_title', $idee->titre)
@section('page_subtitle', 'Analyse et maturation de l’idée.')

@section('content')
<div class="row g-4">

    <div class="col-12">
        <div class="idea-hero">
            <div>
                <span class="badge rounded-pill bg-warning-subtle text-warning mb-2">{{ $idee->origine }}</span>
                <h2>{{ $idee->titre }}</h2>
                <p>{{ $idee->description }}</p>
            </div>

            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('back.innovations.idees.edit', $idee) }}" class="btn btn-warning rounded-pill px-4">Modifier</a>
                <a href="{{ route('back.innovations.idees.index') }}" class="btn btn-outline-light rounded-pill px-4">Retour</a>
            </div>
        </div>
    </div>

    <div class="col-md-3"><div class="mini-stat-card"><span>Votes</span><strong>{{ $idee->votes->count() }}</strong></div></div>
    <div class="col-md-3"><div class="mini-stat-card"><span>Commentaires</span><strong>{{ $idee->commentaires->count() }}</strong></div></div>
    <div class="col-md-3"><div class="mini-stat-card"><span>Maturité</span><strong>{{ $idee->niveau_maturite }}</strong></div></div>
    <div class="col-md-3"><div class="mini-stat-card"><span>Statut</span><strong>{{ $idee->statut }}</strong></div></div>

    <div class="col-xl-4">
        <div class="content-card h-100">
            <h5 class="fw-bold mb-4">Informations</h5>
            <div class="info-line"><span>Catégorie</span><strong>{{ $idee->categorie ?? '—' }}</strong></div>
            <div class="info-line"><span>Impact</span><strong>{{ $idee->impact_potentiel }}</strong></div>
            <div class="info-line"><span>Faisabilité</span><strong>{{ $idee->faisabilite }}</strong></div>
            <div class="info-line"><span>Auteur</span><strong>{{ $idee->anonyme ? 'Anonyme' : (optional($idee->auteur)->name ?? '—') }}</strong></div>
        </div>
    </div>

    <div class="col-xl-8">
        <div class="content-card h-100">
            <h5 class="fw-bold mb-4">Tags</h5>
            <div class="d-flex flex-wrap gap-2">
                @forelse($idee->tags as $tag)
                    <span class="badge rounded-pill bg-light text-dark border px-3 py-2">{{ $tag->nom }}</span>
                @empty
                    <span class="text-muted">Aucun tag.</span>
                @endforelse
            </div>
        </div>
    </div>

</div>

@include('back.innovations.idees._styles')
@endsection
