@extends('back.layouts.principal')
@section('title', 'Détails poste')
@section('page_title', 'Détails du poste')
@section('page_subtitle', 'Vue complète du poste, de son département et des membres liés.')
@section('content')
    <div class="content-card">
        <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
            <div>
                <h3 class="fw-bold mb-1">{{ $poste->nom }}</h3>
                <p class="text-muted mb-0">{{ $poste->description ?: 'Aucune description.' }}</p>
            </div>
            <a href="{{ route('back.equipe.postes.modifier', $poste) }}" class="btn btn-warning rounded-pill px-4">Modifier</a>
        </div>

        <div class="row g-4">
            <div class="col-md-6"><div class="info-tile"><span class="text-muted small">Département</span><div class="fw-bold mt-2">{{ $poste->departement->nom ?? 'Non défini' }}</div></div></div>
            <div class="col-md-6"><div class="info-tile"><span class="text-muted small">Membres liés</span><div class="fw-bold mt-2">{{ $poste->membres->count() }}</div></div></div>
        </div>
    </div>

    <style>
        .info-tile{padding:18px;border-radius:18px;border:1px solid #e5e7eb;background:#f8fafc}
    </style>
@endsection