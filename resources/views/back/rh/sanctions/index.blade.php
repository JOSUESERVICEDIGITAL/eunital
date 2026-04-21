@extends('back.layouts.principal')

@section('title', 'Sanctions disciplinaires')
@section('page_title', 'Sanctions disciplinaires')
@section('page_subtitle', 'Suivi RH des sanctions, motifs, auteurs, statuts et historique disciplinaire du personnel.')

@section('content')
    @php
        $collection = $sanctions->getCollection();
        $totalActives = $collection->where('statut', 'active')->count();
        $totalLevees = $collection->where('statut', 'levee')->count();
        $totalArchivees = $collection->where('statut', 'archivee')->count();
    @endphp

    <div class="row g-4">

        <div class="col-12">
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="content-card h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="mini-label">Total sanctions</div>
                                <h3 class="stat-number">{{ $sanctions->total() }}</h3>
                            </div>
                            <div class="stat-icon bg-primary-subtle text-primary">
                                <i class="fa-solid fa-scale-balanced"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="content-card h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="mini-label">Actives</div>
                                <h3 class="stat-number">{{ $totalActives }}</h3>
                            </div>
                            <div class="stat-icon bg-danger-subtle text-danger">
                                <i class="fa-solid fa-triangle-exclamation"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="content-card h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="mini-label">Levées</div>
                                <h3 class="stat-number">{{ $totalLevees }}</h3>
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
                                <div class="mini-label">Archivées</div>
                                <h3 class="stat-number">{{ $totalArchivees }}</h3>
                            </div>
                            <div class="stat-icon bg-secondary-subtle text-secondary">
                                <i class="fa-solid fa-box-archive"></i>
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
                        <h4 class="mb-1 fw-bold">Gestion disciplinaire</h4>
                        <p class="text-muted mb-0">
                            Supervise les sanctions, les levées, l’archivage et le suivi des dossiers sensibles.
                        </p>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('rh.sanctions.actives') }}" class="btn btn-outline-danger rounded-pill px-4">
                            <i class="fa-solid fa-triangle-exclamation me-2"></i>Actives
                        </a>
                        <a href="{{ route('rh.sanctions.historique') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            <i class="fa-solid fa-clock-rotate-left me-2"></i>Historique
                        </a>
                        <a href="{{ route('rh.sanctions.create') }}" class="btn btn-primary rounded-pill px-4">
                            <i class="fa-solid fa-plus me-2"></i>Nouvelle sanction
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Filtres --}}
        <div class="col-12">
            <div class="content-card">
                <form method="GET" action="{{ route('rh.sanctions.index') }}">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Recherche</label>
                            <input type="text" name="search" class="form-control custom-input"
                                   value="{{ $filters['search'] ?? '' }}"
                                   placeholder="Motif, description, auteur, employé...">
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
                            <label class="form-label fw-semibold">Auteur</label>
                            <select name="auteur_id" class="form-select custom-input">
                                <option value="">Tous</option>
                                @foreach($auteurs as $auteur)
                                    <option value="{{ $auteur->id }}" @selected(($filters['auteur_id'] ?? '') == $auteur->id)>
                                        {{ $auteur->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-1">
                            <label class="form-label fw-semibold">Type</label>
                            <select name="type_sanction" class="form-select custom-input">
                                <option value="">Tous</option>
                                @foreach($typesSanction as $key => $label)
                                    <option value="{{ $key }}" @selected(($filters['type_sanction'] ?? '') == $key)>
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
                            <input type="date" name="date_sanction_debut" class="form-control custom-input"
                                   value="{{ $filters['date_sanction_debut'] ?? '' }}">
                        </div>
                    </div>

                    <div class="row g-3 mt-0">
                        <div class="col-md-2">
                            <label class="form-label fw-semibold">Au</label>
                            <input type="date" name="date_sanction_fin" class="form-control custom-input"
                                   value="{{ $filters['date_sanction_fin'] ?? '' }}">
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2 mt-4">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            <i class="fa-solid fa-magnifying-glass me-2"></i>Filtrer
                        </button>
                        <a href="{{ route('rh.sanctions.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
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
                        <h5 class="mb-1 fw-bold">Liste des sanctions</h5>
                        <p class="text-muted mb-0">Vue complète des sanctions disciplinaires enregistrées dans le hub RH.</p>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle custom-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Employé</th>
                                <th>Motif</th>
                                <th>Type</th>
                                <th>Auteur</th>
                                <th>Date</th>
                                <th>Statut</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sanctions as $sanction)
                                <tr>
                                    <td>{{ $sanction->id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="table-avatar bg-danger-subtle text-danger">
                                                <i class="fa-solid fa-user-shield"></i>
                                            </div>
                                            <div>
                                                <div class="fw-bold">
                                                    {{ optional($sanction->membreEquipe)->nom }} {{ optional($sanction->membreEquipe)->prenom }}
                                                </div>
                                                <div class="text-muted small">
                                                    {{ optional(optional($sanction->membreEquipe)->departement)->nom ?? 'Département non défini' }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fw-semibold">{{ $sanction->motif }}</div>
                                        <div class="text-muted small">
                                            {{ \Illuminate\Support\Str::limit($sanction->description ?? 'Sans description', 45) }}
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill text-bg-light border">
                                            {{ ucfirst(str_replace('_', ' ', $sanction->type_sanction)) }}
                                        </span>
                                    </td>
                                    <td>{{ optional($sanction->auteur)->name ?? '—' }}</td>
                                    <td>{{ $sanction->date_sanction?->format('d/m/Y') ?? '—' }}</td>
                                    <td>
                                        @php
                                            $statusClass = match($sanction->statut) {
                                                'active' => 'text-bg-danger',
                                                'levee' => 'text-bg-success',
                                                'archivee' => 'text-bg-secondary',
                                                default => 'text-bg-light'
                                            };
                                        @endphp
                                        <span class="badge rounded-pill {{ $statusClass }}">
                                            {{ ucfirst($sanction->statut) }}
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
                                            <a href="{{ route('rh.sanctions.show', $sanction) }}" class="btn btn-sm btn-light rounded-pill px-3">
                                                <i class="fa-solid fa-eye me-1"></i>Voir
                                            </a>

                                            <a href="{{ route('rh.sanctions.edit', $sanction) }}" class="btn btn-sm btn-warning rounded-pill px-3">
                                                <i class="fa-solid fa-pen me-1"></i>Modifier
                                            </a>

                                            @if($sanction->statut === 'active')
                                                <form method="POST" action="{{ route('rh.sanctions.lever', $sanction) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-outline-success rounded-pill px-3">
                                                        Lever
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5">
                                        <div class="empty-state">
                                            <i class="fa-solid fa-scale-balanced empty-state-icon"></i>
                                            <h5 class="mt-3">Aucune sanction trouvée</h5>
                                            <p class="text-muted">Crée une sanction ou ajuste les filtres.</p>
                                            <a href="{{ route('rh.sanctions.create') }}" class="btn btn-primary rounded-pill px-4">
                                                <i class="fa-solid fa-plus me-2"></i>Nouvelle sanction
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $sanctions->links() }}
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