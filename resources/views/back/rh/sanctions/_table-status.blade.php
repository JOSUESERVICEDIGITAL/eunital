<div class="row g-4">
    <div class="col-12">
        <div class="content-card">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                <div>
                    <h4 class="fw-bold mb-1">{{ $pageTitleInner }}</h4>
                    <p class="text-muted mb-0">{{ $description }}</p>
                </div>
                <a href="{{ route('rh.sanctions.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                    <i class="fa-solid fa-arrow-left me-2"></i>Toutes les sanctions
                </a>
            </div>

            <div class="table-responsive">
                <table class="table align-middle custom-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Employé</th>
                            <th>Motif</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Statut</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sanctionsList as $sanction)
                            <tr>
                                <td>{{ $sanction->id }}</td>
                                <td>{{ optional($sanction->membreEquipe)->nom }} {{ optional($sanction->membreEquipe)->prenom }}</td>
                                <td>{{ $sanction->motif }}</td>
                                <td>{{ ucfirst(str_replace('_', ' ', $sanction->type_sanction)) }}</td>
                                <td>{{ $sanction->date_sanction?->format('d/m/Y') ?? '—' }}</td>
                                <td>
                                    <span class="badge rounded-pill text-bg-light border">
                                        {{ ucfirst($sanction->statut) }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('rh.sanctions.show', $sanction) }}" class="btn btn-sm btn-light rounded-pill px-3">
                                        Voir
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div class="empty-state">
                                        <i class="fa-solid fa-scale-balanced empty-state-icon"></i>
                                        <h5 class="mt-3">Aucune sanction</h5>
                                        <p class="text-muted">Aucune donnée disponible pour cette vue.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $sanctionsList->links() }}
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