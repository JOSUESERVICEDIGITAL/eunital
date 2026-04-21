<div class="row g-4">
    <div class="col-12">
        <div class="content-card">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                <div>
                    <h4 class="fw-bold mb-1">{{ $pageTitleInner }}</h4>
                    <p class="text-muted mb-0">{{ $description }}</p>
                </div>
                <a href="{{ route('rh.recrutements.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                    <i class="fa-solid fa-arrow-left me-2"></i>Tous les recrutements
                </a>
            </div>

            <div class="table-responsive">
                <table class="table align-middle custom-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Recrutement</th>
                            <th>Département</th>
                            <th>Poste</th>
                            <th>Responsable</th>
                            <th>Candidatures</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recrutementsList as $recrutement)
                            <tr>
                                <td>{{ $recrutement->id }}</td>
                                <td>{{ $recrutement->titre }}</td>
                                <td>{{ optional($recrutement->departement)->nom ?? '—' }}</td>
                                <td>{{ optional($recrutement->poste)->nom ?? '—' }}</td>
                                <td>{{ optional($recrutement->responsable)->name ?? '—' }}</td>
                                <td>
                                    <span class="badge rounded-pill text-bg-dark">
                                        {{ $recrutement->candidatures_count ?? 0 }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('rh.recrutements.show', $recrutement) }}" class="btn btn-sm btn-light rounded-pill px-3">
                                        Voir
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div class="empty-state">
                                        <i class="fa-solid fa-briefcase empty-state-icon"></i>
                                        <h5 class="mt-3">Aucune donnée</h5>
                                        <p class="text-muted">Aucun recrutement disponible pour cette vue.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $recrutementsList->links() }}
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