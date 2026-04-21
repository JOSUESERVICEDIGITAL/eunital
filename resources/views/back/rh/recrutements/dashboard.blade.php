@extends('back.layouts.principal')

@section('title', 'Dashboard du recrutement')
@section('page_title', 'Dashboard du recrutement')
@section('page_subtitle', 'Cockpit analytique dédié à une campagne RH : volume, conversion, répartition et profils récents.')

@section('content')
    <div class="row g-4">

        <div class="col-12">
            <div class="content-card">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <div>
                        <h4 class="fw-bold mb-1">{{ $recrutement->titre }}</h4>
                        <p class="text-muted mb-0">
                            {{ optional($recrutement->departement)->nom ?? 'Département non défini' }} •
                            {{ optional($recrutement->poste)->nom ?? 'Poste non défini' }}
                        </p>
                    </div>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('rh.recrutements.pipeline', $recrutement) }}" class="btn btn-outline-primary rounded-pill px-4">Pipeline</a>
                        <a href="{{ route('rh.recrutements.show', $recrutement) }}" class="btn btn-outline-secondary rounded-pill px-4">Fiche</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="content-card h-100">
                <div class="mini-label">Total candidatures</div>
                <h3 class="stat-number">{{ $stats['total'] ?? 0 }}</h3>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="content-card h-100">
                <div class="mini-label">Entretien</div>
                <h3 class="stat-number">{{ $stats['entretien'] ?? 0 }}</h3>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="content-card h-100">
                <div class="mini-label">Taux retenu</div>
                <h3 class="stat-number text-success">{{ $stats['taux_retention'] ?? 0 }}%</h3>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="content-card h-100">
                <div class="mini-label">Taux rejet</div>
                <h3 class="stat-number text-danger">{{ $stats['taux_rejet'] ?? 0 }}%</h3>
            </div>
        </div>

        <div class="col-12">
            <div class="content-card">
                <div class="table-head-custom mb-4">
                    <div>
                        <h5 class="fw-bold mb-1">Candidatures récentes</h5>
                        <p class="text-muted mb-0">Les derniers profils reçus sur cette campagne.</p>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle custom-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Candidat</th>
                                <th>Email</th>
                                <th>Statut</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($candidaturesRecentes as $candidature)
                                <tr>
                                    <td>{{ $candidature->id }}</td>
                                    <td>{{ $candidature->nom }} {{ $candidature->prenom }}</td>
                                    <td>{{ $candidature->email ?? '—' }}</td>
                                    <td>
                                        <span class="badge rounded-pill text-bg-light border">
                                            {{ ucfirst(str_replace('_', ' ', $candidature->statut)) }}
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('rh.candidatures.show', $candidature) }}" class="btn btn-sm btn-light rounded-pill px-3">
                                            Voir
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">Aucune candidature récente.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>

    <style>
        .mini-label{font-size:13px;color:#64748b;font-weight:700;margin-bottom:8px}
        .stat-number{font-size:32px;font-weight:800;margin:0}
        .table-head-custom{display:flex;justify-content:space-between;align-items:center;gap:16px;flex-wrap:wrap}
        .custom-table thead th{font-size:13px;text-transform:uppercase;letter-spacing:.5px;color:#64748b;border-bottom:1px solid #e5e7eb}
        .custom-table tbody td{border-bottom:1px solid #f1f5f9}
    </style>
@endsection