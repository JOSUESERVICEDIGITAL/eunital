@extends('back.layouts.principal')

@section('title', 'Bien-être au travail')
@section('page_title', 'Bien-être au travail')
@section('page_subtitle', 'Suivi des signalements, accompagnements, incidents et dossiers sensibles liés au climat humain et social.')

@section('content')
    @php
        $collection = $dossiers->getCollection();
        $totalOuverts = $collection->where('statut', 'ouvert')->count();
        $totalEnCours = $collection->where('statut', 'en_cours')->count();
        $totalTraites = $collection->where('statut', 'traite')->count();
        $totalUrgents = $collection->where('niveau_priorite', 'urgente')->count();
    @endphp

    <div class="row g-4">

        <div class="col-12">
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="content-card h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="mini-label">Total dossiers</div>
                                <h3 class="stat-number">{{ $dossiers->total() }}</h3>
                            </div>
                            <div class="stat-icon bg-primary-subtle text-primary">
                                <i class="fa-solid fa-heart-circle-check"></i>
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
                            <div class="stat-icon bg-warning-subtle text-warning">
                                <i class="fa-solid fa-folder-open"></i>
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
                                <div class="mini-label">Priorité urgente</div>
                                <h3 class="stat-number">{{ $totalUrgents }}</h3>
                            </div>
                            <div class="stat-icon bg-danger-subtle text-danger">
                                <i class="fa-solid fa-triangle-exclamation"></i>
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
                        <h4 class="mb-1 fw-bold">Pilotage du bien-être au travail</h4>
                        <p class="text-muted mb-0">
                            Gère les signalements, accompagnements et suivis humains avec un accès rapide aux dossiers sensibles.
                        </p>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('rh.bien-etre.ouverts') }}" class="btn btn-outline-warning rounded-pill px-4">
                            <i class="fa-solid fa-folder-open me-2"></i>Ouverts
                        </a>
                        <a href="{{ route('rh.bien-etre.statistiques') }}" class="btn btn-outline-info rounded-pill px-4">
                            <i class="fa-solid fa-chart-pie me-2"></i>Statistiques
                        </a>
                        <a href="{{ route('rh.bien-etre.create') }}" class="btn btn-primary rounded-pill px-4">
                            <i class="fa-solid fa-plus me-2"></i>Nouveau dossier
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Filtres --}}
        <div class="col-12">
            <div class="content-card">
                <form method="GET" action="{{ route('rh.bien-etre.index') }}">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Recherche</label>
                            <input type="text" name="search" class="form-control custom-input"
                                   value="{{ $filters['search'] ?? '' }}"
                                   placeholder="Titre, description, employé, auteur...">
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
                            <select name="type" class="form-select custom-input">
                                <option value="">Tous</option>
                                @foreach($types as $key => $label)
                                    <option value="{{ $key }}" @selected(($filters['type'] ?? '') == $key)>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-1">
                            <label class="form-label fw-semibold">Priorité</label>
                            <select name="niveau_priorite" class="form-select custom-input">
                                <option value="">Toutes</option>
                                @foreach($priorites as $key => $label)
                                    <option value="{{ $key }}" @selected(($filters['niveau_priorite'] ?? '') == $key)>
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
                    </div>

                    <div class="row g-3 mt-0">
                        <div class="col-md-2">
                            <label class="form-label fw-semibold">Du</label>
                            <input type="date" name="date_debut" class="form-control custom-input"
                                   value="{{ $filters['date_debut'] ?? '' }}">
                        </div>

                        <div class="col-md-2">
                            <label class="form-label fw-semibold">Au</label>
                            <input type="date" name="date_fin" class="form-control custom-input"
                                   value="{{ $filters['date_fin'] ?? '' }}">
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2 mt-4">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            <i class="fa-solid fa-magnifying-glass me-2"></i>Filtrer
                        </button>
                        <a href="{{ route('rh.bien-etre.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
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
                        <h5 class="mb-1 fw-bold">Liste des dossiers bien-être</h5>
                        <p class="text-muted mb-0">Vue consolidée des dossiers humains et sociaux du hub RH.</p>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle custom-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Dossier</th>
                                <th>Employé</th>
                                <th>Type</th>
                                <th>Priorité</th>
                                <th>Auteur</th>
                                <th>Statut</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dossiers as $dossier)
                                <tr>
                                    <td>{{ $dossier->id }}</td>
                                    <td>
                                        <div class="fw-bold">{{ $dossier->titre }}</div>
                                        <div class="text-muted small">
                                            {{ \Illuminate\Support\Str::limit($dossier->description ?? 'Sans description', 50) }}
                                        </div>
                                    </td>
                                    <td>
                                        {{ optional($dossier->membreEquipe)->nom }} {{ optional($dossier->membreEquipe)->prenom }}
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill text-bg-light border">
                                            {{ ucfirst(str_replace('_', ' ', $dossier->type)) }}
                                        </span>
                                    </td>
                                    <td>
                                        @php
                                            $priorityClass = match($dossier->niveau_priorite) {
                                                'faible' => 'text-bg-light border',
                                                'moyenne' => 'text-bg-info',
                                                'haute' => 'text-bg-warning',
                                                'urgente' => 'text-bg-danger',
                                                default => 'text-bg-light'
                                            };
                                        @endphp
                                        <span class="badge rounded-pill {{ $priorityClass }}">
                                            {{ ucfirst($dossier->niveau_priorite) }}
                                        </span>
                                    </td>
                                    <td>{{ optional($dossier->auteur)->name ?? '—' }}</td>
                                    <td>
                                        @php
                                            $statusClass = match($dossier->statut) {
                                                'ouvert' => 'text-bg-warning',
                                                'en_cours' => 'text-bg-info',
                                                'traite' => 'text-bg-success',
                                                'archive' => 'text-bg-secondary',
                                                default => 'text-bg-light'
                                            };
                                        @endphp
                                        <span class="badge rounded-pill {{ $statusClass }}">
                                            {{ ucfirst(str_replace('_', ' ', $dossier->statut)) }}
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
                                            <a href="{{ route('rh.bien-etre.show', $dossier) }}" class="btn btn-sm btn-light rounded-pill px-3">
                                                <i class="fa-solid fa-eye me-1"></i>Voir
                                            </a>

                                            <a href="{{ route('rh.bien-etre.edit', $dossier) }}" class="btn btn-sm btn-warning rounded-pill px-3">
                                                <i class="fa-solid fa-pen me-1"></i>Modifier
                                            </a>

                                            <a href="{{ route('rh.bien-etre.suivi', $dossier) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                                <i class="fa-solid fa-clock-rotate-left me-1"></i>Suivi
                                            </a>

                                            @if(in_array($dossier->statut, ['ouvert', 'en_cours']))
                                                <form method="POST" action="{{ route('rh.bien-etre.cloturer', $dossier) }}">
                                                    @csrf
                                                    <input type="hidden" name="statut" value="traite">
                                                    <button type="submit" class="btn btn-sm btn-outline-success rounded-pill px-3">
                                                        Traiter
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
                                            <i class="fa-solid fa-heart-circle-check empty-state-icon"></i>
                                            <h5 class="mt-3">Aucun dossier trouvé</h5>
                                            <p class="text-muted">Crée un nouveau dossier ou ajuste les filtres.</p>
                                            <a href="{{ route('rh.bien-etre.create') }}" class="btn btn-primary rounded-pill px-4">
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
        .custom-table thead th{font-size:13px;text-transform:uppercase;letter-spacing:.5px;color:#64748b;border-bottom:1px solid #e5e7eb}
        .custom-table tbody td{border-bottom:1px solid #f1f5f9}
        .empty-state{padding:20px}
        .empty-state-icon{font-size:42px;color:#94a3b8}
    </style>
@endsection