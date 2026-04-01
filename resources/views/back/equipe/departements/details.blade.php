@extends('back.layouts.principal')

@section('title', 'Détails département')
@section('page_title', 'Détails du département')
@section('page_subtitle', 'Vue complète du département, de ses postes et de ses membres.')

@section('content')
    <div class="content-card">
        <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
            <div>
                <h3 class="fw-bold mb-1">{{ $departement->nom }}</h3>
                <p class="text-muted mb-0">{{ $departement->description ?: 'Aucune description.' }}</p>
            </div>
            <a href="{{ route('back.equipe.departements.modifier', $departement) }}" class="btn btn-warning rounded-pill px-4">Modifier</a>
        </div>

        <div class="row g-4">
            <div class="col-lg-6">
                <div class="info-tile">
                    <span class="text-muted small">Postes liés</span>
                    <div class="fw-bold mt-2">{{ $departement->postes->count() }}</div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="info-tile">
                    <span class="text-muted small">Membres liés</span>
                    <div class="fw-bold mt-2">{{ $departement->membres->count() }}</div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .info-tile{padding:18px;border-radius:18px;border:1px solid #e5e7eb;background:#f8fafc}
    </style>
@endsection