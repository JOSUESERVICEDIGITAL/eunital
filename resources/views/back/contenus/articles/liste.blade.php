@extends('back.layouts.principal')

@section('title', 'Articles')
@section('page_title', 'Chambre des articles')
@section('page_subtitle', 'Gestion, publication, archivage et pilotage éditorial des contenus.')

@section('content')
    <div class="row g-4">

        <div class="col-12">
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="content-card h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="mini-label">Total articles</div>
                                <h3 class="stat-number">{{ $articles->total() }}</h3>
                            </div>
                            <div class="stat-icon bg-info-subtle text-info">
                                <i class="fa-solid fa-newspaper"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="content-card h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="mini-label">Publiés</div>
                                <h3 class="stat-number">{{ $articles->where('statut', 'publie')->count() }}</h3>
                            </div>
                            <div class="stat-icon bg-success-subtle text-success">
                                <i class="fa-solid fa-circle-check"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="content-card h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="mini-label">Brouillons</div>
                                <h3 class="stat-number">{{ $articles->where('statut', 'brouillon')->count() }}</h3>
                            </div>
                            <div class="stat-icon bg-warning-subtle text-warning">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="content-card h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="mini-label">Archivés</div>
                                <h3 class="stat-number">{{ $articles->where('statut', 'archive')->count() }}</h3>
                            </div>
                            <div class="stat-icon bg-danger-subtle text-danger">
                                <i class="fa-solid fa-box-archive"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="content-card">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <div>
                        <h4 class="mb-1 fw-bold">Pilotage éditorial</h4>
                        <p class="text-muted mb-0">Gère les publications, les brouillons, les archives et la visibilité des contenus.</p>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('back.articles.tous') }}" class="btn btn-outline-dark rounded-pill px-4">
                            <i class="fa-solid fa-table-list me-2"></i>Tous
                        </a>
                        <a href="{{ route('back.articles.publies') }}" class="btn btn-outline-success rounded-pill px-4">
                            <i class="fa-solid fa-circle-check me-2"></i>Publiés
                        </a>
                        <a href="{{ route('back.articles.brouillons') }}" class="btn btn-outline-warning rounded-pill px-4">
                            <i class="fa-solid fa-pen-to-square me-2"></i>Brouillons
                        </a>
                        <a href="{{ route('back.articles.archives') }}" class="btn btn-outline-danger rounded-pill px-4">
                            <i class="fa-solid fa-box-archive me-2"></i>Archivés
                        </a>
                        <a href="{{ route('back.articles.creer') }}" class="btn btn-primary rounded-pill px-4">
                            <i class="fa-solid fa-plus me-2"></i>Nouvel article
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="content-card">
                <div class="table-head-custom mb-4">
                    <div>
                        <h5 class="mb-1 fw-bold">Liste des articles</h5>
                        <p class="text-muted mb-0">Vue globale des contenus éditoriaux de la plateforme.</p>
                    </div>

                    <div class="table-tools">
                        <input type="text" class="form-control search-field" placeholder="Rechercher un article...">
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle custom-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Article</th>
                                <th>Catégorie</th>
                                <th>Auteur</th>
                                <th>Statut</th>
                                <th>Commentaires</th>
                                <th>Mise en avant</th>
                                <th>Vues</th>
                                <th>Publication</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($articles as $article)
                                <tr>
                                    <td>{{ $article->id }}</td>

                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="article-thumb">
                                                @if($article->image_principale)
                                                    <img src="{{ asset('storage/' . $article->image_principale) }}" alt="{{ $article->titre }}">
                                                @else
                                                    <div class="article-thumb-placeholder">
                                                        <i class="fa-solid fa-image"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <div class="fw-bold">{{ $article->titre }}</div>
                                                <div class="text-muted small text-truncate article-resume-cell">
                                                    {{ $article->resume ?: 'Aucun résumé.' }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        @if($article->categorie)
                                            <span class="badge text-bg-light border">{{ $article->categorie->nom }}</span>
                                        @else
                                            <span class="text-muted">Non classé</span>
                                        @endif
                                    </td>

                                    <td>
                                        <span class="fw-semibold">{{ $article->auteur->name ?? 'Inconnu' }}</span>
                                    </td>

                                    <td>
                                        @if($article->statut === 'publie')
                                            <span class="badge rounded-pill text-bg-success">Publié</span>
                                        @elseif($article->statut === 'brouillon')
                                            <span class="badge rounded-pill text-bg-warning">Brouillon</span>
                                        @else
                                            <span class="badge rounded-pill text-bg-danger">Archivé</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if($article->commentaires_actives)
                                            <span class="badge rounded-pill text-bg-info">Activés</span>
                                        @else
                                            <span class="badge rounded-pill text-bg-secondary">Désactivés</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if($article->est_mis_en_avant)
                                            <span class="badge rounded-pill text-bg-primary">En avant</span>
                                        @else
                                            <span class="badge rounded-pill text-bg-light border">Normal</span>
                                        @endif
                                    </td>

                                    <td>
                                        <span class="badge rounded-pill text-bg-dark">{{ $article->nombre_vues }}</span>
                                    </td>

                                    <td>
                                        {{ $article->date_publication ? $article->date_publication->format('d/m/Y') : 'Non publiée' }}
                                    </td>

                                    <td class="text-end">
                                        <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
                                            <a href="{{ route('back.articles.details', $article) }}" class="btn btn-sm btn-light rounded-pill px-3">
                                                <i class="fa-solid fa-eye me-1"></i>Voir
                                            </a>

                                            <a href="{{ route('back.articles.modifier', $article) }}" class="btn btn-sm btn-warning rounded-pill px-3">
                                                <i class="fa-solid fa-pen me-1"></i>Modifier
                                            </a>

                                            @if($article->statut !== 'publie')
                                                <form method="POST" action="{{ route('back.articles.publier', $article) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-outline-success rounded-pill px-3">
                                                        <i class="fa-solid fa-upload me-1"></i>Publier
                                                    </button>
                                                </form>
                                            @endif

                                            @if($article->statut !== 'brouillon')
                                                <form method="POST" action="{{ route('back.articles.mettre_en_brouillon', $article) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-outline-warning rounded-pill px-3">
                                                        <i class="fa-solid fa-file-pen me-1"></i>Brouillon
                                                    </button>
                                                </form>
                                            @endif

                                            @if($article->statut !== 'archive')
                                                <form method="POST" action="{{ route('back.articles.archiver', $article) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                                        <i class="fa-solid fa-box-archive me-1"></i>Archiver
                                                    </button>
                                                </form>
                                            @endif

                                            @if(!$article->est_mis_en_avant)
                                                <form method="POST" action="{{ route('back.articles.mettre_en_avant', $article) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                                        <i class="fa-solid fa-star me-1"></i>Mettre en avant
                                                    </button>
                                                </form>
                                            @else
                                                <form method="POST" action="{{ route('back.articles.retirer_mise_en_avant', $article) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                                                        <i class="fa-regular fa-star me-1"></i>Retirer
                                                    </button>
                                                </form>
                                            @endif

                                            @if($article->commentaires_actives)
                                                <form method="POST" action="{{ route('back.articles.desactiver_commentaires', $article) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                                                        <i class="fa-solid fa-comment-slash me-1"></i>Couper commentaires
                                                    </button>
                                                </form>
                                            @else
                                                <form method="POST" action="{{ route('back.articles.activer_commentaires', $article) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-outline-info rounded-pill px-3">
                                                        <i class="fa-solid fa-comments me-1"></i>Activer commentaires
                                                    </button>
                                                </form>
                                            @endif

                                            <button type="button"
                                                    class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalSuppressionArticle{{ $article->id }}">
                                                <i class="fa-solid fa-trash me-1"></i>Supprimer
                                            </button>
                                        </div>

                                        @include('back.contenus.articles._modales', ['article' => $article])
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center py-5">
                                        <div class="empty-state">
                                            <i class="fa-solid fa-newspaper empty-state-icon"></i>
                                            <h5 class="mt-3">Aucun article trouvé</h5>
                                            <p class="text-muted">Commence par créer ton premier contenu éditorial.</p>
                                            <a href="{{ route('back.articles.creer') }}" class="btn btn-primary rounded-pill px-4">
                                                <i class="fa-solid fa-plus me-2"></i>Créer un article
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $articles->links() }}
                </div>
            </div>
        </div>
    </div>

    <style>
        .mini-label{font-size:13px;color:#64748b;font-weight:700;margin-bottom:8px}
        .stat-number{font-size:32px;font-weight:800;margin:0}
        .stat-icon{width:58px;height:58px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:22px}
        .table-head-custom{display:flex;justify-content:space-between;align-items:center;gap:16px;flex-wrap:wrap}
        .table-tools{min-width:280px}
        .search-field{height:48px;border-radius:16px}
        .custom-table thead th{font-size:13px;text-transform:uppercase;letter-spacing:.5px;color:#64748b;border-bottom:1px solid #e5e7eb}
        .custom-table tbody td{border-bottom:1px solid #f1f5f9}
        .article-thumb{width:56px;height:56px;border-radius:16px;overflow:hidden;flex-shrink:0;background:#f8fafc;border:1px solid #e5e7eb}
        .article-thumb img{width:100%;height:100%;object-fit:cover}
        .article-thumb-placeholder{width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:#94a3b8}
        .article-resume-cell{max-width:240px}
        .empty-state{padding:20px}
        .empty-state-icon{font-size:42px;color:#94a3b8}
    </style>
@endsection