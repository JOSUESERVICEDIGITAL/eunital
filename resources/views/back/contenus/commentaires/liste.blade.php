@extends('back.layouts.principal')

@section('title', 'Commentaires')
@section('page_title', 'Chambre des commentaires')
@section('page_subtitle', 'Modération, validation, rejet et suivi des commentaires publiés sur les contenus.')

@section('content')
    <div class="row g-4">

        <div class="col-12">
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="content-card h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="mini-label">Total commentaires</div>
                                <h3 class="stat-number">{{ $commentaires->total() }}</h3>
                            </div>
                            <div class="stat-icon bg-info-subtle text-info">
                                <i class="fa-solid fa-comments"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="content-card h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="mini-label">En attente</div>
                                <h3 class="stat-number">{{ $commentaires->where('statut', 'en_attente')->count() }}</h3>
                            </div>
                            <div class="stat-icon bg-warning-subtle text-warning">
                                <i class="fa-solid fa-hourglass-half"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="content-card h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="mini-label">Validés</div>
                                <h3 class="stat-number">{{ $commentaires->where('statut', 'valide')->count() }}</h3>
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
                                <div class="mini-label">Rejetés</div>
                                <h3 class="stat-number">{{ $commentaires->where('statut', 'rejete')->count() }}</h3>
                            </div>
                            <div class="stat-icon bg-danger-subtle text-danger">
                                <i class="fa-solid fa-circle-xmark"></i>
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
                        <h4 class="mb-1 fw-bold">Centre de modération</h4>
                        <p class="text-muted mb-0">Contrôle la qualité, l’approbation et la visibilité des réactions publiées.</p>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('back.commentaires.tous') }}" class="btn btn-outline-dark rounded-pill px-4">
                            <i class="fa-solid fa-table-list me-2"></i>Tous
                        </a>
                        <a href="{{ route('back.commentaires.en_attente') }}" class="btn btn-outline-warning rounded-pill px-4">
                            <i class="fa-solid fa-hourglass-half me-2"></i>En attente
                        </a>
                        <a href="{{ route('back.commentaires.valides') }}" class="btn btn-outline-success rounded-pill px-4">
                            <i class="fa-solid fa-circle-check me-2"></i>Validés
                        </a>
                        <a href="{{ route('back.commentaires.rejetes') }}" class="btn btn-outline-danger rounded-pill px-4">
                            <i class="fa-solid fa-circle-xmark me-2"></i>Rejetés
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="content-card">
                <div class="table-head-custom mb-4">
                    <div>
                        <h5 class="mb-1 fw-bold">Liste des commentaires</h5>
                        <p class="text-muted mb-0">Vue complète des avis, réponses et statuts de modération.</p>
                    </div>

                    <div class="table-tools">
                        <input type="text" class="form-control search-field" placeholder="Rechercher un commentaire...">
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle custom-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Auteur</th>
                                <th>Article</th>
                                <th>Contenu</th>
                                <th>Parent</th>
                                <th>Statut</th>
                                <th>Date</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($commentaires as $commentaire)
                                <tr>
                                    <td>{{ $commentaire->id }}</td>

                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="comment-avatar bg-info-subtle text-info">
                                                <i class="fa-solid fa-user"></i>
                                            </div>
                                            <div>
                                                <div class="fw-bold">{{ $commentaire->auteur->name ?? $commentaire->nom ?? 'Visiteur' }}</div>
                                                <div class="text-muted small">{{ $commentaire->email ?? 'Aucun email' }}</div>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="fw-semibold">{{ $commentaire->article->titre ?? 'Article introuvable' }}</div>
                                        <div class="text-muted small">#{{ $commentaire->article->id ?? '-' }}</div>
                                    </td>

                                    <td>
                                        <div class="comment-snippet">
                                            {{ \Illuminate\Support\Str::limit($commentaire->contenu, 90) }}
                                        </div>
                                    </td>

                                    <td>
                                        @if($commentaire->parent)
                                            <span class="badge rounded-pill text-bg-light border">Réponse</span>
                                        @else
                                            <span class="text-muted">Principal</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if($commentaire->statut === 'valide')
                                            <span class="badge rounded-pill text-bg-success">Validé</span>
                                        @elseif($commentaire->statut === 'rejete')
                                            <span class="badge rounded-pill text-bg-danger">Rejeté</span>
                                        @else
                                            <span class="badge rounded-pill text-bg-warning">En attente</span>
                                        @endif
                                    </td>

                                    <td>{{ $commentaire->created_at->format('d/m/Y H:i') }}</td>

                                    <td class="text-end">
                                        <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
                                            <a href="{{ route('back.commentaires.details', $commentaire) }}" class="btn btn-sm btn-light rounded-pill px-3">
                                                <i class="fa-solid fa-eye me-1"></i>Voir
                                            </a>

                                            @if($commentaire->statut !== 'valide')
                                                <form method="POST" action="{{ route('back.commentaires.valider', $commentaire) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-outline-success rounded-pill px-3">
                                                        <i class="fa-solid fa-check me-1"></i>Valider
                                                    </button>
                                                </form>
                                            @endif

                                            @if($commentaire->statut !== 'rejete')
                                                <form method="POST" action="{{ route('back.commentaires.rejeter', $commentaire) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                                        <i class="fa-solid fa-xmark me-1"></i>Rejeter
                                                    </button>
                                                </form>
                                            @endif

                                            @if($commentaire->statut !== 'en_attente')
                                                <form method="POST" action="{{ route('back.commentaires.remettre_en_attente', $commentaire) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-outline-warning rounded-pill px-3">
                                                        <i class="fa-solid fa-rotate-left me-1"></i>Remettre en attente
                                                    </button>
                                                </form>
                                            @endif

                                            <button type="button"
                                                    class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalSuppressionCommentaire{{ $commentaire->id }}">
                                                <i class="fa-solid fa-trash me-1"></i>Supprimer
                                            </button>
                                        </div>

                                        @include('back.contenus.commentaires._modales', ['commentaire' => $commentaire])
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5">
                                        <div class="empty-state">
                                            <i class="fa-solid fa-comments empty-state-icon"></i>
                                            <h5 class="mt-3">Aucun commentaire trouvé</h5>
                                            <p class="text-muted">Les retours des utilisateurs apparaîtront ici.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $commentaires->links() }}
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
        .comment-avatar{width:48px;height:48px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:18px}
        .comment-snippet{max-width:250px;color:#334155}
        .empty-state{padding:20px}
        .empty-state-icon{font-size:42px;color:#94a3b8}
    </style>
@endsection