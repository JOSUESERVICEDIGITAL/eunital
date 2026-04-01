@extends('back.layouts.principal')

@section('title', 'Créer un article')
@section('page_title', 'Nouvel article')
@section('page_subtitle', 'Création d’un nouveau contenu éditorial dans la chambre des articles.')

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="content-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 class="fw-bold mb-1">Formulaire de création</h4>
                        <p class="text-muted mb-0">Renseigne les informations du nouvel article.</p>
                    </div>
                    <span class="badge rounded-pill text-bg-info px-3 py-2">Nouvelle publication</span>
                </div>

                <form method="POST" action="{{ route('back.articles.enregistrer') }}" enctype="multipart/form-data">
                    @csrf

                    @include('back.contenus.articles._formulaire', [
                        'article' => null,
                        'categories' => $categories,
                        'etiquettes' => $etiquettes
                    ])

                    <div class="d-flex flex-wrap gap-2 mt-4">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            <i class="fa-solid fa-floppy-disk me-2"></i>Enregistrer
                        </button>

                        <a href="{{ route('back.articles.tous') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="content-card h-100">
                <h5 class="fw-bold mb-3">Conseils de rédaction</h5>
                <div class="vstack gap-3">
                    <div class="advice-box">
                        <strong>Titre fort</strong>
                        <p class="mb-0 text-muted small">Choisis un titre clair, précis et accrocheur.</p>
                    </div>
                    <div class="advice-box">
                        <strong>Résumé utile</strong>
                        <p class="mb-0 text-muted small">Le résumé doit donner envie de lire sans tout révéler.</p>
                    </div>
                    <div class="advice-box">
                        <strong>Bonne classification</strong>
                        <p class="mb-0 text-muted small">Attribue une catégorie et des étiquettes pertinentes.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .advice-box{padding:16px;border:1px solid #e5e7eb;border-radius:16px;background:#f8fafc}
        .existing-image-box{padding:16px;border-radius:18px;border:1px solid #e5e7eb;background:#f8fafc}
        .existing-image-box img{max-width:100%;height:220px;object-fit:cover;border-radius:16px}
    </style>
@endsection