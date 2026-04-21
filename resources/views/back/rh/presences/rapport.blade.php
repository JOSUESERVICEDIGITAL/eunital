@extends('back.layouts.principal')

@section('title', 'Rapport des présences')
@section('page_title', 'Rapport des présences')
@section('page_subtitle', 'Synthèse analytique des présences sur une période donnée avec vue globale et lecture par département.')

@section('content')
    <div class="row g-4">

        <div class="col-12">
            <div class="content-card">
                <form method="GET" action="{{ route('rh.presences.rapport') }}">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Date début</label>
                            <input type="date" name="date_debut" value="{{ $dateDebut->format('Y-m-d') }}" class="form-control custom-input">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Date fin</label>
                            <input type="date" name="date_fin" value="{{ $dateFin->format('Y-m-d') }}" class="form-control custom-input">
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex gap-2 flex-wrap">
                                <button type="submit" class="btn btn-primary rounded-pill px-4">Actualiser</button>
                                <a href="{{ route('rh.presences.rapport') }}" class="btn btn-outline-secondary rounded-pill px-4">Réinitialiser</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-3">
            <div class="content-card h-100">
                <div class="mini-label">Total</div>
                <h3 class="stat-number">{{ $stats['total'] ?? 0 }}</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="content-card h-100">
                <div class="mini-label">Présents + retards</div>
                <h3 class="stat-number">{{ ($stats['present'] ?? 0) + ($stats['retard'] ?? 0) }}</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="content-card h-100">
                <div class="mini-label">Absents</div>
                <h3 class="stat-number text-danger">{{ $stats['absent'] ?? 0 }}</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="content-card h-100">
                <div class="mini-label">Taux de présence</div>
                <h3 class="stat-number text-success">{{ $tauxPresence ?? 0 }}%</h3>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="content-card h-100">
                <h5 class="fw-bold mb-4">Répartition par statut</h5>

                <div class="report-list">
                    @foreach($stats as $key => $value)
                        <div class="report-row">
                            <span class="report-label">{{ ucfirst(str_replace('_', ' ', $key)) }}</span>
                            <span class="report-value">{{ $value }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="content-card h-100">
                <h5 class="fw-bold mb-4">Répartition par département</h5>

                <div class="table-responsive">
                    <table class="table align-middle custom-table mb-0">
                        <thead>
                            <tr>
                                <th>Département</th>
                                <th class="text-end">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($statsParDepartement as $row)
                                <tr>
                                    <td>{{ $row->departement }}</td>
                                    <td class="text-end">
                                        <span class="badge rounded-pill text-bg-light border">{{ $row->total }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center py-4 text-muted">Aucune donnée disponible.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>

    <style>
        .custom-input{height:48px;border-radius:16px}
        .mini-label{font-size:13px;color:#64748b;font-weight:700;margin-bottom:8px}
        .stat-number{font-size:30px;font-weight:800;margin:0}
        .report-list{display:flex;flex-direction:column;gap:12px}
        .report-row{display:flex;justify-content:space-between;align-items:center;gap:16px;padding:14px;border:1px solid #eef2f7;border-radius:16px}
        .report-label{font-weight:700;color:#334155}
        .report-value{font-weight:800;color:#0f172a}
        .custom-table thead th{font-size:13px;text-transform:uppercase;letter-spacing:.5px;color:#64748b;border-bottom:1px solid #e5e7eb}
        .custom-table tbody td{border-bottom:1px solid #f1f5f9}
    </style>
@endsection