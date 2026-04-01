@extends('back.layouts.principal')

@section('title', 'Tableau de bord articles')
@section('page_title', 'Tableau de bord éditorial')
@section('page_subtitle', 'Vue synthétique des performances et de l’état global des articles.')

@section('content')
    <div class="row g-4">
        <div class="col-md-3">
            <div class="content-card h-100">
                <div class="mini-label">Total articles</div>
                <h3 class="stat-number">{{ $totalArticles }}</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="content-card h-100">
                <div class="mini-label">Articles publiés</div>
                <h3 class="stat-number">{{ $articlesPublies }}</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="content-card h-100">
                <div class="mini-label">Articles brouillons</div>
                <h3 class="stat-number">{{ $articlesBrouillons }}</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="content-card h-100">
                <div class="mini-label">Articles archivés</div>
                <h3 class="stat-number">{{ $articlesArchives }}</h3>
            </div>
        </div>

        <div class="col-12">
            <div class="content-card">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <h4 class="fw-bold mb-1">Centre éditorial</h4>
                        <p class="text-muted mb-0">Accède rapidement aux contenus et à leurs statuts.</p>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('back.articles.tous') }}" class="btn btn-outline-dark rounded-pill px-4">Tous les articles</a>
                        <a href="{{ route('back.articles.creer') }}" class="btn btn-primary rounded-pill px-4">Créer un article</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .mini-label{font-size:13px;color:#64748b;font-weight:700;margin-bottom:8px}
        .stat-number{font-size:34px;font-weight:800;margin:0}
    </style>
@endsection