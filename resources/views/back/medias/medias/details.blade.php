@extends('back.layouts.principal')

@section('title', 'Détails média')
@section('page_title', 'Détails du média')
@section('page_subtitle', 'Consultation complète du média, de sa source, de sa catégorie et de son usage.')

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="content-card">
                <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
                    <div>
                        <h3 class="fw-bold mb-1">{{ $media->titre }}</h3>
                        <p class="text-muted mb-0">{{ $media->description ?: 'Aucune description.' }}</p>
                    </div>

                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('back.medias.fichiers.modifier', $media) }}" class="btn btn-warning rounded-pill px-4">Modifier</a>
                    </div>
                </div>

                @if($media->miniature)
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $media->miniature) }}" alt="{{ $media->titre }}" class="detail-media-preview">
                    </div>
                @elseif($media->fichier && $media->type_media === 'image')
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $media->fichier) }}" alt="{{ $media->titre }}" class="detail-media-preview">
                    </div>
                @endif

                <div class="row g-3">
                    <div class="col-md-6"><div class="info-tile"><span class="text-muted small">Type</span><div class="fw-bold mt-2">{{ ucfirst($media->type_media) }}</div></div></div>
                    <div class="col-md-6"><div class="info-tile"><span class="text-muted small">Catégorie</span><div class="fw-bold mt-2">{{ $media->categorie->nom ?? 'Sans catégorie' }}</div></div></div>
                    <div class="col-md-6"><div class="info-tile"><span class="text-muted small">Mime type</span><div class="fw-bold mt-2">{{ $media->mime_type ?: 'Non défini' }}</div></div></div>
                    <div class="col-md-6"><div class="info-tile"><span class="text-muted small">Extension</span><div class="fw-bold mt-2">{{ $media->extension ?: 'Non définie' }}</div></div></div>
                    <div class="col-md-6"><div class="info-tile"><span class="text-muted small">Visibilité</span><div class="fw-bold mt-2">{{ $media->est_public ? 'Public' : 'Privé' }}</div></div></div>
                    <div class="col-md-6"><div class="info-tile"><span class="text-muted small">Mise en avant</span><div class="fw-bold mt-2">{{ $media->est_en_avant ? 'Oui' : 'Non' }}</div></div></div>
                    <div class="col-md-6"><div class="info-tile"><span class="text-muted small">Utilisateur</span><div class="fw-bold mt-2">{{ $media->utilisateur->name ?? 'Système' }}</div></div></div>
                    <div class="col-md-6"><div class="info-tile"><span class="text-muted small">Taille</span><div class="fw-bold mt-2">{{ $media->taille ? number_format($media->taille / 1024, 2) . ' Ko' : 'Non définie' }}</div></div></div>
                </div>

                @if($media->url_externe)
                    <div class="mt-4">
                        <a href="{{ $media->url_externe }}" target="_blank" class="btn btn-outline-primary rounded-pill px-4">
                            Ouvrir le lien externe
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        .info-tile{padding:18px;border-radius:18px;border:1px solid #e5e7eb;background:#f8fafc}
        .detail-media-preview{width:100%;max-height:380px;object-fit:cover;border-radius:22px;border:1px solid #e5e7eb}
        .existing-image-box{padding:16px;border-radius:18px;border:1px solid #e5e7eb;background:#f8fafc}
        .existing-image-box img{max-width:100%;height:220px;object-fit:cover;border-radius:16px}
    </style>
@endsection