@extends('back.layouts.principal')

@section('title', 'Catégories')
@section('page_title', 'Chambre des catégories')
@section('page_subtitle', 'Organisation, hiérarchie, activation et gestion des catégories de contenus.')

@section('content')
    <div class="row g-4">

        {{-- Cartes statistiques --}}
        <div class="col-12">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="content-card h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="mini-label">Total catégories</div>
                                <h3 class="stat-number">{{ $categories->total() }}</h3>
                            </div>
                            <div class="stat-icon bg-info-subtle text-info">
                                <i class="fa-solid fa-layer-group"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="content-card h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="mini-label">Catégories actives</div>
                                <h3 class="stat-number">{{ $categories->where('est_active', true)->count() }}</h3>
                            </div>
                            <div class="stat-icon bg-success-subtle text-success">
                                <i class="fa-solid fa-circle-check"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="content-card h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="mini-label">Catégories inactives</div>
                                <h3 class="stat-number">{{ $categories->where('est_active', false)->count() }}</h3>
                            </div>
                            <div class="stat-icon bg-danger-subtle text-danger">
                                <i class="fa-solid fa-circle-pause"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- En-tête actions --}}
        <div class="col-12">
            <div class="content-card">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <div>
                        <h4 class="mb-1 fw-bold">Gestion complète des catégories</h4>
                        <p class="text-muted mb-0">Crée, classe, active, désactive et supervise la hiérarchie de tes catégories.</p>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('back.categories.actives') }}" class="btn btn-outline-success rounded-pill px-4">
                            <i class="fa-solid fa-circle-check me-2"></i>Actives
                        </a>
                        <a href="{{ route('back.categories.inactives') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            <i class="fa-solid fa-circle-pause me-2"></i>Inactives
                        </a>
                        <a href="{{ route('back.categories.creer') }}" class="btn btn-primary rounded-pill px-4">
                            <i class="fa-solid fa-plus me-2"></i>Nouvelle catégorie
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tableau principal --}}
        <div class="col-12">
            <div class="content-card">
                <div class="table-head-custom mb-4">
                    <div>
                        <h5 class="mb-1 fw-bold">Liste des catégories</h5>
                        <p class="text-muted mb-0">Vue d’ensemble des catégories disponibles dans le système.</p>
                    </div>

                    <div class="table-tools">
                        <input type="text" class="form-control search-field" placeholder="Rechercher une catégorie...">
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle custom-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Catégorie</th>
                                <th>Parent</th>
                                <th>Sous-catégories</th>
                                <th>Articles</th>
                                <th>Statut</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $categorie)
                                <tr>
                                    <td>{{ $categorie->id }}</td>

                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="table-avatar bg-info-subtle text-info">
                                                <i class="fa-solid fa-folder-tree"></i>
                                            </div>
                                            <div>
                                                <div class="fw-bold">{{ $categorie->nom }}</div>
                                                <div class="text-muted small">{{ $categorie->slug }}</div>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        @if($categorie->categorieParente)
                                            <span class="badge text-bg-light border">{{ $categorie->categorieParente->nom }}</span>
                                        @else
                                            <span class="text-muted">Aucune</span>
                                        @endif
                                    </td>

                                    <td>
                                        <span class="badge rounded-pill text-bg-info">
                                            {{ $categorie->sousCategories->count() }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="badge rounded-pill text-bg-dark">
                                            {{ $categorie->articles->count() }}
                                        </span>
                                    </td>

                                    <td>
                                        @if($categorie->est_active)
                                            <span class="badge rounded-pill text-bg-success">Active</span>
                                        @else
                                            <span class="badge rounded-pill text-bg-danger">Inactive</span>
                                        @endif
                                    </td>

                                    <td class="text-end">
                                        <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
                                            <a href="{{ route('back.categories.details', $categorie) }}" class="btn btn-sm btn-light rounded-pill px-3">
                                                <i class="fa-solid fa-eye me-1"></i>Voir
                                            </a>

                                            <a href="{{ route('back.categories.modifier', $categorie) }}" class="btn btn-sm btn-warning rounded-pill px-3">
                                                <i class="fa-solid fa-pen me-1"></i>Modifier
                                            </a>

                                            @if($categorie->est_active)
                                                <form method="POST" action="{{ route('back.categories.desactiver', $categorie) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                                                        <i class="fa-solid fa-ban me-1"></i>Désactiver
                                                    </button>
                                                </form>
                                            @else
                                                <form method="POST" action="{{ route('back.categories.activer', $categorie) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-outline-success rounded-pill px-3">
                                                        <i class="fa-solid fa-check me-1"></i>Activer
                                                    </button>
                                                </form>
                                            @endif

                                            <button type="button"
                                                    class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalSuppressionCategorie{{ $categorie->id }}">
                                                <i class="fa-solid fa-trash me-1"></i>Supprimer
                                            </button>
                                        </div>

                                        @include('back.contenus.categories._modales', ['categorie' => $categorie])
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <div class="empty-state">
                                            <i class="fa-solid fa-folder-open empty-state-icon"></i>
                                            <h5 class="mt-3">Aucune catégorie trouvée</h5>
                                            <p class="text-muted">Commence par créer ta première catégorie.</p>
                                            <a href="{{ route('back.categories.creer') }}" class="btn btn-primary rounded-pill px-4">
                                                <i class="fa-solid fa-plus me-2"></i>Créer une catégorie
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $categories->links() }}
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
        .table-avatar{width:48px;height:48px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:18px}
        .empty-state{padding:20px}
        .empty-state-icon{font-size:42px;color:#94a3b8}
    </style>
@endsection