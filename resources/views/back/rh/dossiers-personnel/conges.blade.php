@extends('back.layouts.principal')

@section('title', 'Congés du personnel')
@section('page_title', 'Congés du personnel')
@section('page_subtitle', 'Historique des demandes de congé du collaborateur avec accès direct aux détails.')

@section('content')
    <div class="row g-4">
        <div class="col-12">
            <div class="content-card">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                    <div>
                        <h4 class="fw-bold mb-1">
                            {{ optional($dossier->membreEquipe)->nom }} {{ optional($dossier->membreEquipe)->prenom }}
                        </h4>
                        <p class="text-muted mb-0">Congés liés au dossier RH.</p>
                    </div>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('rh.conges.create') }}" class="btn btn-primary rounded-pill px-4">
                            <i class="fa-solid fa-plus me-2"></i>Nouvelle demande
                        </a>
                        <a href="{{ route('rh.dossiers-personnel.show', $dossier) }}" class="btn btn-outline-secondary rounded-pill px-4">Retour</a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle custom-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Type</th>
                                <th>Période</th>
                                <th>Jours</th>
                                <th>Statut</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($conges as $conge)
                                <tr>
                                    <td>{{ $conge->id }}</td>
                                    <td>{{ ucfirst(str_replace('_', ' ', $conge->type_conge)) }}</td>
                                    <td>{{ $conge->date_debut?->format('d/m/Y') }} → {{ $conge->date_fin?->format('d/m/Y') }}</td>
                                    <td>{{ $conge->nombre_jours ?? '—' }}</td>
                                    <td><span class="badge rounded-pill text-bg-warning">{{ ucfirst(str_replace('_', ' ', $conge->statut)) }}</span></td>
                                    <td class="text-end">
                                        <a href="{{ route('rh.conges.show', $conge) }}" class="btn btn-sm btn-light rounded-pill px-3">Voir</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <div class="empty-state">
                                            <i class="fa-solid fa-calendar-days empty-state-icon"></i>
                                            <h5 class="mt-3">Aucun congé</h5>
                                            <p class="text-muted">Aucune demande de congé n’est liée à ce dossier.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">{{ $conges->links() }}</div>
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
