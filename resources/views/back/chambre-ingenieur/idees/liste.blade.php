@extends('back.layouts.principal')

@section('title', 'Idées et propositions')
@section('page_title', 'Chambre d’ingénieurs · Idées et propositions')
@section('page_subtitle', 'Espace d’émergence des idées, améliorations, solutions techniques et initiatives structurantes du hub.')

@section('content')
    <div class="row g-4">

        <div class="col-12">
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="content-card h-100">
                        <div class="mini-label">Total idées</div>
                        <h3 class="stat-number">{{ $idees->total() }}</h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="content-card h-100">
                        <div class="mini-label">Nouvelles</div>
                        <h3 class="stat-number">{{ $idees->where('statut', 'nouvelle')->count() }}</h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="content-card h-100">
                        <div class="mini-label">En étude</div>
                        <h3 class="stat-number">{{ $idees->where('statut', 'en_etude')->count() }}</h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="content-card h-100">
                        <div class="mini-label">Critiques</div>
                        <h3 class="stat-number">{{ $idees->where('niveau_priorite', 'critique')->count() }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="content-card">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <div>
                        <h4 class="fw-bold mb-1">Fenêtre innovation</h4>
                        <p class="text-muted mb-0">Zone de dépôt, de tri et de maturation des idées d’ingénierie.</p>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('back.chambre-ingenieur.idees.toutes') }}" class="btn btn-outline-dark rounded-pill px-4">Toutes</a>
                        <a href="{{ route('back.chambre-ingenieur.idees.nouvelles') }}" class="btn btn-outline-primary rounded-pill px-4">Nouvelles</a>
                        <a href="{{ route('back.chambre-ingenieur.idees.en_etude') }}" class="btn btn-outline-info rounded-pill px-4">En étude</a>
                        <a href="{{ route('back.chambre-ingenieur.idees.retenues') }}" class="btn btn-outline-success rounded-pill px-4">Retenues</a>
                        <a href="{{ route('back.chambre-ingenieur.idees.critiques') }}" class="btn btn-outline-danger rounded-pill px-4">Critiques</a>
                        <a href="{{ route('back.chambre-ingenieur.idees.creer') }}" class="btn btn-primary rounded-pill px-4">
                            <i class="fa-solid fa-plus me-2"></i>Nouvelle idée
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="content-card">
                <div class="table-responsive">
                    <table class="table align-middle custom-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Idée</th>
                                <th>Priorité</th>
                                <th>Statut</th>
                                <th>Auteur</th>
                                <th>Responsable</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($idees as $idee)
                                <tr>
                                    <td>{{ $idee->id }}</td>
                                    <td>
                                        <div class="fw-bold">{{ $idee->titre }}</div>
                                        <div class="text-muted small">{{ \Illuminate\Support\Str::limit($idee->description, 70) }}</div>
                                    </td>
                                    <td><span class="badge rounded-pill text-bg-light border">{{ ucfirst($idee->niveau_priorite) }}</span></td>
                                    <td><span class="badge rounded-pill text-bg-secondary">{{ str_replace('_', ' ', ucfirst($idee->statut)) }}</span></td>
                                    <td>{{ $idee->auteur->name ?? '—' }}</td>
                                    <td>{{ $idee->responsable->name ?? '—' }}</td>
                                    <td class="text-end">
    <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
        <a href="{{ route('back.chambre-ingenieur.idees.details', $idee) }}" class="btn btn-sm btn-light rounded-pill px-3">Voir</a>
        <a href="{{ route('back.chambre-ingenieur.idees.modifier', $idee) }}" class="btn btn-sm btn-warning rounded-pill px-3">Modifier</a>

        <button type="button"
            class="btn btn-sm btn-outline-danger rounded-pill px-3"
            data-bs-toggle="modal"
            data-bs-target="#modalSuppressionIdee{{ $idee->id }}">
            Supprimer
        </button>
    </div>

    @include('back.chambre-ingenieur.idees._modales', ['idee' => $idee])
</td>
                                </tr>
                            @empty
                                <tr><td colspan="7" class="text-center py-5 text-muted">Aucune idée trouvée.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">{{ $idees->links() }}</div>
            </div>
        </div>
    </div>

    <style>
        .mini-label{font-size:13px;color:#64748b;font-weight:700;margin-bottom:8px}
        .stat-number{font-size:32px;font-weight:800;margin:0}
        .custom-table thead th{font-size:13px;text-transform:uppercase;letter-spacing:.5px;color:#64748b;border-bottom:1px solid #e5e7eb}
    </style>
@endsection