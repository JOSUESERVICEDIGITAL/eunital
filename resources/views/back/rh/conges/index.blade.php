@extends('back.layouts.principal')

@section('title', 'Congés RH')
@section('page_title', 'Congés RH')
@section('page_subtitle', 'Gestion complète des demandes de congé, validation, filtrage, historique et navigation rapide vers les fiches employé.')

@section('content')
    @php
        $collection = $conges->getCollection();
        $totalEnAttente = $collection->where('statut', 'en_attente')->count();
        $totalValides = $collection->where('statut', 'valide')->count();
        $totalRefuses = $collection->where('statut', 'refuse')->count();
    @endphp

    <div class="row g-4">

        {{-- Stats --}}
        <div class="col-12">
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="content-card h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="mini-label">Total congés</div>
                                <h3 class="stat-number">{{ $conges->total() }}</h3>
                            </div>
                            <div class="stat-icon bg-primary-subtle text-primary">
                                <i class="fa-solid fa-calendar-days"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="content-card h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="mini-label">En attente</div>
                                <h3 class="stat-number">{{ $totalEnAttente }}</h3>
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
                                <h3 class="stat-number">{{ $totalValides }}</h3>
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
                                <div class="mini-label">Refusés</div>
                                <h3 class="stat-number">{{ $totalRefuses }}</h3>
                            </div>
                            <div class="stat-icon bg-danger-subtle text-danger">
                                <i class="fa-solid fa-circle-xmark"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="col-12">
            <div class="content-card">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <div>
                        <h4 class="mb-1 fw-bold">Gestion des congés</h4>
                        <p class="text-muted mb-0">Crée, filtre, consulte et traite rapidement les demandes de congé de toute l’organisation.</p>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('rh.conges.en-attente') }}" class="btn btn-outline-warning rounded-pill px-4">
                            <i class="fa-solid fa-hourglass-half me-2"></i>En attente
                        </a>
                        <a href="{{ route('rh.conges.calendrier') }}" class="btn btn-outline-info rounded-pill px-4">
                            <i class="fa-solid fa-calendar-week me-2"></i>Calendrier
                        </a>
                        <a href="{{ route('rh.conges.create') }}" class="btn btn-primary rounded-pill px-4">
                            <i class="fa-solid fa-plus me-2"></i>Nouveau congé
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Filtres --}}
        <div class="col-12">
            <div class="content-card">
                <form method="GET" action="{{ route('rh.conges.index') }}">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Recherche</label>
                            <input type="text" name="search" class="form-control custom-input"
                                   value="{{ $filters['search'] ?? '' }}"
                                   placeholder="Nom, prénom, motif...">
                        </div>

                        <div class="col-md-2">
                            <label class="form-label fw-semibold">Employé</label>
                            <select name="membre_equipe_id" class="form-select custom-input">
                                <option value="">Tous</option>
                                @foreach($membres as $membre)
                                    <option value="{{ $membre->id }}" @selected(($filters['membre_equipe_id'] ?? '') == $membre->id)>
                                        {{ $membre->nom }} {{ $membre->prenom }}
                                    </option>
                                @endforeach
                            </select>
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
                            <label class="form-label fw-semibold">Type</label>
                            <select name="type_conge" class="form-select custom-input">
                                <option value="">Tous</option>
                                @foreach($typesConge as $key => $label)
                                    <option value="{{ $key }}" @selected(($filters['type_conge'] ?? '') == $key)>
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
                            <label class="form-label fw-semibold">Début</label>
                            <input type="date" name="date_debut" class="form-control custom-input"
                                   value="{{ $filters['date_debut'] ?? '' }}">
                        </div>

                        <div class="col-md-1">
                            <label class="form-label fw-semibold">Fin</label>
                            <input type="date" name="date_fin" class="form-control custom-input"
                                   value="{{ $filters['date_fin'] ?? '' }}">
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2 mt-4">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            <i class="fa-solid fa-magnifying-glass me-2"></i>Filtrer
                        </button>
                        <a href="{{ route('rh.conges.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
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
                        <h5 class="mb-1 fw-bold">Liste des congés</h5>
                        <p class="text-muted mb-0">Pilotage centralisé des demandes de congé avec accès direct aux actions métier.</p>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle custom-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Employé</th>
                                <th>Type</th>
                                <th>Période</th>
                                <th>Jours</th>
                                <th>Statut</th>
                                <th>Validateur</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($conges as $conge)
                                <tr>
                                    <td>{{ $conge->id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="table-avatar bg-primary-subtle text-primary">
                                                <i class="fa-solid fa-user"></i>
                                            </div>
                                            <div>
                                                <div class="fw-bold">
                                                    {{ optional($conge->membreEquipe)->nom }} {{ optional($conge->membreEquipe)->prenom }}
                                                </div>
                                                <div class="text-muted small">
                                                    {{ optional(optional($conge->membreEquipe)->departement)->nom ?? 'Département non défini' }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ ucfirst(str_replace('_', ' ', $conge->type_conge)) }}</td>
                                    <td>
                                        {{ $conge->date_debut?->format('d/m/Y') ?? '—' }}
                                        <span class="text-muted">→</span>
                                        {{ $conge->date_fin?->format('d/m/Y') ?? '—' }}
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill text-bg-dark">
                                            {{ $conge->nombre_jours ?? '—' }}
                                        </span>
                                    </td>
                                    <td>
                                        @php
                                            $statusClass = match($conge->statut) {
                                                'en_attente' => 'text-bg-warning',
                                                'valide' => 'text-bg-success',
                                                'refuse' => 'text-bg-danger',
                                                'annule' => 'text-bg-secondary',
                                                default => 'text-bg-light'
                                            };
                                        @endphp
                                        <span class="badge rounded-pill {{ $statusClass }}">
                                            {{ ucfirst(str_replace('_', ' ', $conge->statut)) }}
                                        </span>
                                    </td>
                                    <td>{{ optional($conge->validateur)->name ?? '—' }}</td>
                                    <td class="text-end">
                                        <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
                                            <a href="{{ route('rh.conges.show', $conge) }}" class="btn btn-sm btn-light rounded-pill px-3">
                                                <i class="fa-solid fa-eye me-1"></i>Voir
                                            </a>

                                            <a href="{{ route('rh.conges.edit', $conge) }}" class="btn btn-sm btn-warning rounded-pill px-3">
                                                <i class="fa-solid fa-pen me-1"></i>Modifier
                                            </a>

                                            @if($conge->statut === 'en_attente')
                                                <form method="POST" action="{{ route('rh.conges.valider', $conge) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-outline-success rounded-pill px-3">
                                                        <i class="fa-solid fa-check me-1"></i>Valider
                                                    </button>
                                                </form>

                                                <form method="POST" action="{{ route('rh.conges.refuser', $conge) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                                        <i class="fa-solid fa-xmark me-1"></i>Refuser
                                                    </button>
                                                </form>
                                            @endif

                                            <button type="button"
                                                    class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteCongeModal{{ $conge->id }}">
                                                <i class="fa-solid fa-trash me-1"></i>Supprimer
                                            </button>
                                        </div>

                                        <div class="modal fade" id="deleteCongeModal{{ $conge->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content border-0 rounded-4">
                                                    <div class="modal-header border-0">
                                                        <h5 class="modal-title fw-bold">Supprimer le congé</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Veux-tu vraiment supprimer cette demande de congé ?
                                                    </div>
                                                    <div class="modal-footer border-0">
                                                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Annuler</button>
                                                        <form method="POST" action="{{ route('rh.conges.destroy', $conge) }}">
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
                                            <i class="fa-solid fa-calendar-days empty-state-icon"></i>
                                            <h5 class="mt-3">Aucun congé trouvé</h5>
                                            <p class="text-muted">Crée une nouvelle demande ou ajuste les filtres.</p>
                                            <a href="{{ route('rh.conges.create') }}" class="btn btn-primary rounded-pill px-4">
                                                <i class="fa-solid fa-plus me-2"></i>Nouveau congé
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $conges->links() }}
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