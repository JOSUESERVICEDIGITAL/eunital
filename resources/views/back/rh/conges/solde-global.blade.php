@extends('back.layouts.principal')

@section('title', 'Soldes de congés')
@section('page_title', 'Soldes de congés')
@section('page_subtitle', 'Vue globale des soldes disponibles, jours consommés et reliquats par collaborateur.')

@section('content')
    <div class="row g-4">
        <div class="col-12">
            <div class="content-card">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                    <div>
                        <h4 class="fw-bold mb-1">Soldes de congés</h4>
                        <p class="text-muted mb-0">Suivi consolidé des jours pris et restants.</p>
                    </div>
                    <a href="{{ route('rh.conges.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        Retour
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle custom-table">
                        <thead>
                            <tr>
                                <th>Employé</th>
                                <th>Département</th>
                                <th>Solde initial</th>
                                <th>Jours pris</th>
                                <th>Solde restant</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($soldes as $item)
                                <tr>
                                    <td>{{ $item['membre']->nom }} {{ $item['membre']->prenom }}</td>
                                    <td>{{ optional($item['membre']->departement)->nom ?? '—' }}</td>
                                    <td>{{ $item['solde_initial'] }}</td>
                                    <td>{{ $item['jours_pris'] }}</td>
                                    <td>
                                        <span class="badge rounded-pill text-bg-success">
                                            {{ $item['solde_restant'] }}
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('rh.conges.solde-employe', $item['membre']) }}" class="btn btn-sm btn-light rounded-pill px-3">
                                            Voir
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <div class="empty-state">
                                            <i class="fa-solid fa-calendar-check empty-state-icon"></i>
                                            <h5 class="mt-3">Aucune donnée de solde</h5>
                                            <p class="text-muted">Les soldes globaux apparaîtront ici.</p>
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
        .custom-table thead th{font-size:13px;text-transform:uppercase;letter-spacing:.5px;color:#64748b;border-bottom:1px solid #e5e7eb}
        .custom-table tbody td{border-bottom:1px solid #f1f5f9}
        .empty-state{text-align:center;padding:20px}
        .empty-state-icon{font-size:42px;color:#94a3b8}
    </style>
@endsection