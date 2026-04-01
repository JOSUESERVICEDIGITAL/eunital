@extends('back.layouts.principal')

@section('title', 'Rôles')
@section('page_title', 'Gestion des rôles')
@section('page_subtitle', 'Supervision des profils d’accès, responsabilités et capacités du hub.')

@section('content')
    <div class="row g-4">

        <div class="col-12">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="content-card h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="mini-label">Total rôles</div>
                                <h3 class="stat-number">{{ $roles->total() }}</h3>
                            </div>
                            <div class="stat-icon bg-primary-subtle text-primary">
                                <i class="fa-solid fa-user-shield"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="content-card h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="mini-label">Rôles actifs</div>
                                <h3 class="stat-number">{{ $roles->where('est_actif', true)->count() }}</h3>
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
                                <div class="mini-label">Rôles inactifs</div>
                                <h3 class="stat-number">{{ $roles->where('est_actif', false)->count() }}</h3>
                            </div>
                            <div class="stat-icon bg-danger-subtle text-danger">
                                <i class="fa-solid fa-circle-pause"></i>
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
                        <h4 class="mb-1 fw-bold">Architecture des rôles</h4>
                        <p class="text-muted mb-0">Définis les responsabilités, accès et hiérarchies fonctionnelles du hub.</p>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('back.roles.tous') }}" class="btn btn-outline-dark rounded-pill px-4">Tous</a>
                        <a href="{{ route('back.roles.actifs') }}" class="btn btn-outline-success rounded-pill px-4">Actifs</a>
                        <a href="{{ route('back.roles.inactifs') }}" class="btn btn-outline-secondary rounded-pill px-4">Inactifs</a>
                        <a href="{{ route('back.roles.creer') }}" class="btn btn-primary rounded-pill px-4">
                            <i class="fa-solid fa-plus me-2"></i>Créer un rôle
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="content-card">
                <div class="table-head-custom mb-4">
                    <div>
                        <h5 class="mb-1 fw-bold">Liste des rôles</h5>
                        <p class="text-muted mb-0">Vue globale des rôles et de leurs liaisons.</p>
                    </div>

                    <div class="table-tools">
                        <input type="text" class="form-control search-field" placeholder="Rechercher un rôle...">
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle custom-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Rôle</th>
                                <th>Utilisateurs</th>
                                <th>Permissions</th>
                                <th>Statut</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($roles as $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="role-avatar bg-primary-subtle text-primary">
                                                <i class="fa-solid fa-shield-halved"></i>
                                            </div>
                                            <div>
                                                <div class="fw-bold">{{ $role->nom }}</div>
                                                <div class="text-muted small">{{ $role->slug }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill text-bg-dark">{{ $role->utilisateurs_count }}</span>
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill text-bg-info">{{ $role->permissions_count }}</span>
                                    </td>
                                    <td>
                                        @if($role->est_actif)
                                            <span class="badge rounded-pill text-bg-success">Actif</span>
                                        @else
                                            <span class="badge rounded-pill text-bg-danger">Inactif</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
                                            <a href="{{ route('back.roles.details', $role) }}" class="btn btn-sm btn-light rounded-pill px-3">Voir</a>
                                            <a href="{{ route('back.roles.modifier', $role) }}" class="btn btn-sm btn-warning rounded-pill px-3">Modifier</a>
                                            <a href="{{ route('back.attributions.role.permissions', $role) }}" class="btn btn-sm btn-outline-dark rounded-pill px-3">Permissions</a>

                                            @if($role->est_actif)
                                                <form method="POST" action="{{ route('back.roles.desactiver', $role) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-outline-secondary rounded-pill px-3">Désactiver</button>
                                                </form>
                                            @else
                                                <form method="POST" action="{{ route('back.roles.activer', $role) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-outline-success rounded-pill px-3">Activer</button>
                                                </form>
                                            @endif

                                            <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                                data-bs-toggle="modal" data-bs-target="#modalSuppressionRole{{ $role->id }}">
                                                Supprimer
                                            </button>
                                        </div>

                                        @include('back.utilisateurs.roles._modales', ['role' => $role])
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">Aucun rôle trouvé.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $roles->links() }}
                </div>
            </div>
        </div>
    </div>

    <style>
        .mini-label{font-size:13px;color:#64748b;font-weight:700;margin-bottom:8px}
        .stat-number{font-size:32px;font-weight:800;margin:0}
        .stat-icon,.role-avatar{width:58px;height:58px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:22px}
        .table-head-custom{display:flex;justify-content:space-between;align-items:center;gap:16px;flex-wrap:wrap}
        .table-tools{min-width:280px}.search-field{height:48px;border-radius:16px}
        .custom-table thead th{font-size:13px;text-transform:uppercase;letter-spacing:.5px;color:#64748b;border-bottom:1px solid #e5e7eb}
        .custom-table tbody td{border-bottom:1px solid #f1f5f9}
    </style>
@endsection
