@extends('back.layouts.principal')

@section('title', 'Sanctions du personnel')
@section('page_title', 'Sanctions du personnel')
@section('page_subtitle', 'Historique disciplinaire du collaborateur avec accès direct aux dossiers associés.')

@section('content')
    <div class="row g-4">
        <div class="col-12">
            <div class="content-card">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                    <div>
                        <h4 class="fw-bold mb-1">
                            {{ optional($dossier->membreEquipe)->nom }} {{ optional($dossier->membreEquipe)->prenom }}
                        </h4>
                        <p class="text-muted mb-0">Sanctions liées au dossier RH.</p>
                    </div>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('rh.sanctions.create') }}" class="btn btn-primary rounded-pill px-4">
                            <i class="fa-solid fa-plus me-2"></i>Nouvelle sanction
                        </a>
                        <a href="{{ route('rh.dossiers-personnel.show', $dossier) }}" class="btn btn-outline-secondary rounded-pill px-4">Retour</a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle custom-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Motif</th>
                                <th>Type</th>
                                <th>Date</th>
                                <th>Statut</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sanctions as $sanction)
                                <tr>
                                    <td>{{ $sanction->id }}</td>
                                    <td>{{ $sanction->motif }}</td>
                                    <td>{{ ucfirst(str_replace('_', ' ', $sanction->type_sanction)) }}</td>
                                    <td>{{ $sanction->date_sanction?->format('d/m/Y') ?? '—' }}</td>
                                    <td><span class="badge rounded-pill text-bg-danger">{{ ucfirst($sanction->statut) }}</span></td>
                                    <td class="text-end">
                                        <a href="{{ route('rh.sanctions.show', $sanction) }}" class="btn btn-sm btn-light rounded-pill px-3">Voir</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <div class="empty-state">
                                            <i class="fa-solid fa-scale-balanced empty-state-icon"></i>
                                            <h5 class="mt-3">Aucune sanction</h5>
                                            <p class="text-muted">Aucune sanction n’est liée à ce dossier.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">{{ $sanctions->links() }}</div>
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
