@extends('back.layouts.principal')

@section('title', 'Détails article')
@section('page_title', 'Détails de l’article')
@section('page_subtitle', 'Vue détaillée du contenu, de sa visibilité, de sa classification et de ses réglages.')

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="content-card h-100">
                <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
                    <div>
                        <h3 class="fw-bold mb-1">{{ $article->titre }}</h3>
                        <p class="text-muted mb-0">{{ $article->resume ?: 'Aucun résumé disponible.' }}</p>
                    </div>

                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('back.articles.modifier', $article) }}" class="btn btn-warning rounded-pill px-4">
                            <i class="fa-solid fa-pen me-2"></i>Modifier
                        </a>
                    </div>
                </div>

                @if($article->image_principale)
                    <div class="article-detail-image mb-4">
                        <img src="{{ asset('storage/' . $article->image_principale) }}" alt="{{ $article->titre }}">
                    </div>
                @endif

                <div class="article-content-box">
                    {!! nl2br(e($article->contenu)) !!}
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="content-card mb-4">
                <h5 class="fw-bold mb-3">Informations</h5>
                <div class="vstack gap-3">
                    <div class="info-tile">
                        <span class="text-muted small">Catégorie</span>
                        <div class="fw-bold">{{ $article->categorie->nom ?? 'Non classé' }}</div>
                    </div>

                    <div class="info-tile">
                        <span class="text-muted small">Auteur</span>
                        <div class="fw-bold">{{ $article->auteur->name ?? 'Inconnu' }}</div>
                    </div>

                    <div class="info-tile">
                        <span class="text-muted small">Statut</span>
                        <div class="fw-bold">
                            @if($article->statut === 'publie')
                                <span class="badge rounded-pill text-bg-success">Publié</span>
                            @elseif($article->statut === 'brouillon')
                                <span class="badge rounded-pill text-bg-warning">Brouillon</span>
                            @else
                                <span class="badge rounded-pill text-bg-danger">Archivé</span>
                            @endif
                        </div>
                    </div>

                    <div class="info-tile">
                        <span class="text-muted small">Vues</span>
                        <div class="fw-bold">{{ $article->nombre_vues }}</div>
                    </div>

                    <div class="info-tile">
                        <span class="text-muted small">Publication</span>
                        <div class="fw-bold">{{ $article->date_publication ? $article->date_publication->format('d/m/Y H:i') : 'Non publiée' }}</div>
                    </div>
                </div>
            </div>

            <div class="content-card">
                <h5 class="fw-bold mb-3">Étiquettes</h5>
                <div class="d-flex flex-wrap gap-2">
                    @forelse($article->etiquettes as $etiquette)
                        <span class="badge rounded-pill text-bg-info">{{ $etiquette->nom }}</span>
                    @empty
                        <span class="text-muted">Aucune étiquette.</span>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <style>
        .info-tile{padding:18px;border-radius:18px;border:1px solid #e5e7eb;background:#f8fafc}
        .article-detail-image img{width:100%;max-height:340px;object-fit:cover;border-radius:22px}
        .article-content-box{line-height:1.9;color:#334155}
    </style>
@endsection