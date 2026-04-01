@extends('back.layouts.principal')
@section('title', 'Détails lien social')
@section('page_title', 'Détails du lien social')
@section('page_subtitle', 'Vue complète du lien, de son emplacement et de son statut.')
@section('content')
    <div class="content-card">
        <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
            <div>
                <h3 class="fw-bold mb-1">{{ $lienSocial->nom }}</h3>
                <p class="text-muted mb-0">{{ $lienSocial->url }}</p>
            </div>
            <a href="{{ route('back.medias.liens-sociaux.modifier', $lienSocial) }}" class="btn btn-warning rounded-pill px-4">Modifier</a>
        </div>

        <div class="row g-4">
            <div class="col-md-6"><div class="info-tile"><span class="text-muted small">Icône</span><div class="fw-bold mt-2">{{ $lienSocial->icone ?: 'Non définie' }}</div></div></div>
            <div class="col-md-6"><div class="info-tile"><span class="text-muted small">Emplacement</span><div class="fw-bold mt-2">{{ ucfirst($lienSocial->emplacement) }}</div></div></div>
            <div class="col-md-6"><div class="info-tile"><span class="text-muted small">Ordre</span><div class="fw-bold mt-2">{{ $lienSocial->ordre_affichage }}</div></div></div>
            <div class="col-md-6"><div class="info-tile"><span class="text-muted small">Statut</span><div class="fw-bold mt-2">{{ $lienSocial->est_actif ? 'Actif' : 'Inactif' }}</div></div></div>
        </div>
    </div>

    <style>
        .info-tile{padding:18px;border-radius:18px;border:1px solid #e5e7eb;background:#f8fafc}
    </style>
@endsection