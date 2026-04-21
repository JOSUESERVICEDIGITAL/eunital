<div class="row g-4">
    <div class="col-12">
        <div class="content-card">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                <div>
                    <h4 class="fw-bold mb-1">{{ $pageTitleInner }}</h4>
                    <p class="text-muted mb-0">{{ $description }}</p>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('rh.conges.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="fa-solid fa-arrow-left me-2"></i>Tous les congés
                    </a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table align-middle custom-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Employé</th>
                            <th>Type</th>
                            <th>Période</th>
                            <th>Jours</th>
                            <th>Statut</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($congesList as $conge)
                            <tr>
                                <td>{{ $conge->id }}</td>
                                <td>{{ optional($conge->membreEquipe)->nom }} {{ optional($conge->membreEquipe)->prenom }}</td>
                                <td>{{ ucfirst(str_replace('_', ' ', $conge->type_conge)) }}</td>
                                <td>{{ $conge->date_debut?->format('d/m/Y') }} → {{ $conge->date_fin?->format('d/m/Y') }}</td>
                                <td>{{ $conge->nombre_jours ?? '—' }}</td>
                                <td>
                                    <span class="badge rounded-pill text-bg-light border">
                                        {{ ucfirst(str_replace('_', ' ', $conge->statut)) }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="d-inline-flex gap-2 flex-wrap justify-content-end">
                                        <a href="{{ route('rh.conges.show', $conge) }}" class="btn btn-sm btn-light rounded-pill px-3">Voir</a>

                                        @if($showValidationActions)
                                            <form method="POST" action="{{ route('rh.conges.valider', $conge) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-success rounded-pill px-3">Valider</button>
                                            </form>

                                            <form method="POST" action="{{ route('rh.conges.refuser', $conge) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">Refuser</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div class="empty-state">
                                        <i class="fa-solid fa-calendar-days empty-state-icon"></i>
                                        <h5 class="mt-3">Aucun congé</h5>
                                        <p class="text-muted">Aucune donnée disponible pour cette vue.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $congesList->links() }}
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