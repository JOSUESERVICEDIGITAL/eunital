@extends('back.layouts.principal')

@section('title', 'Dossiers du personnel')
@section('page_title', 'Dossiers du personnel')
@section('page_subtitle', 'Vue d’ensemble des dossiers RH, filtres avancés, accès rapide aux fiches, historiques et actions du personnel.')

@section('content')
    @php
        $collection = $dossiers->getCollection();
        $totalActifs = $collection->where('statut_professionnel', 'en_poste')->count();
        $totalSuspendus = $collection->where('statut_professionnel', 'suspendu')->count();
        $totalArchives = $collection->where('statut_professionnel', 'archive')->count();
    @endphp

    <div class="row g-4">

        {{-- Statistiques --}}
        <div class="col-12">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="content-card h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="mini-label">Total dossiers</div>
                                <h3 class="stat-number">{{ $dossiers->total() }}</h3>
                            </div>
                            <div class="stat-icon bg-primary-subtle text-primary">
                                <i class="fa-solid fa-id-card"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="content-card h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="mini-label">En poste</div>
                                <h3 class="stat-number">{{ $totalActifs }}</h3>
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
                                <div class="mini-label">Suspendus / archivés</div>
                                <h3 class="stat-number">{{ $totalSuspendus + $totalArchives }}</h3>
                            </div>
                            <div class="stat-icon bg-warning-subtle text-warning">
                                <i class="fa-solid fa-user-clock"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Bandeau actions --}}
        <div class="col-12">
            <div class="content-card">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <div>
                        <h4 class="mb-1 fw-bold">Gestion des dossiers RH</h4>
                        <p class="text-muted mb-0">
                            Consulte, filtre, ouvre les fiches détaillées et navigue rapidement vers congés, présences, sanctions et évaluations.
                        </p>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('rh.dossiers-personnel.create') }}" class="btn btn-primary rounded-pill px-4">
                            <i class="fa-solid fa-plus me-2"></i>Nouveau dossier
                        </a>
                        <a href="{{ route('rh.dashboard') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            <i class="fa-solid fa-arrow-left me-2"></i>Dashboard RH
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Filtres --}}
        <div class="col-12">
            <div class="content-card">
                <form method="GET" action="{{ route('rh.dossiers-personnel.index') }}">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Recherche</label>
                            <input type="text" name="search" class="form-control custom-input"
                                   value="{{ $filters['search'] ?? '' }}"
                                   placeholder="Nom, prénom, matricule, CNSS, téléphone...">
                        </div>

                        <div class="col-md-2">
                            <label class="form-label fw-semibold">Département</label>
                            <select name="departement_id" class="form-select custom-input">
                                <option value="">Tous</option>
                                @foreach($departements as $departement)
                                    <option value="{{ $departement->id }}" @selected(($filters['departement_id'] ?? '') == $departement->id)>
                                        {{ $departement->nom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label class="form-label fw-semibold">Poste</label>
                            <select name="poste_id" class="form-select custom-input">
                                <option value="">Tous</option>
                                @foreach($postes as $poste)
                                    <option value="{{ $poste->id }}" @selected(($filters['poste_id'] ?? '') == $poste->id)>
                                        {{ $poste->nom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label class="form-label fw-semibold">Statut</label>
                            <select name="statut_professionnel" class="form-select custom-input">
                                <option value="">Tous</option>
                                <option value="en_poste" @selected(($filters['statut_professionnel'] ?? '') == 'en_poste')>En poste</option>
                                <option value="suspendu" @selected(($filters['statut_professionnel'] ?? '') == 'suspendu')>Suspendu</option>
                                <option value="demission" @selected(($filters['statut_professionnel'] ?? '') == 'demission')>Démission</option>
                                <option value="licencie" @selected(($filters['statut_professionnel'] ?? '') == 'licencie')>Licencié</option>
                                <option value="archive" @selected(($filters['statut_professionnel'] ?? '') == 'archive')>Archivé</option>
                            </select>
                        </div>

                        <div class="col-md-1">
                            <label class="form-label fw-semibold">Embauche du</label>
                            <input type="date" name="date_embauche_debut" class="form-control custom-input"
                                   value="{{ $filters['date_embauche_debut'] ?? '' }}">
                        </div>

                        <div class="col-md-1">
                            <label class="form-label fw-semibold">Au</label>
                            <input type="date" name="date_embauche_fin" class="form-control custom-input"
                                   value="{{ $filters['date_embauche_fin'] ?? '' }}">
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2 mt-4">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            <i class="fa-solid fa-magnifying-glass me-2"></i>Filtrer
                        </button>
                        <a href="{{ route('rh.dossiers-personnel.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            <i class="fa-solid fa-rotate-left me-2"></i>Réinitialiser
                        </a>
                    </div>
                </form>
            </div>
        </div>

        {{-- Tableau --}}
        <div class="col-12">
            <div class="content-card">
                <div class="table-head-custom mb-4">
                    <div>
                        <h5 class="mb-1 fw-bold">Liste des dossiers RH</h5>
                        <p class="text-muted mb-0">Navigation rapide vers les vues détaillées du personnel.</p>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle custom-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Employé</th>
                                <th>Matricule</th>
                                <th>Département</th>
                                <th>Poste</th>
                                <th>Date embauche</th>
                                <th>Statut</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dossiers as $dossier)
                                <tr>
                                    <td>{{ $dossier->id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="table-avatar bg-primary-subtle text-primary">
                                                <i class="fa-solid fa-user"></i>
                                            </div>
                                            <div>
                                                <div class="fw-bold">
                                                    {{ optional($dossier->membreEquipe)->nom }} {{ optional($dossier->membreEquipe)->prenom }}
                                                </div>
                                                <div class="text-muted small">
                                                    {{ optional($dossier->membreEquipe)->email_professionnel ?? 'Email non défini' }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge text-bg-light border">{{ $dossier->matricule }}</span>
                                    </td>
                                    <td>{{ optional(optional($dossier->membreEquipe)->departement)->nom ?? '—' }}</td>
                                    <td>{{ optional(optional($dossier->membreEquipe)->poste)->nom ?? '—' }}</td>
                                    <td>{{ $dossier->date_embauche?->format('d/m/Y') ?? '—' }}</td>
                                    <td>
                                        @php
                                            $statusClass = match($dossier->statut_professionnel) {
                                                'en_poste' => 'text-bg-success',
                                                'suspendu' => 'text-bg-warning',
                                                'demission' => 'text-bg-secondary',
                                                'licencie' => 'text-bg-danger',
                                                'archive' => 'text-bg-dark',
                                                default => 'text-bg-light'
                                            };
                                        @endphp
                                        <span class="badge rounded-pill {{ $statusClass }}">
                                            {{ ucfirst(str_replace('_', ' ', $dossier->statut_professionnel)) }}
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
                                            <a href="{{ route('rh.dossiers-personnel.show', $dossier) }}" class="btn btn-sm btn-light rounded-pill px-3">
                                                <i class="fa-solid fa-eye me-1"></i>Voir
                                            </a>
                                            <a href="{{ route('rh.dossiers-personnel.edit', $dossier) }}" class="btn btn-sm btn-warning rounded-pill px-3">
                                                <i class="fa-solid fa-pen me-1"></i>Modifier
                                            </a>

                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-outline-primary rounded-pill px-3 dropdown-toggle" data-bs-toggle="dropdown">
                                                    <i class="fa-solid fa-up-right-from-square me-1"></i>Ouvrir
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-4">
                                                    <li><a class="dropdown-item" href="{{ route('rh.dossiers-personnel.documents', $dossier) }}">Documents</a></li>
                                                    <li><a class="dropdown-item" href="{{ route('rh.dossiers-personnel.historique', $dossier) }}">Historique</a></li>
                                                    <li><a class="dropdown-item" href="{{ route('rh.dossiers-personnel.presences', $dossier) }}">Présences</a></li>
                                                    <li><a class="dropdown-item" href="{{ route('rh.dossiers-personnel.conges', $dossier) }}">Congés</a></li>
                                                    <li><a class="dropdown-item" href="{{ route('rh.dossiers-personnel.evaluations', $dossier) }}">Évaluations</a></li>
                                                    <li><a class="dropdown-item" href="{{ route('rh.dossiers-personnel.sanctions', $dossier) }}">Sanctions</a></li>
                                                    <li><a class="dropdown-item" href="{{ route('rh.dossiers-personnel.timeline', $dossier) }}">Timeline</a></li>
                                                </ul>
                                            </div>

                                            <button type="button"
                                                    class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteDossierModal{{ $dossier->id }}">
                                                <i class="fa-solid fa-trash me-1"></i>Supprimer
                                            </button>
                                        </div>

                                        <div class="modal fade" id="deleteDossierModal{{ $dossier->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content border-0 rounded-4">
                                                    <div class="modal-header border-0">
                                                        <h5 class="modal-title fw-bold">Supprimer le dossier</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Veux-tu vraiment supprimer le dossier de
                                                        <strong>{{ optional($dossier->membreEquipe)->nom }} {{ optional($dossier->membreEquipe)->prenom }}</strong> ?
                                                    </div>
                                                    <div class="modal-footer border-0">
                                                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Annuler</button>
                                                        <form method="POST" action="{{ route('rh.dossiers-personnel.destroy', $dossier) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger rounded-pill px-4">Supprimer</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5">
                                        <div class="empty-state">
                                            <i class="fa-solid fa-folder-open empty-state-icon"></i>
                                            <h5 class="mt-3">Aucun dossier trouvé</h5>
                                            <p class="text-muted">Crée un nouveau dossier du personnel pour commencer.</p>
                                            <a href="{{ route('rh.dossiers-personnel.create') }}" class="btn btn-primary rounded-pill px-4">
                                                <i class="fa-solid fa-plus me-2"></i>Nouveau dossier
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $dossiers->links() }}
                </div>
            </div>
        </div>

    </div>

    <style>
        .mini-label{font-size:13px;color:#64748b;font-weight:700;margin-bottom:8px}
        .stat-number{font-size:32px;font-weight:800;margin:0}
        .stat-icon{width:58px;height:58px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:22px}
        .custom-input{height:48px;border-radius:16px}
        .table-head-custom{display:flex;justify-content:space-between;align-items:center;gap:16px;flex-wrap:wrap}
        .n-table thead th{font-size:13px;text-transform:uppercase;letter-spacing:.5px;color:#64748b;border-bottom:1px solid #e5e7eb}
        .custom-table tbody td{border-bottom:1px solid #f1f5f9}
        .table-avatar{width:48px;height:48px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:18px}
        .empty-state{padding:20px}
        .empty-state-icon{font-size:42px;color:#94a3b8}
    </style>
@endsection
