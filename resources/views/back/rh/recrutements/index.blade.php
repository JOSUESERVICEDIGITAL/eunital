@extends('back.layouts.principal')

@section('title', 'Recrutements')
@section('page_title', 'Recrutements')
@section('page_subtitle', 'Gestion complète des campagnes de recrutement, suivi des responsables, pipeline candidat et supervision des postes à pourvoir.')

@section('content')
    @php
        $collection = $recrutements->getCollection();
        $totalOuverts = $collection->where('statut', 'ouvert')->count();
        $totalEnCours = $collection->where('statut', 'en_cours')->count();
        $totalArchives = $collection->where('statut', 'archive')->count();
    @endphp

    <div class="row g-4">

        <div class="col-12">
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="content-card h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="mini-label">Total recrutements</div>
                                <h3 class="stat-number">{{ $recrutements->total() }}</h3>
                            </div>
                            <div class="stat-icon bg-primary-subtle text-primary">
                                <i class="fa-solid fa-briefcase"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="content-card h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="mini-label">Ouverts</div>
                                <h3 class="stat-number">{{ $totalOuverts }}</h3>
                            </div>
                            <div class="stat-icon bg-success-subtle text-success">
                                <i class="fa-solid fa-door-open"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="content-card h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="mini-label">En cours</div>
                                <h3 class="stat-number">{{ $totalEnCours }}</h3>
                            </div>
                            <div class="stat-icon bg-info-subtle text-info">
                                <i class="fa-solid fa-spinner"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="content-card h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="mini-label">Archivés</div>
                                <h3 class="stat-number">{{ $totalArchives }}</h3>
                            </div>
                            <div class="stat-icon bg-secondary-subtle text-secondary">
                                <i class="fa-solid fa-box-archive"></i>
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
                        <h4 class="mb-1 fw-bold">Gestion des recrutements</h4>
                        <p class="text-muted mb-0">
                            Supervise les campagnes, les postes, les responsables et le pipeline candidat depuis une seule vue.
                        </p>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('rh.recrutements.ouvertes') }}" class="btn btn-outline-success rounded-pill px-4">
                            <i class="fa-solid fa-door-open me-2"></i>Ouverts
                        </a>
                        <a href="{{ route('rh.recrutements.archivees') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            <i class="fa-solid fa-box-archive me-2"></i>Archives
                        </a>
                        <a href="{{ route('rh.recrutements.create') }}" class="btn btn-primary rounded-pill px-4">
                            <i class="fa-solid fa-plus me-2"></i>Nouveau recrutement
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Filtres --}}
        <div class="col-12">
            <div class="content-card">
                <form method="GET" action="{{ route('rh.recrutements.index') }}">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Recherche</label>
                            <input type="text" name="search" class="form-control custom-input"
                                   value="{{ $filters['search'] ?? '' }}"
                                   placeholder="Titre, slug, description, responsable...">
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
                            <label class="form-label fw-semibold">Responsable</label>
                            <select name="responsable_id" class="form-select custom-input">
                                <option value="">Tous</option>
                                @foreach($responsables as $responsable)
                                    <option value="{{ $responsable->id }}" @selected(($filters['responsable_id'] ?? '') == $responsable->id)>
                                        {{ $responsable->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-1">
                            <label class="form-label fw-semibold">Contrat</label>
                            <select name="type_contrat" class="form-select custom-input">
                                <option value="">Tous</option>
                                @foreach($typesContrat as $key => $label)
                                    <option value="{{ $key }}" @selected(($filters['type_contrat'] ?? '') == $key)>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-1">
                            <label class="form-label fw-semibold">Statut</label>
                            <select name="statut" class="form-select custom-input">
                                <option value="">Tous</option>
                                @foreach($statuts as $key => $label)
                                    <option value="{{ $key }}" @selected(($filters['statut'] ?? '') == $key)>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-1">
                            <label class="form-label fw-semibold">Du</label>
                            <input type="date" name="date_ouverture_debut" class="form-control custom-input"
                                   value="{{ $filters['date_ouverture_debut'] ?? '' }}">
                        </div>
                    </div>

                    <div class="row g-3 mt-0">
                        <div class="col-md-2">
                            <label class="form-label fw-semibold">Au</label>
                            <input type="date" name="date_ouverture_fin" class="form-control custom-input"
                                   value="{{ $filters['date_ouverture_fin'] ?? '' }}">
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2 mt-4">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            <i class="fa-solid fa-magnifying-glass me-2"></i>Filtrer
                        </button>
                        <a href="{{ route('rh.recrutements.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
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
                        <h5 class="mb-1 fw-bold">Liste des recrutements</h5>
                        <p class="text-muted mb-0">Vue d’ensemble des postes à pourvoir et de leur état d’avancement.</p>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle custom-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Recrutement</th>
                                <th>Département</th>
                                <th>Poste</th>
                                <th>Responsable</th>
                                <th>Contrat</th>
                                <th>Candidatures</th>
                                <th>Statut</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recrutements as $recrutement)
                                <tr>
                                    <td>{{ $recrutement->id }}</td>

                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="table-avatar bg-info-subtle text-info">
                                                <i class="fa-solid fa-user-group"></i>
                                            </div>
                                            <div>
                                                <div class="fw-bold">{{ $recrutement->titre }}</div>
                                                <div class="text-muted small">{{ $recrutement->slug }}</div>
                                            </div>
                                        </div>
                                    </td>

                                    <td>{{ optional($recrutement->departement)->nom ?? '—' }}</td>
                                    <td>{{ optional($recrutement->poste)->nom ?? '—' }}</td>
                                    <td>{{ optional($recrutement->responsable)->name ?? '—' }}</td>
                                    <td>
                                        <span class="badge rounded-pill text-bg-light border">
                                            {{ $typesContrat[$recrutement->type_contrat] ?? ucfirst($recrutement->type_contrat) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill text-bg-dark">
                                            {{ $recrutement->candidatures_count ?? 0 }}
                                        </span>
                                    </td>
                                    <td>
                                        @php
                                            $statusClass = match($recrutement->statut) {
                                                'brouillon' => 'text-bg-secondary',
                                                'ouvert' => 'text-bg-success',
                                                'en_cours' => 'text-bg-info',
                                                'ferme' => 'text-bg-warning',
                                                'archive' => 'text-bg-dark',
                                                default => 'text-bg-light'
                                            };
                                        @endphp
                                        <span class="badge rounded-pill {{ $statusClass }}">
                                            {{ ucfirst(str_replace('_', ' ', $recrutement->statut)) }}
                                        </span>
                                    </td>

                                    <td class="text-end">
                                        <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
                                            <a href="{{ route('rh.recrutements.show', $recrutement) }}" class="btn btn-sm btn-light rounded-pill px-3">
                                                <i class="fa-solid fa-eye me-1"></i>Voir
                                            </a>

                                            <a href="{{ route('rh.recrutements.edit', $recrutement) }}" class="btn btn-sm btn-warning rounded-pill px-3">
                                                <i class="fa-solid fa-pen me-1"></i>Modifier
                                            </a>

                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-outline-primary rounded-pill px-3 dropdown-toggle" data-bs-toggle="dropdown">
                                                    <i class="fa-solid fa-diagram-project me-1"></i>Ouvrir
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-4">
                                                    <li><a class="dropdown-item" href="{{ route('rh.recrutements.dashboard', $recrutement) }}">Dashboard</a></li>
                                                    <li><a class="dropdown-item" href="{{ route('rh.recrutements.pipeline', $recrutement) }}">Pipeline</a></li>
                                                    <li><a class="dropdown-item" href="{{ route('rh.candidatures.par-recrutement', $recrutement) }}">Candidatures</a></li>
                                                </ul>
                                            </div>

                                            @if($recrutement->statut !== 'ouvert')
                                                <form method="POST" action="{{ route('rh.recrutements.ouvrir', $recrutement) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-outline-success rounded-pill px-3">
                                                        Ouvrir
                                                    </button>
                                                </form>
                                            @endif

                                            @if(!in_array($recrutement->statut, ['ferme', 'archive']))
                                                <form method="POST" action="{{ route('rh.recrutements.fermer', $recrutement) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-outline-warning rounded-pill px-3">
                                                        Fermer
                                                    </button>
                                                </form>
                                            @endif

                                            @if($recrutement->statut !== 'archive')
                                                <form method="POST" action="{{ route('rh.recrutements.archiver', $recrutement) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                                                        Archiver
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center py-5">
                                        <div class="empty-state">
                                            <i class="fa-solid fa-briefcase empty-state-icon"></i>
                                            <h5 class="mt-3">Aucun recrutement trouvé</h5>
                                            <p class="text-muted">Commence par créer ta première campagne de recrutement.</p>
                                            <a href="{{ route('rh.recrutements.create') }}" class="btn btn-primary rounded-pill px-4">
                                                <i class="fa-solid fa-plus me-2"></i>Nouveau recrutement
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $recrutements->links() }}
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
        .custom-table thead th{font-size:13px;text-transform:uppercase;letter-spacing:.5px;color:#64748b;border-bottom:1px solid #e5e7eb}
        .custom-table tbody td{border-bottom:1px solid #f1f5f9}
        .table-avatar{width:48px;height:48px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:18px}
        .empty-state{padding:20px}
        .empty-state-icon{font-size:42px;color:#94a3b8}
    </style>
@endsection