@extends('back.layouts.principal')

@section('title', 'Utilisateurs')
@section('page_title', 'Gestion des utilisateurs')
@section('page_subtitle', 'Pilotage des administrateurs, auteurs, responsables et comptes du hub.')

@section('content')
    <div class="row g-4">

        <div class="col-12">
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="content-card h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="mini-label">Total utilisateurs</div>
                                <h3 class="stat-number">{{ $utilisateurs->total() }}</h3>
                            </div>
                            <div class="stat-icon bg-primary-subtle text-primary">
                                <i class="fa-solid fa-users"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="content-card h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="mini-label">Comptes actifs</div>
                                <h3 class="stat-number">{{ $utilisateurs->where('est_actif', true)->count() }}</h3>
                            </div>
                            <div class="stat-icon bg-success-subtle text-success">
                                <i class="fa-solid fa-user-check"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="content-card h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="mini-label">Comptes inactifs</div>
                                <h3 class="stat-number">{{ $utilisateurs->where('est_actif', false)->count() }}</h3>
                            </div>
                            <div class="stat-icon bg-warning-subtle text-warning">
                                <i class="fa-solid fa-user-clock"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="content-card h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="mini-label">Suspendus</div>
                                <h3 class="stat-number">{{ $utilisateurs->where('statut_compte', 'suspendu')->count() }}</h3>
                            </div>
                            <div class="stat-icon bg-danger-subtle text-danger">
                                <i class="fa-solid fa-user-lock"></i>
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
                        <h4 class="mb-1 fw-bold">Centre utilisateurs</h4>
                        <p class="text-muted mb-0">Gère les comptes, les accès, les rôles et la disponibilité des membres du hub.</p>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('back.utilisateurs.tous') }}" class="btn btn-outline-dark rounded-pill px-4">
                            <i class="fa-solid fa-table-list me-2"></i>Tous
                        </a>
                        <a href="{{ route('back.utilisateurs.administrateurs') }}" class="btn btn-outline-primary rounded-pill px-4">
                            <i class="fa-solid fa-user-shield me-2"></i>Administrateurs
                        </a>
                        <a href="{{ route('back.utilisateurs.auteurs') }}" class="btn btn-outline-info rounded-pill px-4">
                            <i class="fa-solid fa-pen-nib me-2"></i>Auteurs
                        </a>
                        <a href="{{ route('back.utilisateurs.responsables') }}" class="btn btn-outline-warning rounded-pill px-4">
                            <i class="fa-solid fa-user-tie me-2"></i>Responsables
                        </a>
                        <a href="{{ route('back.utilisateurs.desactives') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            <i class="fa-solid fa-user-slash me-2"></i>Désactivés
                        </a>
                        <a href="{{ route('back.utilisateurs.creer') }}" class="btn btn-primary rounded-pill px-4">
                            <i class="fa-solid fa-plus me-2"></i>Ajouter un utilisateur
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="content-card">
                <div class="table-head-custom mb-4">
                    <div>
                        <h5 class="mb-1 fw-bold">Liste des utilisateurs</h5>
                        <p class="text-muted mb-0">Vue globale des comptes présents dans le système.</p>
                    </div>

                    <div class="table-tools">
                        <input type="text" class="form-control search-field" placeholder="Rechercher un utilisateur...">
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle custom-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Utilisateur</th>
                                <th>Rôles</th>
                                <th>Statut</th>
                                <th>Compte</th>
                                <th>Dernier accès</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($utilisateurs as $utilisateur)
                                <tr>
                                    <td>{{ $utilisateur->id }}</td>

                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="user-avatar-box">
                                                @if($utilisateur->photo)
                                                    <img src="{{ asset('storage/' . $utilisateur->photo) }}" alt="{{ $utilisateur->name }}">
                                                @else
                                                    <div class="user-avatar-placeholder">
                                                        {{ strtoupper(substr($utilisateur->name, 0, 1)) }}
                                                    </div>
                                                @endif
                                            </div>

                                            <div>
                                                <div class="fw-bold">{{ $utilisateur->name }}</div>
                                                <div class="text-muted small">{{ $utilisateur->email }}</div>
                                                @if($utilisateur->telephone)
                                                    <div class="text-muted small">{{ $utilisateur->telephone }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="d-flex flex-wrap gap-1">
                                            @forelse($utilisateur->roles as $role)
                                                <span class="badge rounded-pill text-bg-light border">{{ $role->nom }}</span>
                                            @empty
                                                <span class="text-muted">Aucun rôle</span>
                                            @endforelse
                                        </div>
                                    </td>

                                    <td>
                                        @if($utilisateur->statut_compte === 'actif')
                                            <span class="badge rounded-pill text-bg-success">Actif</span>
                                        @elseif($utilisateur->statut_compte === 'inactif')
                                            <span class="badge rounded-pill text-bg-warning">Inactif</span>
                                        @else
                                            <span class="badge rounded-pill text-bg-danger">Suspendu</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if($utilisateur->est_actif)
                                            <span class="badge rounded-pill text-bg-primary">Disponible</span>
                                        @else
                                            <span class="badge rounded-pill text-bg-secondary">Désactivé</span>
                                        @endif
                                    </td>

                                    <td>
                                        {{ $utilisateur->dernier_acces ? $utilisateur->dernier_acces->format('d/m/Y H:i') : 'Jamais' }}
                                    </td>

                                    <td class="text-end">
                                        <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
                                            <a href="{{ route('back.utilisateurs.details', $utilisateur) }}" class="btn btn-sm btn-light rounded-pill px-3">
                                                <i class="fa-solid fa-eye me-1"></i>Voir
                                            </a>

                                            <a href="{{ route('back.utilisateurs.modifier', $utilisateur) }}" class="btn btn-sm btn-warning rounded-pill px-3">
                                                <i class="fa-solid fa-pen me-1"></i>Modifier
                                            </a>

                                            <a href="{{ route('back.attributions.utilisateur.roles', $utilisateur) }}" class="btn btn-sm btn-outline-dark rounded-pill px-3">
                                                <i class="fa-solid fa-user-gear me-1"></i>Rôles
                                            </a>

                                            @if(!$utilisateur->est_actif)
                                                <form method="POST" action="{{ route('back.utilisateurs.activer', $utilisateur) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-outline-success rounded-pill px-3">
                                                        <i class="fa-solid fa-check me-1"></i>Activer
                                                    </button>
                                                </form>
                                            @else
                                                <form method="POST" action="{{ route('back.utilisateurs.desactiver', $utilisateur) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                                                        <i class="fa-solid fa-ban me-1"></i>Désactiver
                                                    </button>
                                                </form>
                                            @endif

                                            @if($utilisateur->statut_compte !== 'suspendu')
                                                <form method="POST" action="{{ route('back.utilisateurs.suspendre', $utilisateur) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                                        <i class="fa-solid fa-user-lock me-1"></i>Suspendre
                                                    </button>
                                                </form>
                                            @else
                                                <form method="POST" action="{{ route('back.utilisateurs.retablir', $utilisateur) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-outline-success rounded-pill px-3">
                                                        <i class="fa-solid fa-rotate-left me-1"></i>Rétablir
                                                    </button>
                                                </form>
                                            @endif

                                            <button type="button"
                                                    class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalSuppressionUtilisateur{{ $utilisateur->id }}">
                                                <i class="fa-solid fa-trash me-1"></i>Supprimer
                                            </button>
                                        </div>

                                        @include('back.utilisateurs.utilisateurs._modales', ['utilisateur' => $utilisateur])
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <div class="empty-state">
                                            <i class="fa-solid fa-users empty-state-icon"></i>
                                            <h5 class="mt-3">Aucun utilisateur trouvé</h5>
                                            <p class="text-muted">Commence par créer ton premier utilisateur.</p>
                                            <a href="{{ route('back.utilisateurs.creer') }}" class="btn btn-primary rounded-pill px-4">
                                                <i class="fa-solid fa-plus me-2"></i>Créer un utilisateur
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $utilisateurs->links() }}
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
        .user-avatar-box{width:54px;height:54px;border-radius:16px;overflow:hidden;flex-shrink:0;border:1px solid #e5e7eb;background:#f8fafc}
        .user-avatar-box img{width:100%;height:100%;object-fit:cover}
        .user-avatar-placeholder{width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-weight:800;color:#475569;background:#eef2ff}
        .empty-state{padding:20px}
        .empty-state-icon{font-size:42px;color:#94a3b8}
    </style>
@endsection
