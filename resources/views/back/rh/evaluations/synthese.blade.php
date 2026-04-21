@extends('back.layouts.principal')

@section('title', 'Synthèse des évaluations')
@section('page_title', 'Synthèse des évaluations')
@section('page_subtitle', 'Vue analytique RH des évaluations sur une période donnée avec statistiques, tops et besoins de progression.')

@section('content')
    <div class="row g-4">

        <div class="col-12">
            <div class="content-card">
                <form method="GET" action="{{ route('rh.evaluations.synthese') }}">
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
                                <a href="{{ route('rh.evaluations.synthese') }}" class="btn btn-outline-secondary rounded-pill px-4">Réinitialiser</a>
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
                <div class="mini-label">Brouillons</div>
                <h3 class="stat-number">{{ $stats['brouillon'] ?? 0 }}</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="content-card h-100">
                <div class="mini-label">Validées</div>
                <h3 class="stat-number">{{ $stats['validee'] ?? 0 }}</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="content-card h-100">
                <div class="mini-label">Moyenne globale</div>
                <h3 class="stat-number">{{ $stats['moyenne_globale'] ?? 0 }}</h3>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="content-card h-100">
                <h5 class="fw-bold mb-4">Top notes</h5>

                <div class="ranking-list">
                    @forelse($topNotes as $evaluation)
                        <div class="ranking-item">
                            <div>
                                <div class="fw-bold">
                                    {{ optional($evaluation->membreEquipe)->nom }} {{ optional($evaluation->membreEquipe)->prenom }}
                                </div>
                                <div class="text-muted small">{{ $evaluation->titre }}</div>
                            </div>
                            <span class="badge rounded-pill text-bg-success">
                                {{ $evaluation->note_globale }}/10
                            </span>
                        </div>
                    @empty
                        <div class="text-muted">Aucune donnée disponible.</div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="content-card h-100">
                <h5 class="fw-bold mb-4">Besoins de progression</h5>

                <div class="ranking-list">
                    @forelse($besoinsProgression as $evaluation)
                        <div class="ranking-item">
                            <div>
                                <div class="fw-bold">
                                    {{ optional($evaluation->membreEquipe)->nom }} {{ optional($evaluation->membreEquipe)->prenom }}
                                </div>
                                <div class="text-muted small">{{ $evaluation->titre }}</div>
                            </div>
                            <span class="badge rounded-pill text-bg-danger">
                                {{ $evaluation->note_globale }}/10
                            </span>
                        </div>
                    @empty
                        <div class="text-muted">Aucune donnée disponible.</div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="content-card">
                <h5 class="fw-bold mb-4">Répartition par département</h5>

                <div class="table-responsive">
                    <table class="table align-middle custom-table mb-0">
                        <thead>
                            <tr>
                                <th>Département</th>
                                <th>Total</th>
                                <th>Moyenne</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($statsParDepartement as $row)
                                <tr>
                                    <td>{{ $row->departement }}</td>
                                    <td>{{ $row->total }}</td>
                                    <td>{{ number_format((float) $row->moyenne, 2, ',', ' ') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-4 text-muted">Aucune donnée disponible.</td>
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
        .ranking-list{display:flex;flex-direction:column;gap:12px}
        .ranking-item{display:flex;justify-content:space-between;align-items:center;gap:16px;padding:14px;border:1px solid #eef2f7;border-radius:16px}
        .custom-table thead th{font-size:13px;text-transform:uppercase;letter-spacing:.5px;color:#64748b;border-bottom:1px solid #e5e7eb}
        .custom-table tbody td{border-bottom:1px solid #f1f5f9}
    </style>
@endsection