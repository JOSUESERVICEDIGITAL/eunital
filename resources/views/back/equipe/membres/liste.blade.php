@extends('back.layouts.principal')

@section('title', 'Membres de l’équipe')
@section('page_title', 'Équipe')
@section('page_subtitle', 'Gestion des membres, de leur statut, de leur visibilité et de leur organisation interne.')

@section('content')
    <div class="row g-4">

        <div class="col-12">
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="content-card h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="mini-label">Total membres</div>
                                <h3 class="stat-number">{{ $membres->total() }}</h3>
                            </div>
                            <div class="stat-icon bg-warning-subtle text-warning">
                                <i class="fa-solid fa-user-group"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="content-card h-100">
                        <div>
                            <div class="mini-label">Actifs</div>
                            <h3 class="stat-number">{{ $membres->where('statut', 'actif')->count() }}</h3>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="content-card h-100">
                        <div>
                            <div class="mini-label">Inactifs</div>
                            <h3 class="stat-number">{{ $membres->where('statut', 'inactif')->count() }}</h3>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="content-card h-100">
                        <div>
                            <div class="mini-label">En pause</div>
                            <h3 class="stat-number">{{ $membres->where('statut', 'en_pause')->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="content-card">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <div>
                        <h4 class="mb-1 fw-bold">Centre équipe</h4>
                        <p class="text-muted mb-0">Pilote les membres, l’organigramme, les départements et les fonctions.</p>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('back.equipe.membres.tous') }}" class="btn btn-outline-dark rounded-pill px-4">Tous</a>
                        <a href="{{ route('back.equipe.membres.actifs') }}" class="btn btn-outline-success rounded-pill px-4">Actifs</a>
                        <a href="{{ route('back.equipe.membres.inactifs') }}" class="btn btn-outline-secondary rounded-pill px-4">Inactifs</a>
                        <a href="{{ route('back.equipe.membres.en_pause') }}" class="btn btn-outline-warning rounded-pill px-4">En pause</a>
                        <a href="{{ route('back.equipe.membres.organigramme') }}" class="btn btn-outline-info rounded-pill px-4">Organigramme</a>
                        <a href="{{ route('back.equipe.membres.creer') }}" class="btn btn-primary rounded-pill px-4">
                            <i class="fa-solid fa-plus me-2"></i>Ajouter un membre
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="content-card">
                <div class="table-head-custom mb-4">
                    <div>
                        <h5 class="mb-1 fw-bold">Liste des membres</h5>
                        <p class="text-muted mb-0">Vue globale des personnes composant l’équipe.</p>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle custom-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Membre</th>
                                <th>Département</th>
                                <th>Poste</th>
                                <th>Responsable</th>
                                <th>Statut</th>
                                <th>Organigramme</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($membres as $membre)
                                <tr>
                                    <td>{{ $membre->id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="member-avatar-box">
                                                @if($membre->photo)
                                                    <img src="{{ asset('storage/' . $membre->photo) }}" alt="{{ $membre->nom }}">
                                                @else
                                                    <div class="member-avatar-placeholder">
                                                        {{ strtoupper(substr($membre->nom, 0, 1)) }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <div class="fw-bold">{{ $membre->nom }} {{ $membre->prenom }}</div>
                                                <div class="text-muted small">{{ $membre->email_professionnel ?: 'Aucun email' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $membre->departement->nom ?? 'Non défini' }}</td>
                                    <td>{{ $membre->poste->nom ?? 'Non défini' }}</td>
                                    <td>{{ $membre->responsable ? $membre->responsable->nom . ' ' . $membre->responsable->prenom : 'Aucun' }}</td>
                                    <td>
                                        @if($membre->statut === 'actif')
                                            <span class="badge rounded-pill text-bg-success">Actif</span>
                                        @elseif($membre->statut === 'inactif')
                                            <span class="badge rounded-pill text-bg-secondary">Inactif</span>
                                        @else
                                            <span class="badge rounded-pill text-bg-warning">En pause</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($membre->est_visible_organigramme)
                                            <span class="badge rounded-pill text-bg-primary">Visible</span>
                                        @else
                                            <span class="badge rounded-pill text-bg-dark">Masqué</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
                                            <a href="{{ route('back.equipe.membres.details', $membre) }}" class="btn btn-sm btn-light rounded-pill px-3">Voir</a>
                                            <a href="{{ route('back.equipe.membres.modifier', $membre) }}" class="btn btn-sm btn-warning rounded-pill px-3">Modifier</a>

                                            @if($membre->statut !== 'actif')
                                                <form method="POST" action="{{ route('back.equipe.membres.activer', $membre) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-outline-success rounded-pill px-3">Activer</button>
                                                </form>
                                            @endif

                                            @if($membre->statut !== 'inactif')
                                                <form method="POST" action="{{ route('back.equipe.membres.desactiver', $membre) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-outline-secondary rounded-pill px-3">Désactiver</button>
                                                </form>
                                            @endif

                                            @if($membre->statut !== 'en_pause')
                                                <form method="POST" action="{{ route('back.equipe.membres.mettre_en_pause', $membre) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-outline-warning rounded-pill px-3">Pause</button>
                                                </form>
                                            @endif

                                            <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalSuppressionMembre{{ $membre->id }}">
                                                Supprimer
                                            </button>
                                        </div>

                                        @include('back.equipe.membres._modales', ['membre' => $membre])
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5 text-muted">Aucun membre trouvé.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $membres->links() }}
                </div>
            </div>
        </div>
    </div>

    <style>
        .mini-label{font-size:13px;color:#64748b;font-weight:700;margin-bottom:8px}
        .stat-number{font-size:32px;font-weight:800;margin:0}
        .stat-icon{width:58px;height:58px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:22px}
        .table-head-custom{display:flex;justify-content:space-between;align-items:center;gap:16px;flex-wrap:wrap}
        .custom-table thead th{font-size:13px;text-transform:uppercase;letter-spacing:.5px;color:#64748b;border-bottom:1px solid #e5e7eb}
        .custom-table tbody td{border-bottom:1px solid #f1f5f9}
        .member-avatar-box{width:54px;height:54px;border-radius:16px;overflow:hidden;flex-shrink:0;border:1px solid #e5e7eb;background:#f8fafc}
        .member-avatar-box img{width:100%;height:100%;object-fit:cover}
        .member-avatar-placeholder{width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-weight:800;color:#475569;background:#fef3c7}
    </style>
@endsection