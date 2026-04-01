@extends('back.layouts.principal')

@section('title', 'Détails étiquette')
@section('page_title', 'Détails de l’étiquette')
@section('page_subtitle', 'Vue détaillée du mot-clé, de son identité et de ses contenus liés.')

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="content-card h-100">
                <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
                    <div>
                        <h3 class="fw-bold mb-1">{{ $etiquette->nom }}</h3>
                        <p class="text-muted mb-0">Mot-clé éditorial utilisé pour enrichir la classification des contenus.</p>
                    </div>

                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('back.etiquettes.modifier', $etiquette) }}" class="btn btn-warning rounded-pill px-4">
                            <i class="fa-solid fa-pen me-2"></i>Modifier
                        </a>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="info-tile">
                            <span class="text-muted small">Nom</span>
                            <div class="fw-bold">{{ $etiquette->nom }}</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="info-tile">
                            <span class="text-muted small">Slug</span>
                            <div class="fw-bold">{{ $etiquette->slug }}</div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="info-tile">
                            <span class="text-muted small">Articles associés</span>
                            <div class="fw-bold mt-1">{{ $etiquette->articles->count() }}</div>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <h5 class="fw-bold mb-3">Articles liés</h5>

                    <div class="vstack gap-3">
                        @forelse($etiquette->articles as $article)
                            <div class="linked-article-box">
                                <div class="fw-bold">{{ $article->titre }}</div>
                                <div class="text-muted small mt-1">
                                    Catégorie : {{ $article->categorie->nom ?? 'Non classé' }} —
                                    Auteur : {{ $article->auteur->name ?? 'Inconnu' }}
                                </div>
                            </div>
                        @empty
                            <div class="text-muted">Aucun article n’est encore lié à cette étiquette.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="content-card">
                <h5 class="fw-bold mb-3">Actions rapides</h5>
                <div class="d-grid gap-2">
                    <a href="{{ route('back.etiquettes.toutes') }}" class="btn btn-outline-dark rounded-pill">Toutes les étiquettes</a>
                    <a href="{{ route('back.etiquettes.creer') }}" class="btn btn-primary rounded-pill">Créer une étiquette</a>
                </div>
            </div>
        </div>
    </div>

    <style>
        .info-tile{padding:18px;border-radius:18px;border:1px solid #e5e7eb;background:#f8fafc}
        .linked-article-box{padding:16px;border-radius:16px;border:1px solid #e5e7eb;background:#fff}
    </style>
@endsection