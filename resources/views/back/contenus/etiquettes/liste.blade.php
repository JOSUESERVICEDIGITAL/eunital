@extends('back.layouts.principal')

@section('title', 'Étiquettes')
@section('page_title', 'Chambre des étiquettes')
@section('page_subtitle', 'Organisation, classification fine et enrichissement éditorial des contenus par mots-clés.')

@section('content')
    <div class="row g-4">

        <div class="col-12">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="content-card h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="mini-label">Total étiquettes</div>
                                <h3 class="stat-number">{{ $etiquettes->total() }}</h3>
                            </div>
                            <div class="stat-icon bg-info-subtle text-info">
                                <i class="fa-solid fa-tags"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="content-card h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="mini-label">Étiquettes utilisées</div>
                                <h3 class="stat-number">{{ $etiquettes->where('articles_count', '>', 0)->count() }}</h3>
                            </div>
                            <div class="stat-icon bg-success-subtle text-success">
                                <i class="fa-solid fa-link"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="content-card h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="mini-label">Sans article lié</div>
                                <h3 class="stat-number">{{ $etiquettes->where('articles_count', 0)->count() }}</h3>
                            </div>
                            <div class="stat-icon bg-warning-subtle text-warning">
                                <i class="fa-solid fa-unlink"></i>
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
                        <h4 class="mb-1 fw-bold">Gestion des mots-clés</h4>
                        <p class="text-muted mb-0">Crée et supervise les étiquettes utilisées pour classer les contenus plus finement.</p>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('back.etiquettes.toutes') }}" class="btn btn-outline-dark rounded-pill px-4">
                            <i class="fa-solid fa-table-list me-2"></i>Toutes les étiquettes
                        </a>
                        <a href="{{ route('back.etiquettes.creer') }}" class="btn btn-primary rounded-pill px-4">
                            <i class="fa-solid fa-plus me-2"></i>Nouvelle étiquette
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="content-card">
                <div class="table-head-custom mb-4">
                    <div>
                        <h5 class="mb-1 fw-bold">Liste des étiquettes</h5>
                        <p class="text-muted mb-0">Vue générale des mots-clés disponibles dans le système éditorial.</p>
                    </div>

                    <div class="table-tools">
                        <input type="text" class="form-control search-field" placeholder="Rechercher une étiquette...">
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle custom-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Étiquette</th>
                                <th>Slug</th>
                                <th>Articles liés</th>
                                <th>Date de création</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($etiquettes as $etiquette)
                                <tr>
                                    <td>{{ $etiquette->id }}</td>

                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="tag-avatar bg-info-subtle text-info">
                                                <i class="fa-solid fa-tag"></i>
                                            </div>
                                            <div>
                                                <div class="fw-bold">{{ $etiquette->nom }}</div>
                                                <div class="text-muted small">Mot-clé éditorial</div>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <span class="text-muted">{{ $etiquette->slug }}</span>
                                    </td>

                                    <td>
                                        <span class="badge rounded-pill text-bg-dark">
                                            {{ $etiquette->articles_count }}
                                        </span>
                                    </td>

                                    <td>{{ $etiquette->created_at->format('d/m/Y') }}</td>

                                    <td class="text-end">
                                        <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
                                            <a href="{{ route('back.etiquettes.details', $etiquette) }}" class="btn btn-sm btn-light rounded-pill px-3">
                                                <i class="fa-solid fa-eye me-1"></i>Voir
                                            </a>

                                            <a href="{{ route('back.etiquettes.modifier', $etiquette) }}" class="btn btn-sm btn-warning rounded-pill px-3">
                                                <i class="fa-solid fa-pen me-1"></i>Modifier
                                            </a>

                                            <button type="button"
                                                    class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalSuppressionEtiquette{{ $etiquette->id }}">
                                                <i class="fa-solid fa-trash me-1"></i>Supprimer
                                            </button>
                                        </div>

                                        @include('back.contenus.etiquettes._modales', ['etiquette' => $etiquette])
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <div class="empty-state">
                                            <i class="fa-solid fa-tags empty-state-icon"></i>
                                            <h5 class="mt-3">Aucune étiquette trouvée</h5>
                                            <p class="text-muted">Commence par créer ton premier mot-clé éditorial.</p>
                                            <a href="{{ route('back.etiquettes.creer') }}" class="btn btn-primary rounded-pill px-4">
                                                <i class="fa-solid fa-plus me-2"></i>Créer une étiquette
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $etiquettes->links() }}
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
        .tag-avatar{width:48px;height:48px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:18px}
        .empty-state{padding:20px}
        .empty-state-icon{font-size:42px;color:#94a3b8}
    </style>
@endsection