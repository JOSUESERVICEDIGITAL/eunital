@extends('back.layouts.principal')

@section('title', 'Solde de congé employé')
@section('page_title', 'Solde de congé')
@section('page_subtitle', 'Vision individuelle du solde de congés, consommation et historique du collaborateur.')

@section('content')
    <div class="row g-4">

        <div class="col-md-4">
            <div class="content-card h-100">
                <div class="mini-label">Employé</div>
                <h4 class="fw-bold mb-2">{{ $membre->nom }} {{ $membre->prenom }}</h4>
                <p class="text-muted mb-0">{{ optional($membre->departement)->nom ?? 'Département non défini' }}</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="content-card h-100">
                <div class="mini-label">Jours pris</div>
                <h3 class="stat-number">{{ $joursPris }}</h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="content-card h-100">
                <div class="mini-label">Solde restant</div>
                <h3 class="stat-number text-success">{{ $soldeRestant }}</h3>
            </div>
        </div>

        <div class="col-12">
            <div class="content-card">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                    <div>
                        <h5 class="fw-bold mb-1">Historique des congés validés</h5>
                        <p class="text-muted mb-0">Base de calcul du solde restant.</p>
                    </div>
                    <a href="{{ route('rh.conges.par-employe', $membre) }}" class="btn btn-outline-primary rounded-pill px-4">
                        Tous les congés
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle custom-table">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Période</th>
                                <th>Jours</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($conges as $conge)
                                <tr>
                                    <td>{{ ucfirst(str_replace('_', ' ', $conge->type_conge)) }}</td>
                                    <td>{{ $conge->date_debut?->format('d/m/Y') }} → {{ $conge->date_fin?->format('d/m/Y') }}</td>
                                    <td>{{ $conge->nombre_jours ?? '—' }}</td>
                                    <td><span class="badge rounded-pill text-bg-success">{{ ucfirst(str_replace('_', ' ', $conge->statut)) }}</span></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5">
                                        <div class="empty-state">
                                            <i class="fa-solid fa-calendar-check empty-state-icon"></i>
                                            <h5 class="mt-3">Aucun congé validé</h5>
                                        </div>
                                    </td>
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
        .custom-table thead th{font-size:13px;text-transform:uppercase;letter-spacing:.5px;color:#64748b;border-bottom:1px solid #e5e7eb}
        .custom-table tbody td{border-bottom:1px solid #f1f5f9}
        .empty-state{text-align:center;padding:20px}
        .empty-state-icon{font-size:42px;color:#94a3b8}
    </style>
@endsection