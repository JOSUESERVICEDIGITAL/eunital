@extends('back.layouts.principal')

@section('title', 'Fiche partenariat')
@section('page_title', $partenariat->nom_partenaire ?? $partenariat->nom ?? 'Partenariat')
@section('page_subtitle', optional($partenariat->innovation)->titre ?? 'Innovation non liée')

@section('content')
<div class="row g-4">

    <div class="col-12">
        <div class="partenariat-hero">
            <div>
                <span class="badge rounded-pill bg-warning-subtle text-warning mb-2">
                    {{ $partenariat->type_partenaire ?? 'Partenaire' }}
                </span>
                <h2>{{ $partenariat->nom_partenaire ?? $partenariat->nom ?? 'Partenaire' }}</h2>
                <p>{{ $partenariat->contribution ?? 'Aucune contribution renseignée.' }}</p>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('back.innovations.partenariats.edit', $partenariat) }}" class="btn btn-warning rounded-pill px-4">Modifier</a>
                <a href="{{ route('back.innovations.partenariats.index') }}" class="btn btn-outline-light rounded-pill px-4">Retour</a>
            </div>
        </div>
    </div>

    <div class="col-md-3"><div class="mini-stat-card"><span>Statut</span><strong>{{ $partenariat->statut ?? 'actif' }}</strong></div></div>
    <div class="col-md-3"><div class="mini-stat-card"><span>Type</span><strong>{{ $partenariat->type_partenaire ?? '—' }}</strong></div></div>
    <div class="col-md-3"><div class="mini-stat-card"><span>Début</span><strong>{{ optional($partenariat->date_debut ?? null)->format('d/m/Y') ?? '—' }}</strong></div></div>
    <div class="col-md-3"><div class="mini-stat-card"><span>Fin</span><strong>{{ optional($partenariat->date_fin ?? null)->format('d/m/Y') ?? '—' }}</strong></div></div>

    <div class="col-12">
        <div class="content-card">
            <h5 class="fw-bold mb-4">Informations du partenariat</h5>
            <div class="info-line"><span>Innovation</span><strong>{{ optional($partenariat->innovation)->titre ?? '—' }}</strong></div>
            <div class="info-line"><span>Contact</span><strong>{{ $partenariat->contact ?? '—' }}</strong></div>
            <div class="info-line"><span>Email</span><strong>{{ $partenariat->email ?? '—' }}</strong></div>
            <div class="info-line"><span>Téléphone</span><strong>{{ $partenariat->telephone ?? '—' }}</strong></div>
        </div>
    </div>

</div>

@include('back.innovations.partenariats._styles')
@endsection
