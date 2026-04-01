@extends('back.layouts.principal')
@section('title', 'Détails catégorie média')
@section('page_title', 'Détails de la catégorie média')
@section('page_subtitle', 'Vue complète de la catégorie et des médias liés.')
@section('content')
    <div class="content-card">
        <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
            <div>
                <h3 class="fw-bold mb-1">{{ $categorieMedia->nom }}</h3>
                <p class="text-muted mb-0">{{ $categorieMedia->description ?: 'Aucune description.' }}</p>
            </div>
            <a href="{{ route('back.medias.categories.modifier', $categorieMedia) }}" class="btn btn-warning rounded-pill px-4">Modifier</a>
        </div>

        <div class="row g-4">
            <div class="col-lg-6">
                <div class="info-tile">
                    <span class="text-muted small">Slug</span>
                    <div class="fw-bold mt-2">{{ $categorieMedia->slug }}</div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="info-tile">
                    <span class="text-muted small">Médias liés</span>
                    <div class="fw-bold mt-2">{{ $categorieMedia->medias->count() }}</div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .info-tile{padding:18px;border-radius:18px;border:1px solid #e5e7eb;background:#f8fafc}
    </style>
@endsection