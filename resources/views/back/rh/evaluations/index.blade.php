@extends('back.layouts.principal')

@section('title', 'Évaluations RH')
@section('page_title', 'Évaluations RH')
@section('page_subtitle', 'Gestion des évaluations du personnel, suivi des notes, des statuts et des validations dans la chambre RH.')

@section('content')
    @php
        $collection = $evaluations->getCollection();
        $totalBrouillons = $collection->where('statut', 'brouillon')->count();
        $totalValidees = $collection->where('statut', 'validee')->count();
        $totalArchivees = $collection->where('statut', 'archivee')->count();
        $moyenneNotes = $collection->whereNotNull('note_globale')->avg('note_globale');
    @endphp

    <div class="row g-4">

        <div class="col-12">
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="content-card h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="mini-label">Total évaluations</div>
                                <h3 class="stat-number">{{ $evaluations->total() }}</h3>
                            </div>
                            <div class="stat-icon bg-primary-subtle text-primary">
                                <i class="fa-solid fa-chart-line"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="content-card h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="mini-label">Brouillons</div>
                                <h3 class="stat-number">{{ $totalBrouillons }}</h3>
                            </div>
                            <div class="stat-icon bg-warning-subtle text-warning">
                                <i class="fa-solid fa-file-pen"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="content-card h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="mini-label">Validées</div>
                                <h3 class="stat-number">{{ $totalValidees }}</h3>
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
                                <div class="mini-label">Moyenne visible</div>
                                <h3 class="stat-number">{{ $moyenneNotes ? number_format($moyenneNotes, 1, ',', ' ') : '—' }}</h3>
                            </div>
                            <div class="stat-icon bg-info-subtle text-info">
                                <i class="fa-solid fa-star"></i>
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
                        <h4 class="mb-1 fw-bold">Pilotage des évaluations</h4>
                        <p class="text-muted mb-0">
                            Gère les évaluations, les cycles d’appréciation, les notes et les validations RH.
                        </p>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('rh.evaluations.brouillons') }}" class="btn btn-outline-warning rounded-pill px-4">
                            <i class="fa-solid fa-file-pen me-2"></i>Brouillons
                        </a>
                        <a href="{{ route('rh.evaluations.synthese') }}" class="btn btn-outline-info rounded-pill px-4">
                            <i class="fa-solid fa-chart-column me-2"></i>Synthèse
                        </a>
                        <a href="{{ route('rh.evaluations.create') }}" class="btn btn-primary rounded-pill px-4">
                            <i class="fa-solid fa-plus me-2"></i>Nouvelle évaluation
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Filtres --}}
        <div class="col-12">
            <div class="content-card">
                <form method="GET" action="{{ route('rh.evaluations.index') }}">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Recherche</label>
                            <input type="text" name="search" class="form-control custom-input"
                                   value="{{ $filters['search'] ?? '' }}"
                                   placeholder="Titre, points forts, recommandations...">
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
                            <label class="form-label fw-semibold">Évaluateur</label>
                            <select name="evaluateur_id" class="form-select custom-input">
                                <option value="">Tous</option>
                                @foreach($evaluateurs as $evaluateur)
                                    <option value="{{ $evaluateur->id }}" @selected(($filters['evaluateur_id'] ?? '') == $evaluateur->id)>
                                        {{ $evaluateur->name }}
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
                            <label class="form-label fw-semibold">Note min</label>
                            <input type="number" min="0" max="10" name="note_min" class="form-control custom-input"
                                   value="{{ $filters['note_min'] ?? '' }}">
                        </div>

                        <div class="col-md-1">
                            <label class="form-label fw-semibold">Note max</label>
                            <input type="number" min="0" max="10" name="note_max" class="form-control custom-input"
                                   value="{{ $filters['note_max'] ?? '' }}">
                        </div>
                    </div>

                    <div class="row g-3 mt-0">
                        <div class="col-md-2">
                            <label class="form-label fw-semibold">Du</label>
                            <input type="date" name="date_evaluation_debut" class="form-control custom-input"
                                   value="{{ $filters['date_evaluation_debut'] ?? '' }}">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-semibold">Au</label>
                            <input type="date" name="date_evaluation_fin" class="form-control custom-input"
                                   value="{{ $filters['date_evaluation_fin'] ?? '' }}">
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2 mt-4">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            <i class="fa-solid fa-magnifying-glass me-2"></i>Filtrer
                        </button>
                        <a href="{{ route('rh.evaluations.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
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
                        <h5 class="mb-1 fw-bold">Liste des évaluations</h5>
                        <p class="text-muted mb-0">Vue détaillée des évaluations du personnel avec accès rapide aux décisions RH.</p>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle custom-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Évaluation</th>
                                <th>Employé</th>
                                <th>Évaluateur</th>
                                <th>Date</th>
                                <th>Note</th>
                                <th>Statut</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($evaluations as $evaluation)
                                <tr>
                                    <td>{{ $evaluation->id }}</td>
                                    <td>
                                        <div class="fw-bold">{{ $evaluation->titre }}</div>
                                        <div class="text-muted small">
                                            {{ \Illuminate\Support\Str::limit($evaluation->points_forts ?? 'Sans résumé', 45) }}
                                        </div>
                                    </td>
                                    <td>
                                        {{ optional($evaluation->membreEquipe)->nom }} {{ optional($evaluation->membreEquipe)->prenom }}
                                    </td>
                                    <td>{{ optional($evaluation->evaluateur)->name ?? '—' }}</td>
                                    <td>{{ $evaluation->date_evaluation?->format('d/m/Y') ?? '—' }}</td>
                                    <td>
                                        <span class="badge rounded-pill text-bg-info">
                                            {{ $evaluation->note_globale ?? '—' }}/10
                                        </span>
                                    </td>
                                    <td>
                                        @php
                                            $statusClass = match($evaluation->statut) {
                                                'brouillon' => 'text-bg-warning',
                                                'validee' => 'text-bg-success',
                                                'archivee' => 'text-bg-secondary',
                                                default => 'text-bg-light'
                                            };
                                        @endphp
                                        <span class="badge rounded-pill {{ $statusClass }}">
                                            {{ ucfirst($evaluation->statut) }}
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
                                            <a href="{{ route('rh.evaluations.show', $evaluation) }}" class="btn btn-sm btn-light rounded-pill px-3">
                                                <i class="fa-solid fa-eye me-1"></i>Voir
                                            </a>

                                            <a href="{{ route('rh.evaluations.edit', $evaluation) }}" class="btn btn-sm btn-warning rounded-pill px-3">
                                                <i class="fa-solid fa-pen me-1"></i>Modifier
                                            </a>

                                            @if($evaluation->statut === 'brouillon')
                                                <form method="POST" action="{{ route('rh.evaluations.valider', $evaluation) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-outline-success rounded-pill px-3">
                                                        Valider
                                                    </button>
                                                </form>
                                            @endif

                                            @if($evaluation->statut !== 'archivee')
                                                <form method="POST" action="{{ route('rh.evaluations.archiver', $evaluation) }}">
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
                                    <td colspan="8" class="text-center py-5">
                                        <div class="empty-state">
                                            <i class="fa-solid fa-chart-line empty-state-icon"></i>
                                            <h5 class="mt-3">Aucune évaluation trouvée</h5>
                                            <p class="text-muted">Crée une nouvelle évaluation ou ajuste les filtres.</p>
                                            <a href="{{ route('rh.evaluations.create') }}" class="btn btn-primary rounded-pill px-4">
                                                <i class="fa-solid fa-plus me-2"></i>Nouvelle évaluation
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $evaluations->links() }}
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