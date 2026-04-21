@extends('back.layouts.principal')

@section('title', 'Candidatures')
@section('page_title', 'Candidatures')
@section('page_subtitle', 'Pilotage centralisé des candidatures, filtrage multi-critères, accès rapide au pipeline et décisions RH.')

@section('content')
    @php
        $collection = $candidatures->getCollection();
        $totalEnEtude = $collection->whereIn('statut', ['recu', 'en_etude'])->count();
        $totalEntretiens = $collection->where('statut', 'entretien')->count();
        $totalRetenues = $collection->where('statut', 'retenu')->count();
        $totalRejetees = $collection->where('statut', 'rejete')->count();
    @endphp

    <div class="row g-4">

        <div class="col-12">
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="content-card h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="mini-label">Total candidatures</div>
                                <h3 class="stat-number">{{ $candidatures->total() }}</h3>
                            </div>
                            <div class="stat-icon bg-primary-subtle text-primary">
                                <i class="fa-solid fa-users-viewfinder"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="content-card h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="mini-label">En étude</div>
                                <h3 class="stat-number">{{ $totalEnEtude }}</h3>
                            </div>
                            <div class="stat-icon bg-info-subtle text-info">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="content-card h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="mini-label">Entretiens</div>
                                <h3 class="stat-number">{{ $totalEntretiens }}</h3>
                            </div>
                            <div class="stat-icon bg-warning-subtle text-warning">
                                <i class="fa-solid fa-comments"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="content-card h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="mini-label">Décisions finales</div>
                                <h3 class="stat-number">{{ $totalRetenues + $totalRejetees }}</h3>
                            </div>
                            <div class="stat-icon bg-success-subtle text-success">
                                <i class="fa-solid fa-circle-check"></i>
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
                        <h4 class="mb-1 fw-bold">Gestion des candidatures</h4>
                        <p class="text-muted mb-0">
                            Supervise les profils reçus, le pipeline candidat et les décisions de recrutement.
                        </p>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('rh.candidatures.en-etude') }}" class="btn btn-outline-info rounded-pill px-4">
                            <i class="fa-solid fa-magnifying-glass me-2"></i>En étude
                        </a>
                        <a href="{{ route('rh.candidatures.entretiens') }}" class="btn btn-outline-warning rounded-pill px-4">
                            <i class="fa-solid fa-comments me-2"></i>Entretiens
                        </a>
                        <a href="{{ route('rh.candidatures.create') }}" class="btn btn-primary rounded-pill px-4">
                            <i class="fa-solid fa-plus me-2"></i>Nouvelle candidature
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Filtres --}}
        <div class="col-12">
            <div class="content-card">
                <form method="GET" action="{{ route('rh.candidatures.index') }}">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Recherche</label>
                            <input type="text" name="search" class="form-control custom-input"
                                   value="{{ $filters['search'] ?? '' }}"
                                   placeholder="Nom, prénom, email, téléphone, observation...">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Recrutement</label>
                            <select name="recrutement_id" class="form-select custom-input">
                                <option value="">Tous</option>
                                @foreach($recrutements as $recrutement)
                                    <option value="{{ $recrutement->id }}" @selected(($filters['recrutement_id'] ?? '') == $recrutement->id)>
                                        {{ $recrutement->titre }}
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
                            <input type="date" name="date_candidature_debut" class="form-control custom-input"
                                   value="{{ $filters['date_candidature_debut'] ?? '' }}">
                        </div>

                        <div class="col-md-1">
                            <label class="form-label fw-semibold">Au</label>
                            <input type="date" name="date_candidature_fin" class="form-control custom-input"
                                   value="{{ $filters['date_candidature_fin'] ?? '' }}">
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2 mt-4">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            <i class="fa-solid fa-magnifying-glass me-2"></i>Filtrer
                        </button>
                        <a href="{{ route('rh.candidatures.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
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
                        <h5 class="mb-1 fw-bold">Liste des candidatures</h5>
                        <p class="text-muted mb-0">Vision complète du flux candidat avec actions rapides.</p>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle custom-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Candidat</th>
                                <th>Contact</th>
                                <th>Recrutement</th>
                                <th>Département</th>
                                <th>Statut</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($candidatures as $candidature)
                                <tr>
                                    <td>{{ $candidature->id }}</td>

                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="table-avatar bg-primary-subtle text-primary">
                                                <i class="fa-solid fa-user"></i>
                                            </div>
                                            <div>
                                                <div class="fw-bold">{{ $candidature->nom }} {{ $candidature->prenom }}</div>
                                                <div class="text-muted small">
                                                    {{ $candidature->date_candidature?->format('d/m/Y') ?? 'Date non définie' }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div>{{ $candidature->email ?? '—' }}</div>
                                        <div class="text-muted small">{{ $candidature->telephone ?? '—' }}</div>
                                    </td>

                                    <td>{{ optional($candidature->recrutement)->titre ?? '—' }}</td>
                                    <td>{{ optional(optional($candidature->recrutement)->departement)->nom ?? '—' }}</td>

                                    <td>
                                        @php
                                            $statusClass = match($candidature->statut) {
                                                'recu' => 'text-bg-light border',
                                                'en_etude' => 'text-bg-info',
                                                'entretien' => 'text-bg-warning',
                                                'retenu' => 'text-bg-success',
                                                'rejete' => 'text-bg-danger',
                                                default => 'text-bg-light'
                                            };
                                        @endphp
                                        <span class="badge rounded-pill {{ $statusClass }}">
                                            {{ ucfirst(str_replace('_', ' ', $candidature->statut)) }}
                                        </span>
                                    </td>

                                    <td class="text-end">
                                        <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
                                            <a href="{{ route('rh.candidatures.show', $candidature) }}" class="btn btn-sm btn-light rounded-pill px-3">
                                                <i class="fa-solid fa-eye me-1"></i>Voir
                                            </a>

                                            <a href="{{ route('rh.candidatures.edit', $candidature) }}" class="btn btn-sm btn-warning rounded-pill px-3">
                                                <i class="fa-solid fa-pen me-1"></i>Modifier
                                            </a>

                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-outline-primary rounded-pill px-3 dropdown-toggle" data-bs-toggle="dropdown">
                                                    <i class="fa-solid fa-arrows-rotate me-1"></i>Statut
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-4 p-2">
                                                    <form method="POST" action="{{ route('rh.candidatures.changer-statut', $candidature) }}" class="mb-2">
                                                        @csrf
                                                        <input type="hidden" name="statut" value="en_etude">
                                                        <button type="submit" class="dropdown-item rounded-3">Mettre en étude</button>
                                                    </form>

                                                    <form method="POST" action="{{ route('rh.candidatures.changer-statut', $candidature) }}" class="mb-2">
                                                        @csrf
                                                        <input type="hidden" name="statut" value="entretien">
                                                        <button type="submit" class="dropdown-item rounded-3">Passer en entretien</button>
                                                    </form>

                                                    <form method="POST" action="{{ route('rh.candidatures.retenir', $candidature) }}" class="mb-2">
                                                        @csrf
                                                        <button type="submit" class="dropdown-item rounded-3 text-success">Retenir</button>
                                                    </form>

                                                    <form method="POST" action="{{ route('rh.candidatures.rejeter', $candidature) }}">
                                                        @csrf
                                                        <button type="submit" class="dropdown-item rounded-3 text-danger">Rejeter</button>
                                                    </form>
                                                </div>
                                            </div>

                                            <button type="button"
                                                    class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteCandidatureModal{{ $candidature->id }}">
                                                <i class="fa-solid fa-trash me-1"></i>Supprimer
                                            </button>
                                        </div>

                                        <div class="modal fade" id="deleteCandidatureModal{{ $candidature->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content border-0 rounded-4">
                                                    <div class="modal-header border-0">
                                                        <h5 class="modal-title fw-bold">Supprimer la candidature</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Veux-tu vraiment supprimer la candidature de
                                                        <strong>{{ $candidature->nom }} {{ $candidature->prenom }}</strong> ?
                                                    </div>
                                                    <div class="modal-footer border-0">
                                                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Annuler</button>
                                                        <form method="POST" action="{{ route('rh.candidatures.destroy', $candidature) }}">
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
                                    <td colspan="7" class="text-center py-5">
                                        <div class="empty-state">
                                            <i class="fa-solid fa-users-viewfinder empty-state-icon"></i>
                                            <h5 class="mt-3">Aucune candidature trouvée</h5>
                                            <p class="text-muted">Ajoute une candidature ou ajuste les filtres.</p>
                                            <a href="{{ route('rh.candidatures.create') }}" class="btn btn-primary rounded-pill px-4">
                                                <i class="fa-solid fa-plus me-2"></i>Nouvelle candidature
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $candidatures->links() }}
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